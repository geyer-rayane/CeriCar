<?php

class mainController
{

/* Gestion de la recherche de voyage */	
/* Voyages avec et sans escales */

	/* Affichage de la vue pour le formulaire de recherche de voyage */
	public static function afficherFormulaireRecherche($request,$context)	
	{	
		return context::SUCCESS;
	}
	
	/* Recuperer les voyages sans escale */
	public static function resultatVoyageSansEscale($request, $context) 
	{
		$context->nbrePlaces = $request['nbrePlaces'] ;
		/* Recuperation du trajet associé à la recherche de l'utilisateur */
		$context->trajetRecherche = trajetTable::getTrajet($request['depart'], $request['arrivee']);
		/* Recuperation des voyages associés au trajet */
		$context->voyageRecherche = voyageTable::getVoyagesByTrajet($context->trajetRecherche);
		return context::SUCCESS;
	}
	
	/*  Recuperer les voyages avec escale */
	public static function resultatVoyageAvecEscale($request, $context) 
	{
		/* Recuperer le nombre de places */
		$context->nbrePlaces = $request['nbrePlaces'] ;
		/* Recuperation du tableau de tableau via PLPGSQL et appel méthode voyageTable */
		$context->voyagesAvecCorres = voyageTable::getCorrespondance($request['depart'],$request['arrivee'],$request['nbrePlaces']) ; 
		/* Analyse tuple par tuple et extractions des id de voyage et retourne un tableau d'id de voyage séparé par des 0. Si non séparé alors escale */
		$context->analyse = voyageTable::analyseTuple($request['depart'],$request['arrivee'],$context->voyagesAvecCorres) ;
		/* On recupere la liste des voyages plutôt que leurs id */
		$context->listeVoyage = voyageTable::getListeVoyage($context->analyse) ;
		return context::SUCCESS;
	}


/* Connexion et deconnexion de l'utilisateur */
	
	/* Affichage du formulaire de connexion */
	public static function connexion($request,$context)
	{
		return context::SUCCESS;
	}

	/* Deconnexion de l'utilisateur */
	public static function deconnexion($request,$context)
	{
		return context::SUCCESS;
	}	
	
	/* Affichage du formulaire d'inscription */
	public static function inscription($request,$context)
	{
		return context::SUCCESS;
	}
	
	/* Gère la tentative de connexion */
	public static function resultatConnexion($request,$context)
	{
		/* Recupere soit un utilisateur si il existe dans la DB sinon null. Gestion des cas dans la vue Success associée */
		$context->utilisateur = utilisateurTable::connexionUtilisateur($request['identifiant'],$request['mdp']);
		return context::SUCCESS;
	}
	
	/* Gère la tentative d'inscription */
	public static function resultatInscription($request,$context)
	{
		/* Inscription de l'utilisateur avec les données entrées dans le formulaire */
		$context->inscription = utilisateurTable::inscriptionUtilisateur($request['identifiantInscription'],$request['mdpInscription'],$request['prenomInscription'],$request['nomInscription'],$request['avatarInscription']);
		return context::SUCCESS;
	}
	
	/* Affichage du profil de l'utilisateur */
	public static function afficherProfil($request, $context)
	{
		/* Si l'utilisateur s'est connecté */
		if (isset($_SESSION['identifiant'])) 
		{
			/* On recupere l'utilisateur via l'identifiant de l'utilisateur */
			$context->utilisateurProfil = utilisateurTable::getUserByIdentifiant($_SESSION['identifiant']);
			/* On recupere les reservations de l'utilisateur avec son id unique */ 
			$context->reservationUtilisateur = reservationTable::getReservationById($context->utilisateurProfil->id);
		}

		/* Si l'utilisateur vient de se créer un compte il est connecté automatiquement */
		if (isset($_SESSION['identifiantInscription'])) 
		{
			/* On recupere l'utilisateur via l'identifiant de l'utilisateur */			
			$context->utilisateurProfil = utilisateurTable::getUserByIdentifiant($_SESSION['identifiantInscription']);
			/* On recupere les reservations de l'utilisateur avec son id unique */ 			
			$context->reservationUtilisateur = reservationTable::getReservationById($context->utilisateurProfil->id);
		}
	
		/* Obtenir les voyages proposés par l'utilisateur (en tant que conducteur) */
		$context->voyageUtilisateurEnTantQueConducteur = voyageTable::getVoyageByIdOfConducteur($context->utilisateurProfil->id) ;
		
		return context::SUCCESS ;
	}

/* Affichage de l'accueil */
	public static function retourAccueil($request,$context)
	{
		return context::SUCCESS;
	}

/* Gestion des reservations (simples ou multiples). Si multiple voyages le JS boucle sur une liste d'id de voyage */
	
	/* Créer une réservation pour un utilisateur et soustraire le nombre de place sélectionnée dans le voyage */
	public static function resultatReservation($request,$context)
	{	
		/* Si l'utilisateur s'est connecté */
		if (isset($_SESSION['identifiant']))
		{
			/* On recupere l'utilisateur associé à l'identifiant contenu dans la variable de session */
			$context->utilisateurVeutReserver = utilisateurTable::getUserByIdentifiant($_SESSION['identifiant']);
			/* On recupere le voyage via son id que l'on a stocké dans une variable de session avec combo JS + monApplicationAjax.php  */
			$context->voyageAReserver = voyageTable::getVoyageById($_SESSION['idVoyage']) ;
			/* Idem pour nombre de places */
			$context->nbrPlaceAReserver = $_SESSION['nbrePlaces'] ;
			/* Reservation du voyage pour l'utilisateur connecté avec le bon nombre de places */
			reservationTable::reservationUtilisateur($context->utilisateurVeutReserver,$context->voyageAReserver ,$context->nbrPlaceAReserver)  ;
			/* Retirer les places necessaires dans le voyage concerné */
			voyageTable::retirerPlaceVoyage($_SESSION['idVoyage'],$_SESSION['nbrePlaces']) ;
		}	
		
		/* Si l'utilisateur vient de se créer un compte il est connecté automatiquement */	
		if (isset($_SESSION['identifiantInscription']))
		{
			/* On recupere l'utilisateur associé à l'identifiant contenu dans la variable de session */
			$context->utilisateurVeutReserver = utilisateurTable::getUserByIdentifiant($_SESSION['identifiantInscription']);
			/* On recupere le voyage via son id que l'on a stocké dans une variable de session avec combo JS + monApplicationAjax.php  */
			$context->voyageAReserver = voyageTable::getVoyageById($_SESSION['idVoyage']) ;
			/* Idem pour nombre de places */
			$context->nbrPlaceAReserver = $_SESSION['nbrePlaces'] ;
			/* Reservation du voyage pour l'utilisateur connecté avec le bon nombre de places */
			reservationTable::reservationUtilisateur($context->utilisateurVeutReserver,$context->voyageAReserver ,$context->nbrPlaceAReserver)  ;
			/* Retirer les places necessaires dans le voyage concerné */
			voyageTable::retirerPlaceVoyage($_SESSION['idVoyage'],$_SESSION['nbrePlaces']) ;
		}
		
		return context::SUCCESS;
	}	
	
	/* Affichage du formulaire de proposition de voyage (uniquement si l'utilisateur est connecté */
	
	public static function propositionVoyage($request,$context)
	{
		return context::SUCCESS;
	}
	
	/* Tentative de proposition de voyage en fonction des données entrées par l'utilisateur dans le formulaire */
	public static function resultatProposition($request,$context)
	{
		/* Si l'utilisateur s'est connecté */
		if (isset($_SESSION['identifiant']))
		{
			$context->conducteur = utilisateurTable::getUserByIdentifiant($_SESSION['identifiant']) ;
		}	
		/* Si l'utilisateur vient de se créer un compte il est connecté automatiquement */	
		if (isset($_SESSION['identifiantInscription']))
		{
			$context->conducteur = utilisateurTable::getUserByIdentifiant($_SESSION['identifiantInscription']) ;
		}	
		
		/* Recuperation des informations necessaires */
		$context->depart = $request['departVoyage'] ;
		$context->arrivee = $request['arriveeVoyage'] ;
		$context->contraintes = $request['contrainteVoyage'] ;
		$context->nbplace  = $request['nbrPlacesVoyage'] ;
		$context->tarif = $request['tarifVoyage'] ;		
		$context->heureDepart = $request['heureDepartVoyage'] ;
		
		/* On détermine le trajet à partir du départ et de l'arrivée écrite dans l'input départ et arrivée. Retourne soit null soit le trajet */
		$context->trajetDuVoyageRajouter = trajetTable::getTrajet($context->depart,$context->arrivee) ;
		/* On ajoute le voyage si le trajet est non null */
		if ($context->trajetDuVoyageRajouter != null)
		{
			$context->ajoutVoyage = voyageTable::ajouterVoyageParUnUtilisateur($context->conducteur, $context->trajetDuVoyageRajouter, $context->tarif, $context->nbplace, $context->heureDepart, $context->contraintes);
		}	
		else 
		{
			/* Gestion de ce cas dans la vue associée */
			$context->ajoutVoyage = null ; 
		}
		return context::SUCCESS ;
	}
}
?>