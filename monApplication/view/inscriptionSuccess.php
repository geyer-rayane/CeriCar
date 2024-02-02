<?php 
/*Affichage du formulaire d'inscription utilisateur */
echo '
  <div class="copieW3 w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-user-plus w3-margin-right"></i>Inscription</h2>
    </div>
    <div class="w3-container w3-f0f0f0 w3-padding-16">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label>Identifiant</label>
            <input class="w3-input w3-border" placeholder="" type="text" id="identifiantInscription" name="identifiantInscription" style="font-size: 14px;">
          </div>
          <div class="w3-half">
            <label>Mot de passe</label>
            <input class="w3-input w3-border" type="password" id="mdpInscription" placeholder="" name="mdpInscription" style="font-size: 14px;">
          </div>
        </div>
		<div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label>Nom</label>
            <input class="w3-input w3-border" placeholder="" type="text" id="nomInscription" name="nomInscription" style="font-size: 14px;">
          </div>
          <div class="w3-half w3-margin-bottom">
            <label>Prénom</label>
            <input class="w3-input w3-border" placeholder="" type="text" id="prenomInscription" name="prenomInscription" style="font-size: 14px;">
          </div>
        </div>
		<div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label>Lien avatar</label>
            <input class="w3-input w3-border" placeholder="optionnel" type="text" id="avatarInscription" name="avatarInscription" style="font-size: 14px;">
          </div>
        </div>
        <button class="w3-button w3-dark-grey" type="button" value="Rechercher" onclick="tentativeInscription()">Inscription</button>
    </div>
  </div>
';
?>
