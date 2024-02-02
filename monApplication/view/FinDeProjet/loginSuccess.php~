Test getUserByLoginAndPass : <?php echo $context->login->nom." ".$context->login->prenom." | id utilisateur : ".$context->login->id ?>  
<br>
<br>

Test getTrajet : <?php echo "id trajet : ".$context->trajet->id." | départ : ".$context->trajet->depart." vers ".$context->trajet->arrivee." ".$context->listeVoyages ?>  
<br>
<br>
Test getVoyageByTrajet : 
<br> 
<?php 

$i = 0 ;

foreach ($context->voyageAssocies as $voyage)
{
	echo "Voyage du trajet numéro (car dans un trajet il y'a plusieurs voyages)"." ".$i." : " ;
	echo "id trajet : ".$voyage->id." conducteur ".$voyage->conducteur->nom." ".$voyage->conducteur->prenom." | trajet id ".$voyage->trajet->id." | tarif ".$voyage->tarif." | nombre places ".$voyage->nbplace." | heure départ ".$voyage->heuredepart." | contraintes ".$voyage->contraintes. "<br>" ;
	$i = $i +1 ;
} 
?> 
<br> 
Test getReservationByVoyage : 
<br> 
<?php 

$i = 0 ;

foreach ($context->reservationAssocies as $reservation)
{
	echo "Reservation du voyage numéro"." ".$i." : "."<br>" ;
	echo "Trajet arrivée :".$reservation->voyage->trajet->arrivee ;
	echo "id ".$reservation->id." | id voyage ".$reservation->voyage->id." nom et prénom conducteur : ".$reservation->voyage->conducteur->nom." ".$reservation->voyage->conducteur->prenom."| nom et prénom voyageur ".$reservation->voyageur->nom." ".$reservation->voyageur->prenom."<br>" ;
	$i = $i +1 ;
} 

?>

<br> 
Test getUserById : 
<br> 
<?php 
echo "Informations de notre utilisateur avec l'information donnée id ".$context->getUserById->id." : ".$context->getUserById->nom." ".$context->getUserById->prenom ;
?>