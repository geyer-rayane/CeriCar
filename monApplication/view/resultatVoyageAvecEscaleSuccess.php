<?php 
/* Resultat des voyages avec escales via la fonction de recherche par correspondance. A voir dans voyageTable et appel dans le controller */

/* Si aucun voyage dans le tableau alors envoi au JS echec */
if ($context->voyagesAvecCorres == null) 
{
    echo "Pas de voyage d'après votre recherche";
}
 
/* Sinon affichage des voyages 1 à 1 */
/* Pour rappel le tableau est de cette forme [voyage1, voyage2 ... ,voyageN, null, voyageN+1,.....,null] */
/* null sépare les voyages succesifs à correspondance */ 
else 
{	
    $i = 1 ;
    echo '<p class ="proposition">Proposition n°' . $i .'</p>' ;
    echo '<br><br>';
    $i = $i + 1;
	/*On compte le nombre de voyage pour arrêter l'affichage de Proposition n°i au bon moment */
    $nbrVoyage = count($context->listeVoyage);
	/* Vitesse de voyage 60 km/h */
    $vitesseConstante = 60; 
	
	/* Initialisation d'une liste temporaire contenant les id des voyages. Sera vidée à chaque fin de proposition.*/
	$listeTemporaireIdVoyage = array() ;
    foreach ($context->listeVoyage as $voyage) {	
        $nbrVoyage = $nbrVoyage - 1;
        if ($voyage != null) 
		{
			/* On ajoute le voyage courant dans la liste temporaire */
			array_push($listeTemporaireIdVoyage,$voyage->id) ;
            $temps_parcours_heures = $voyage->trajet->distance / $vitesseConstante;

            $heure_depart = $voyage->heuredepart;
            /* Ajout du zéro initial pour les heures comprises entre 0 et 9 */
            if ($heure_depart >= 0 && $heure_depart <= 9) {
                $heure_depart_str = '0' . $heure_depart;
            } 
			else 
			{
                $heure_depart_str = $heure_depart;
            }
			
			/* Gestion et format du temps */
            $heure_depart = strtotime($voyage->heuredepart . ':00');
            $heure_arrivee_timestamp = $heure_depart + ($temps_parcours_heures * 3600);
            $heure_arrivee = date('H:i', $heure_arrivee_timestamp);
            $temps_decimal = $temps_parcours_heures;
            $heures = floor($temps_decimal); 
            $minutes = round(($temps_decimal - $heures) * 60);

            /* Formater les heures et les minutes avec str_pad pour ajouter un zéro initial si nécessaire */
            $heures_format = str_pad($heures, 2, '0', STR_PAD_LEFT);
            $minutes_format = str_pad($minutes, 2, '0', STR_PAD_LEFT);

			/* Affichage du voyage et de ses informations */
			
			
				echo '<div class="sansEscale"> 
                <p class="prix">' . $voyage->tarif . "€" . '</p>
                <p class="villeDepart"> <strong>' . $heure_depart_str .':00 </strong>' . ' ' . $voyage->trajet->depart . '</p>
                <p class="villeArrivee"><strong>' . $heure_arrivee . ' </strong>' . ' ' . $voyage->trajet->arrivee . '</p>
                <p class="contrainte">' . $voyage->contraintes .'</p>
                <p class="conducteur"><i class="fa fa-user"></i>' . ' ' . $voyage->conducteur->nom . ' ' . $voyage->conducteur->prenom . '</p> 
                <p class="heure"><i class="fas fa-clock"></i>' . ' ' . $heures_format .':'.$minutes_format . '</p>
                <p class="nombrePlace">' . $voyage->nbplace . ' places restantes</p>';
				echo '</div>';
				echo '<br><br><br><br><br><br>';         
        }
		else
		{
			/* Affichage d'un seul bouton pour réserver toute la proposition (tous les voyages succesifs) */ 
            if (isset($_SESSION['identifiant']) || isset($_SESSION['identifiantInscription'])) 
			{   /* Encapsulation de la liste pour envoi vers argument de la fonction javascript */
				echo '<button class="w3-button w3-dark-grey" type="button" name="listeIdVoyage" value="' . htmlspecialchars(json_encode($listeTemporaireIdVoyage)) . '" onclick="tentativeReservationMultiple(' . htmlspecialchars(json_encode($listeTemporaireIdVoyage)) . ')" style="width: 100px; height: 40px; font-size: 14px; font-family: Arial;">Reserver</button>';
            }
            echo '<br><br>';
			/* On vide le tableau temporaire contenant les id des voyages pour une meme proposition */
			$listeTemporaireIdVoyage = array() ;

            if ($nbrVoyage != 0) 
			{
                echo '<p class ="proposition">Proposition n°' . $i .'</p>' ;
                echo '<br><br>';
                $i = $i + 1;
            }	
        }	
    }
}
?>
