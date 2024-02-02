<?php

require_once "reservation.class.php";


class reservationTable 
{
	/* Avoir une reservation a partir d'un voyage */
	public static function getReservationByVoyage($voyage) 	
	{
	 $em = dbconnection::getInstance()->getEntityManager();        
    $reservationAssocies = $em->getRepository('reservation')->findBy(array('voyage' => $voyage));        
    return $reservationAssocies;	
	}
	
	/* Avoir les reservations à partir de l'id d'un utilisateur */
	public static function getReservationById($id) 	
	{
		$em = dbconnection::getInstance()->getEntityManager();        
		$reservationAssocies = $em->getRepository('reservation')->findBy(array('voyageur' => $id));        
		return $reservationAssocies;	
	}
	
	/* Ajouter une reservation a un utilisateur. Si plusieurs places alors plusieurs reservations*/
	public static function reservationUtilisateur($user, $voyage, $nbrPlace)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$resaRepository = $em->getRepository('reservation');

		/* Creation à la chaîne de reservations en fonction du nombre de place */
		for ($i = 0; $i < $nbrPlace; $i++) 
		{	
			$newReservation = new reservation($voyage, $user);
			$em->persist($newReservation);
			$em->flush();
		}

		return $newReservation;
	}
	
	
}
?>
