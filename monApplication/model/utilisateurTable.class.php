<?php
require_once "utilisateur.class.php";

class utilisateurTable {
	
	/* Retourne un utilisateur sachant son login et son mot de passe */
	public static function getUserByLoginAndPass($login, $pass)
	{
		$em = dbconnection::getInstance()->getEntityManager(); /* Récupération de l'EntityManager */
		$userRepository = $em->getRepository('utilisateur'); /* Récupération du repository pour les utilisateurs */
		
		/* Recherche de l'utilisateur par occurrence dans la table correspondant à l'identifiant et au mot de passe */
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));
		
		/* Si aucun utilisateur correspondant n'est trouvé, affiche un message d'erreur */
		if ($user == false)
		{
			echo 'Erreur sql';
		}
		return $user; /* Retourne l'utilisateur trouvé ou null */
	}
	
	/* Fonction qui retourne un utilisateur sachant son ID  */
	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$userRepository = $em->getRepository('utilisateur');
		
		/* Recherche de l'utilisateur par son ID */
		$user = $userRepository->findOneBy(array('id' => $id));	
		
		/* Si aucun utilisateur correspondant n'est trouvé, affiche un message d'erreur */
		if ($user == false)
		{
			echo 'Erreur sql';
		}
		return $user; /* Retourne l'utilisateur trouvé ou null */
	}
	
	
	/* Fonction qui retourne un utilisateur en fonction de son identifiant */
	public static function getUserByIdentifiant($identifiant)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$userRepository = $em->getRepository('utilisateur');
		
		/* Recherche de l'utilisateur par son identifiant */
		$user = $userRepository->findOneBy(array('identifiant' => $identifiant));	
		
		/* Si aucun utilisateur correspondant n'est trouvé, affiche un message d'erreur */
		if ($user == false)
		{
			echo 'Erreur sql';
		}
		return $user; /* Retourne l'utilisateur trouvé ou null */
	}

	
	/* Fonction de connexion d'un utilisateur */
	public static function connexionUtilisateur($user, $password)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$userRepository = $em->getRepository('utilisateur');
		
		/* Vérification des informations d'identification de l'utilisateur */
		$user = $userRepository->findOneBy(array('identifiant' => $user, 'pass' => sha1($password))); /* sha1 => hashage du mot de pass */
		
		/* Si l'utilisateur n'est pas trouvé, retourne null */
		if ($user == false)
		{
			return null;
		}
		return $user; /* Retourne l'utilisateur trouvé */
	}

	/* Fonction d'inscription d'un nouvel utilisateur */
	public static function inscriptionUtilisateur($identifiantInscription, $mdpInscription, $nomInscription, $prenomInscription, $avatarInscription)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$userRepository = $em->getRepository('utilisateur');    
		
		/* Vérifie si l'utilisateur existe déjà */
		$user = $userRepository->findOneBy(array('identifiant' => $identifiantInscription));

		/* Si l'utilisateur n'existe pas déjà, le crée et le persiste dans la base de données */
		if ($user == false) 
		{
			$newUser = new utilisateur($identifiantInscription, sha1($mdpInscription), $nomInscription, $prenomInscription, $avatarInscription);
			$em->persist($newUser);
			$em->flush(); /* Appliquer les changements dans la base de données */
			
			return $newUser; /* Retourne le nouvel utilisateur créé */
		} 
		else 
		{
			/* L'utilisateur existe déjà, retourne null ou gère cette situation */
			return null;
		}
	}

}
?>
