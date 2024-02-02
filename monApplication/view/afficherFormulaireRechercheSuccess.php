<?php
/*Affichage du formulaire de recherche de voyage */
echo '
  <div class="copieW3 w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-car w3-margin-right"></i>Recherche</h2>
    </div>
    <form method="post" onsubmit="event.preventDefault(); voyageScript();">       
      <div class="w3-container w3-#f5f5f5 w3-padding-16">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label>Départ</label>
            <input class="w3-input w3-border" type="text" placeholder="" id="depart" name="depart">
          </div>
          <div class="w3-half">
            <label> Arrivée</label>
            <input class="w3-input w3-border" type="text" id="arrivee" placeholder="" name="arrivee">
          </div>
        </div>
        <div class="w3-half">
          <label for="escaleCheckbox">Avec escale</label>
          <input type="checkbox" id="escaleCheckbox" name="escaleCheckbox" onclick="checkBoxModif()">
        </div>  
        <div class="w3-half">    
          <label for="nbrePlaces">Nombre de places :</label>
          <select id="nbrePlaces" name="nbrePlaces">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <button class="w3-button w3-dark-grey" type="submit" value="Rechercher">Rechercher</button>
      </div>
    </form>
  </div>
';
?>
