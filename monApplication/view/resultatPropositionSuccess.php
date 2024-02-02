<?php 
/* Réponse à la tentative de proposition de voyage */

/* 1er cas : le trajet n'existe pas */
if ($context->ajoutVoyage == null)
{
	echo 'Trajet inexistant' ;
}	

/* 2eme cas : le trajet existe et est proposé en amont. $context->ajoutVoyage retourne soit null soit le voyage */
else 
{
	echo 'Voyage propose' ;
}	

?>