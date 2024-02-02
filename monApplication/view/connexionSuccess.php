<?php 
/*Affichage du formulaire de connexion utilisateur */
echo '	
  <div class="copieW3 w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-user w3-margin-right"></i>Connexion</h2>
    </div>
    <div class="w3-container w3-#f0f0f0 w3-padding-16">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-person-o"></i> Identifiant</label>
            <input class="w3-input w3-border" placeholder="" type="text" id="identifiant" name="identifiant">
          </div>
          <div class="w3-half">
            <label>Mot de passe</label>
            <input class="w3-input w3-border" type="password" id="mdp" placeholder="" name="mdp">
          </div>
        </div>
        
        <button class="w3-button w3-dark-grey" type="submit" value="Rechercher" onclick="tentativeConnexion()">Connexion</button>
    </div>
  </div>
';
?>
