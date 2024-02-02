<?php
/*Affichage formulaire de proposition de voyage. Permet a l'utilisateur de proposer un voyage en tant que conducteur. Visible dans la rubrique 'Mes voyages en tant que conducteur' sur le profil */ 
echo '      
  <div class="copieW333 w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-plane w3-margin-right"></i>Proposition voyage</h2>
    </div>
    <div class="w3-container w3-f0f0f0 w3-padding-16">
      <div class="w3-row-padding" style="margin:0 -16px;">
        <div class="w3-half w3-margin-bottom">
          <label>Depart</label>
          <input class="w3-input w3-border" placeholder="" type="text" id="departVoyage" name="departVoyage" style="font-size: 14px;">
        </div>
        <div class="w3-half">
          <label>Arrivee</label>
          <input class="w3-input w3-border" type="text" id="arriveeVoyage" placeholder="" name="arriveeVoyage" style="font-size: 14px;">
        </div>
      </div>
      <div class="w3-row-padding" style="margin:0 -16px;">
        <div class="w3-half w3-margin-bottom">
          <label>Contraintes</label>
          <input class="w3-input w3-border" type="text" id="contrainteVoyage" placeholder="" name="contrainteVoyage" style="font-size: 14px;">
        </div>
        <div class="w3-half w3-margin-bottom">
          <label>Heure de depart</label>
          <input class="w3-input w3-border" placeholder="" type="number" min="0" max="23" step="1" value="8" id="heureDepartVoyage" name="heureDepartVoyage" style="font-size: 14px;" pattern="^(0?([0-9]|1[0-9]|2[0-3]))$" title="Veuillez entrer un chiffre entre 0 et 23" min="0" max="23">
        </div>
      </div>
      <div class="w3-row-padding" style="margin:0 -16px;">
        <div class="w3-half w3-margin-bottom">
          <label>Tarif</label>
          <input class="w3-input w3-border" placeholder=""  type="number" min="15" max="100" step="10" value="15" id="tarifVoyage" name="tarifVoyage" style="font-size: 14px;">
        </div>
        <div class="w3-half w3-margin-bottom">
          <label>Nombre de places disponibles</label>
          <input class="w3-input w3-border" type="number" min="1" step="1" value="5"  id="nbrPlacesVoyage" name="nbrPlacesVoyage" style="font-size: 14px;">
        </div>
      </div>
      <button class="w3-button w3-dark-grey" type="submit" value="Rechercher" onclick="tentativePropositionVoyage()">Poster</button>
    </div>
  </div>
';
?>
