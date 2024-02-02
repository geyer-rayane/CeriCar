<?php

require_once "voyage.class.php";

class voyageTable {
	
	
	public static function getVoyagesByTrajet($trajet)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$voyagesAssocies = $em->getRepository('voyage')->findBy(array('trajet' => $trajet));

		foreach ($voyagesAssocies as $index => $voyage)
		{
			if (
            $voyage->id == null ||
            $voyage->conducteur == null ||
            $voyage->trajet == null ||
            $voyage->tarif == null ||
            $voyage->nbplace == null ||
            $voyage->heuredepart == null
			) 
			{
				unset($voyagesAssocies[$index]);
			}
    }

    return $voyagesAssocies;
	}


	/*  Avoir un voyage à partir de son identifiant */
	public static function getVoyageById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager();        
		$voyage = $em->getRepository('voyage')->findOneBy(array('id' => $id));        
		if ($voyage)
		{
			return $voyage;
		}
		return null ;
			
	}
	
	
	/*  Avoir la liste de voyages d'un utilisateur en tant que conducteur */
	public static function getListeVoyageByIdOfConducteur($conducteur)
	{
		$em = dbconnection::getInstance()->getEntityManager();        
		$listeVoyage = $em->getRepository('voyage')->findOneBy(array('conducteur' => $conducteur));        
		if ($listeVoyage)
		{
			return $listeVoyage;
		}
		return null ;
	}
	
	/* Retirer un certain nombre de place d'un voyage, fait après une réservation */
	public static function retirerPlaceVoyage($id, $nbrPlace)
	{
		$em = dbconnection::getInstance()->getEntityManager();        
		$voyage = $em->getRepository('voyage')->findOneBy(array('id' => $id));        

		/* Si le voyage existe */ 
		if ($voyage) 
		{
			$placesActuelles = $voyage->getNbPlace();

			/* Vérification pour s'assurer que le nombre de places à retirer ne dépasse pas les places actuelles */
			if ($placesActuelles >= $nbrPlace) 
			{
				$nouveauNombrePlaces = $placesActuelles - $nbrPlace;
				
				/* changement via this */
				$voyage->setNbPlace($nouveauNombrePlaces);

				$em->persist($voyage);
				$em->flush();

				return $voyage; 
			} 

		} 
		else 
		{ 
			return "Voyage non trouvé";
		}
	}

	/* Obtenir les itineraires avec et sans escales. Retourne un tableau de tableau avec des lignes de zéros afin de séparer les itinéraires composés ou non */
	public static function getCorrespondance($depart, $arrivee, $nbrPlace)
	{	
		$em = dbconnection::getInstance()->getEntityManager()->getConnection();
		$query = $em->prepare("SELECT getVoyageWithOrWithoutCorres(:depart, :arrivee, :nbrPlace, '', '', 0, '24:00:00', '00:00:00')");
		$query->bindParam(':depart', $depart);
		$query->bindParam(':arrivee', $arrivee);
		$query->bindParam(':nbrPlace', $nbrPlace);
		$query->execute();
    
		return $query->fetchAll();

	}

	/* Fonction d'analyse des lignes du tableau */
	public static function analyseTuple($depart, $arrivee, $tableauDeTableau)
	{
		$result = array(); /* Initialisation d'un tableau vide pour stocker les IDs trouvés */
		$trouverDepart = false; /* Indicateur pour trouver $depart */

		foreach ($tableauDeTableau as $tuples) {
			foreach ($tuples as $tuple) {
				$tupleValues = explode(",", trim($tuple, "()")); /* Sépare les valeurs du tuple */

				/* Récupération des valeurs pertinentes du tuple */
				$firstValue = trim($tupleValues[2]); /* Valeur correspondant à $depart */
				$lastValue = trim($tupleValues[3]); /* Valeur correspondant à $arrivee */

				/* Vérification des correspondances */
				if ($firstValue === $depart) 
				{
					$trouverDepart = true; /* Marquer avoir trouvé $depart */
				}
				$result[] = trim($tupleValues[1]);

				if ($lastValue === $arrivee && $trouverDepart) {
					/* $result[] = trim($tupleValues[1]); /* Ajouter le 2ème ID du tuple au résultat */
					$trouverDepart = false; /* Réinitialiser la variable pour arrêter la recherche */

					/* Ajouter un 0 comme séparateur entre les itinéraires trouvés */
					$result[] = 0;
				}
			}
		}
		return $result; 
	}


	/* Utilise le tableau créer par analyseTuple pour récupérer les voyages associés. Forme du tableau = [$voyageID1, $voyageID2, 0, ...] */
	public static function getListeVoyage($tableaudIdentifiantVoyage)
	{
		$tableauVoyage = array();

		foreach ($tableaudIdentifiantVoyage as $idVoyage) 
		{
			if ($idVoyage != 0) 
			{
				$voyage = voyageTable::getVoyageById($idVoyage);

				/* Ajouter le voyage au tableau si trouvé */
				if ($voyage != null) 
				{
					$tableauVoyage[] = $voyage;
				}
			} 	
			else 
			{
				$tableauVoyage[] = null;
			}
    }
		return $tableauVoyage;
	}

/* Forme du tableau actuelle = [$voyage1, $voyage2, null, $voyage3, null ...] 

	/* Trier la liste obtenue en fonction de leur longueur */
	public static function trierListeVoyage($liste) 
	{
		/* Découper la liste en sous-listes entre chaque zéro */
		$sousListes = [];
		$currentSubList = [];

		foreach ($liste as $element) 
		{
			if ($element != 0) {
				$currentSubList[] = $element;
			}
			else 
			{
				if (!empty($currentSubList)) {
					$sousListes[] = $currentSubList;
					$currentSubList = [];
            }
			$sousListes[] = [0]; /* Ajouter le zéro comme séparateur */
			}
		}

		if (!empty($currentSubList)) 
		{
			$sousListes[] = $currentSubList;
		}

		/* Trier les sous-listes par leur longueur */
		usort($sousListes, function ($a, $b) 
		{
			return count($a) - count($b);
		});

		/* Fusionner les sous-listes triées en une seule liste résultante */
		$resultat = array_merge(...$sousListes);

		return $resultat;
}


	/* Ajouter un voyage avec un utilisateur connecté (il sera donc le conducteur) */
	public static function ajouterVoyageParUnUtilisateur($conducteur, $trajet, $tarif, $nbplace, $heuredepart, $contraintes)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$voyageRepository = $em->getRepository('voyage');    
		$newVoyage = new voyage($conducteur, $trajet, $tarif, $nbplace, $heuredepart, $contraintes);
		$em->persist($newVoyage);
		$em->flush(); /*  Appliquer les changements dans la base de données */
		return $newVoyage; 
	}

	/* Recuperer les voyages d'un utilisateur en tant que conducteur */
	public static function getVoyageByIdOfConducteur($conducteur)
	{
		$em = dbconnection::getInstance()->getEntityManager();        
		$voyage = $em->getRepository('voyage')->findBy(array('conducteur' => $conducteur));        
		if ($voyage)
		{
			return $voyage;
		}
		return null ;
			
	}




}
?>
