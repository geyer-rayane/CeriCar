<!DOCTYPE html>
<meta charset="UTF-8">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CERICAR</title>
  <link rel="stylesheet" type="text/css" href="https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,200" /> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous">
<!-- Apercu du style -->
<style> 
    body, h1, h2, h3, h4, h5, h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
    myLink {display: none} 
</style>
	
<!-- Inclusion des scripts JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
  <script type="text/javascript" src="js/fonction.js" charset="UTF-8"></script>
</head>

<body>
  <!-- Div contenant le header : barre de menu -->
  <div id="affichageHeader">
  <div class="w3-bar w3-white w3-border-bottom w3-xlarge">
	<a class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourAccueil()">
		<b><i class="material-symbols-outlined" style="vertical-align: middle ;">directions_car</i><span style="vertical-align: middle;">CERICAR</span></b>
	</a>
    <a  class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourRecherche()">
      <b><i></i>Recherche</b>
    </a>
    <a  class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="retourIncription()">
      <b><i></i>Inscription</b>
    </a>
	<a  class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="retourConnexion()">
      <b><i></i>Connexion</b>
    </a>
  </div>
  </div>

  <!-- Div ou incrémentera les messages avec des onclick et du JS : bandeau de notification -->
  <h1>  
  <div id="affichageBandeau">
  </div>
  </h1>

<!-- Div gérant ce qui est implanté dans l'accueil -->
  <div id="affichageAccueil"> 
	<?php
	/* Affichage du gif de voiture rouge disponible à l'accueil */
	$imagePath1 = 'https://pedago.univ-avignon.fr/~uapv2307467/squelette_L3/images/car-driving.gif';
	echo '<h2 class="greyBackground">
	CERICAR : la solution de coivoiturage moderne et écologique !
	<br>
	<img src="' . $imagePath1 . '" class="fixerImageAccueilA"></h2>';	
	?>
  </div>  
  
<!-- Div ou incrémentera les formulaires avec des onclick et du JS -->
  <div class="fixerDivFormulaire" id="affichageFormulaire"></div>
  
<!-- Div ou incrémentera les informations de l'utilisateur avec onclick et du JS-->  
  <div class="fixerDivProfil" id="affichageProfil"></div> 

<!-- Div ou incrémentera les voyages a afficher avec des onclick et du JS -->      
  <div class="fixerDivVoyage" id="affichageVoyage"></div>

<!-- Meme idée -->    
  <div class="fixerDivPropositionVoyage" id="affichagePropositionVoyage"></div>


<!-- Contenu PHP -->
	<div>   
<?php if($context->getSessionAttribute('user_id')): ?>
<?php echo $context->getSessionAttribute('user_id')." est connecté"; ?>
<?php endif; ?>
	</div>  
 
</body>
</html>
