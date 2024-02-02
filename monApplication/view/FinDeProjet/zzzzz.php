<?php public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		$context->notification="notification ".$request['action'] ;
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{				
		$context->notification="notification ".$request['action'] ;
		return context::SUCCESS;

	}

	public static function superTest($request,$context)
	{
		$context->mavariable="superTest ".$request['val1']." ".$request['val2'] ;
		$context->notification="notification ".$request['action'] ;
		return context::SUCCESS;
	}	
	
	//Fonction permettant de tester les fonctions de l'étape 2 sur la vue login via loginSuccess.php 
	public static function login($request,$context)
	{
		
		//Test getUserByLoginAndPass
		$context->login= utilisateurTable::getUserByLoginAndPass('User1','0bc8658ea4e2f64af9d6890eace91a819f9f2046') ;
		//Via le loginSuccess.php on affichera le trajet reliant Paris et Lyon et son identifiant  
		$context->trajet= trajetTable::getTrajet('Paris','Lyon') ;
		//Test getVoyagesByTrajet. On utilise le trajet précédent 
		$context->voyageAssocies = voyageTable::getVoyagesByTrajet($context->trajet) ;
		//Test getReservationByVoyage. On utilise le tableau de voyages précédent en utilisant le premier
		$context->reservationAssocies = reservationTable::getReservationByVoyage($context->voyageAssocies[0]) ;
		//Test getUserById 
		$context->getUserById = utilisateurTable::getUserById(1) ;
		return context::SUCCESS;
	}		

	 ?>
	 
	 
	 
	 <!DOCTYPE html>
<html>
<head>
  <title>Voyage</title>
  <style>
    /* Style pour le formulaire */
    form {
      background-color: #f9f9f9; /* Nouvelle couleur de fond du formulaire */
      padding: 20px; /* Espacement intérieur du formulaire */
      width: 300px; /* Largeur du formulaire */
      border-radius: 8px; /* Bordures arrondies */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre autour du formulaire */
      margin: 50px auto; /* Centrage horizontal avec des marges */
    }

    /* Style pour les labels */
    label {
      display: block; /* Affichage en bloc pour placer les labels sur une ligne */
      margin-bottom: 5px; /* Espacement entre les labels */
      color: #3498db; /* Couleur du texte des labels */
    }

    /* Style pour les champs de texte */
    input[type="text"] {
      width: 100%; /* Largeur maximale pour les champs de texte */
      padding: 8px; /* Espacement intérieur des champs de texte */
      margin-bottom: 10px; /* Espacement entre les champs de texte */
      border: 1px solid blue; /* Bordure autour des champs de texte */
      border-radius: 4px; /* Bordures arrondies */
      box-sizing: border-box; /* Inclure la bordure dans la largeur totale */
    }

    /* Style pour le bouton submit */
    input[type="submit"] {
      background-color: #3498db; /* Couleur de fond du bouton */
      color: white; /* Couleur du texte du bouton */
      padding: 10px 20px; /* Espacement intérieur du bouton */
      border: none; /* Pas de bordure */
      border-radius: 4px; /* Bordures arrondies */
      cursor: pointer; /* Curseur pointeur au survol */
    }
  </style>
</head>
<body>
<!-- Formulaire avec champ de texte -->
<form>
  <label for="aller">Départ :</label>
  <input type="text" id="aller" name="aller">
  <br>
  <label for="retour">Arrivée :</label>
  <input type="text" id="retour" name="retour">
  <input type="submit" value="Envoyer" onclick="voyageScript()">
</form>

</body>
</html>
