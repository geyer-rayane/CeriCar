<?php 

require_once "trajet.class.php";

class trajetTable
{
	/* Retourne un trajet via son départ et son arrivée */
	public static function getTrajet($depart, $arrivee)
	{
		/* Connexion à la DB */
		$em = dbconnection::getInstance()->getEntityManager() ;

		/* Table jabanainb.trajet */
		$trajetRepository = $em->getRepository('trajet');
		
		/* Recuperer sous forme de tableau les occurences */
		$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	
	
		/* Si aucun trajet retourne null */
		if ($trajet == false)
		{
			return null ;
		}		
		/* Sinon retourne le trajet */
		return $trajet; 
	}

}



?>