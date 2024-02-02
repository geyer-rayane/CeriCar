<?php
/* Affichage du profil de l'utilisateur avec son nom, prénom, identifiant, avatar, voyages en tant que passage et conducteur */
/* NB : décommenter tout le code permet de regrouper les voyages par id et de connaitre leur nombre, donc de connaitre le nombre de place. SAUF si plusieurs meme trajet car pas de distinction ! */

/* Photo de profil par défaut si non existante */
if ($context->utilisateurProfil->avatar == null) 
{
    $context->utilisateurProfil->avatar = 'https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/images/inconnu.jpg';
}

/* Affichage de l'avatar */
echo '<img src="' . $context->utilisateurProfil->avatar . '" class="taillePhoto">' ;
   

/* Casting nom et prénom pour majuscules et minuscules */
$nomPrenom = $context->utilisateurProfil->nom;
$prenom = $context->utilisateurProfil->prenom;
$nomPrenomFormate = ucfirst(strtolower($nomPrenom)) . ' ' . ucfirst(strtolower($prenom));
$identifiant = strtolower($context->utilisateurProfil->identifiant);

/*Affichage nom et prénom */
echo '<h2>' . $nomPrenomFormate . '<br>' . $identifiant . '</h2>';
   
/*Voyages en tant que passager */

echo '<br><br><br><br><br><br><br>';
echo '<p class="mesVoyages">Mes voyages en tant que passager</p>' ;

/* Regrouper les voyages par id car une reservation => 1 unique place 
$voyagesTraites = []; // Liste pour stocker les ID des voyages déjà traités
*/

/* Vitesse constante de voyage de 60 km/h */
$vitesseConstante = 60;

/* On parcourt le tableau de reservation de l'utilisateur */
foreach ($context->reservationUtilisateur as $reservation) {
   
    /*Si on veut regrouper les voyages 
    /* Vérifier si l'ID du voyage a déjà été traité 
    if (in_array($reservation->voyage->id, $voyagesTraites)) 
	{
        continue;
    }
    
	$voyagesTraites[] = $reservation->voyage->id; // Ajouter l'ID du voyage à la liste des voyages traités	
	*/
	
    $temps_parcours_heures = $reservation->voyage->trajet->distance / $vitesseConstante;

    /* Formatage de l'heure de départ avec un zéro initial si nécessaire */
    $heure_depart = $reservation->voyage->heuredepart;
    if ($heure_depart >= 0 && $heure_depart <= 9) 
	{
        $heure_depart_str = '0' . $heure_depart;
    } 
	else 
	{
        $heure_depart_str = $heure_depart;
    }
	
	/*Calcul et casting des temps de trajets heure de départ et heure d'arrivée */
    $heure_depart = strtotime($reservation->voyage->heuredepart . ':00');
    $heure_arrivee_timestamp = $heure_depart + ($temps_parcours_heures * 3600); // Convertir le temps en secondes
    $heure_arrivee = date('H:i', $heure_arrivee_timestamp);
    $temps_decimal = $temps_parcours_heures;
    $heures = floor($temps_decimal); /* Partie entière pour les heures */
    $minutes = round(($temps_decimal - $heures) * 60); /* Conversion de la partie décimale en minutes arrondies */

    /* Formater les heures et les minutes avec str_pad pour ajouter un zéro initial si nécessaire */
    $heures_format = str_pad($heures, 2, '0', STR_PAD_LEFT);
    $minutes_format = str_pad($minutes, 2, '0', STR_PAD_LEFT);

	/* Occurences de $reservation->voyage->id multiples 
    // Afficher le nombre d'occurrences pour ce voyage
    $occurrences = 0;
    foreach ($context->reservationUtilisateur as $otherReservation) {
        if ($reservation->voyage->id === $otherReservation->voyage->id) {
            $occurrences++;
        }
    }
	*/  

	/* Affichage des voyages via le tableau de reservation avec $reservation->voyage. Utilisation du même style que pour l'affichage de recherche */
    echo '<div class="sansEscale"> 
        <p class="prix">' . $reservation->voyage->tarif . "€ payé" . '</p>
        <p class="villeDepart"> <strong>' . $heure_depart_str . ':00 </strong>' . ' ' . $reservation->voyage->trajet->depart . '</p>
        <p class="villeArrivee"><strong>' . $heure_arrivee . ' </strong>' . ' ' . $reservation->voyage->trajet->arrivee . '</p>
        <p class="contrainte">' . $reservation->voyage->contraintes .'</p>
        <p class="heure"><i class="fas fa-clock"></i>' . ' ' . $heures_format .':'.$minutes_format . '</p>
        <p class="conducteur"><i class="fa fa-user"></i>' . ' ' . $reservation->voyage->conducteur->nom . ' ' . $reservation->voyage->conducteur->prenom . '</p> 
        <p class="nombrePlace">' . $reservation->voyage->nbplace . ' places restantes</p>';
     
	/* Idem gestion nombre de reservation  
	if ($occurrences == 1)
	{
		echo '<p class="nbrPlaceReservees">' . $occurrences. ' places réservéee</p>';
	}
	else
	{
		echo '<p class="nbrPlaceReservees">' . $occurrences. ' places réservées</p>';
	}	
	*/

    echo '</div>';
    echo '<br><br><br><br><br><br><br>';
}

echo '<br><br><br>' ;

/* Affichage des voyages de l'utilisateur en tant que conducteur */

echo '<p class="mesVoyages">Mes voyages en tant que conducteur</p>' ;

$vitesseConstante = 60;

if ($context->voyageUtilisateurEnTantQueConducteur != null)
{	
	foreach ($context->voyageUtilisateurEnTantQueConducteur as $voyage) {
		$temps_parcours_heures = $voyage->trajet->distance / $vitesseConstante;
	
		/* Formatage de l'heure de départ avec un zéro initial si nécessaire */
		$heure_depart = $voyage->heuredepart;
		if ($heure_depart >= 0 && $heure_depart <= 9) 
		{
			$heure_depart_str = '0' . $heure_depart;
		}
		else 
		{
			$heure_depart_str = $heure_depart;
		}

		$heure_depart = strtotime($voyage->heuredepart . ':00');
		$heure_arrivee_timestamp = $heure_depart + ($temps_parcours_heures * 3600);
		$heure_arrivee = date('H:i', $heure_arrivee_timestamp);

		$temps_decimal = $temps_parcours_heures;
		$heures = floor($temps_decimal);
		$minutes = round(($temps_decimal - $heures) * 60); 

    
		$heures_format = str_pad($heures, 2, '0', STR_PAD_LEFT);
		$minutes_format = str_pad($minutes, 2, '0', STR_PAD_LEFT);

		echo '<div class="sansEscale"> 
			<p class="prix">' . $voyage->tarif . "€" . '</p>
			<p class="villeDepart"> <strong>' . $heure_depart_str . ':00 </strong>' . ' ' . $voyage->trajet->depart . '</p>
			<p class="villeArrivee"><strong>' . $heure_arrivee . ' </strong>' . ' ' . $voyage->trajet->arrivee . '</p>
			<p class="contrainte">' . $voyage->contraintes .'</p>
			<p class="heure"><i class="fas fa-clock"></i>' . ' ' . $heures_format .':'.$minutes_format . '</p>
			<p class="conducteur"><i class="fa fa-user"></i>' . ' Vous ' . '</p> 
			<p class="nombrePlace">' . $voyage->nbplace . ' places restantes</p>';
		echo '</div>';
		echo '<br><br><br><br><br><br><br>';
}
}
?>
