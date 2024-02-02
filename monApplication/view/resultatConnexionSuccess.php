<?php
/* Réponse à la tentative de connexion */

/* Si l'utilisateur n'existe pas (identifiant ou mot de pass incorrect) alors echec et envoi au JS de cette response */
if ($context->utilisateur == null) 
{
    echo "Pas de compte";
} 

/* Sinon on envoie sous forme d'un echo la modification necessaire dans le header */
else 
{
    echo '
	<div class="w3-bar w3-white w3-border-bottom w3-xlarge">
	<a class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourAccueil()">
		<b><i class="material-symbols-outlined" style="vertical-align: middle ;">directions_car</i><span style="vertical-align: middle;">CERICAR</span></b>
	</a>
    <a  class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourRecherche()">
      <b><i></i>Recherche</b>
    </a>
	 <a class="w3-bar-item w3-button w3-text-red w3-hover-red" onclick="retourPropositionVoyage()">
      <b><i></i>Proposer un voyage</b>
    </a>
    <a class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="retourProfil()">
      <b><i></i>Profil</b>
    </a>
	<a class="w3-bar-item w3-button w3-text-red w3-hover-red w3-right" onclick="deconnexion()">
      <b><i></i>Deconnexion</b>
    </a>
  </div>' ;
}
?>

 