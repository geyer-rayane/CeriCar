<?php 
/* Destruction de session et modification du header afin de réinitialiser les options cliquables possibles pour l'utilisateur non connecté */
session_destroy() ;
echo '<div class="w3-bar w3-white w3-border-bottom w3-xlarge">
    <a class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourAccueil()">
      <b><i class="material-symbols-outlined">directions_car</i></b>
      <span>CERICAR</span>
    </a>
    <a class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourRecherche()">
      <b><i></i>Recherche</b>
    </a>
    <a class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="retourIncription()">
      <b><i></i>Inscription</b>
    </a>
	<a class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="retourConnexion()">
      <b><i></i>Connexion</b>
    </a>
  </div>' ;
 ?>