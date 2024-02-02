<?php
/* Resultat des voyages sans escales via la fonction de recherche appelée dans le controller */

/* Si pas de résultat envoi de l'echec au JS */
if ($context->voyageRecherche == null) 
{
    echo "Pas de voyage";
}

/* Sinon envoi de la réponse au JS afin de la faire apparaître dans la div correspondante */
else
{	
	echo '********' ;
	
	/*
	foreach ($context->voyageRecherche as $voyage) {
		echo $voyage->id . ' ';
	}
	*/
	
	echo '********' ;
    echo '<br><br><br>';
    $vitesseConstante = 60; 

    foreach ($context->voyageRecherche as $voyage) {
        if ($voyage->nbplace >= $context->nbrePlaces) {
            $temps_parcours_heures = $voyage->trajet->distance / $vitesseConstante;

            /* Ajout du zéro initial pour les heures comprises entre 0 et 9 */
            if ($voyage->heuredepart >= 0 && $voyage->heuredepart <= 9) {
                $heure_depart_str = '0' . $voyage->heuredepart;
            } else {
                $heure_depart_str = $voyage->heuredepart;
            }

            $heure_depart = strtotime($voyage->heuredepart . ':00');
            $heure_arrivee_timestamp = $heure_depart + ($temps_parcours_heures * 3600); /* Convertir le temps en secondes */
            $heure_arrivee = date('H:i', $heure_arrivee_timestamp);

            $temps_decimal = $temps_parcours_heures;
            $heures = floor($temps_decimal); /* Partie entière pour les heures */
            $minutes = round(($temps_decimal - $heures) * 60); /* Conversion de la partie décimale en minutes arrondies */

            $heures_format = str_pad($heures, 2, '0', STR_PAD_LEFT);
            $minutes_format = str_pad($minutes, 2, '0', STR_PAD_LEFT);

			/* Affichage du voyage et de ses informations */
            echo '<div class="sansEscale"> 
                <p class="prix">' . $voyage->tarif . "€" . '</p>
                <p class="villeDepart"> <strong>' . $heure_depart_str .':00 </strong>' . ' ' . $voyage->trajet->depart . '</p>
                <p class="villeArrivee"><strong>' . $heure_arrivee . ' </strong>' . ' ' . $voyage->trajet->arrivee . '</p>
                <p class="contrainte">' . $voyage->contraintes .'</p>
                <p class="heure"><i class="fas fa-clock"></i>' . ' ' . $heures_format .':'.$minutes_format . '</p>
                <p class="conducteur"><i class="fa fa-user"></i>' . ' ' . $voyage->conducteur->nom . ' ' . $voyage->conducteur->prenom . '</p> 
                <p class="nombrePlace">' . $voyage->nbplace . ' places restantes</p>';

			/* Affichage d'un bouton pour chaque voyage proposé*/ 
            if (isset($_SESSION['identifiant']) || isset($_SESSION['identifiantInscription'])) 
			{    
                echo '<button class="w3-button w3-dark-grey reservez" type="button" name="idVoyage" value="' . $voyage->id . '" onclick="tentativeReservation(' . $voyage->id . ')" style="width: 100px; height: 40px; font-size: 14px; font-family: Arial;">Reserver</button>';
            }
            echo '</div>';
            echo '<br><br><br><br><br><br><br>';
        }
    }
}
?>
