  
  <html>
  <meta charset='UTF-8'/>
  <head><link rel="stylesheet" href="designForm.css" type="text/CSS" /></head>
  <?php include("menu.html"); ?>
  <div class="form-style-2">
  <div class="form-style-2-heading">modification d'un coureur</div>
  <form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
    <input type="hidden" name="N_COUREUR" value="<?php verifierRempli('N_COUREUR') ?>"/>
    <label for="NOM"><span>Nom : <span class="required">*</span></span>
    <input name="NOM" id="NOM" value="<?php verifierRempli('NOM') ?>"/></label>
    <input type ="hidden" name="EXNOM" id="EXNOM" value="<?php verifierRempli('NOM') ?>"/>
    </br>

    <label for="PRENOM"><span>Prénom : <span class="required">*</span></span>
    <input name="PRENOM" id="PRENOM" value="<?php verifierRempli('PRENOM') ?>"/></label>
    <input type ="hidden" name="EXPRENOM" id="EXPRENOM" value="<?php verifierRempli('PRENOM') ?>"/>
    </br>

    <label for="ANNEE_NAISSANCE"><span> Année de Naissance : </span>
    <input name="ANNEE_NAISSANCE" id="ANNEE_NAISSANCE" type="number" value="<?php verifierRempli('ANNEE_NAISSANCE') ?>" /></label>
    </br>

    <label for="code_tdf"><span> Pays : <span class="required">*</span> </span>
    <select name="code_tdf" id="code_tdf">
        <?php include("codeTdf.php"); ?>
    </select></label>

    <label for="ANNEE_PREM"><span> Année du premier tour : </span>
    <input name="ANNEE_PREM" id="ANNEE_PREM" type="number" value="<?php verifierRempli('ANNEE_PREM') ?>"/></label>
    </br>

    <input name="modifier" id="modifier" type="submit" value="Modifier"/>

  </form>
  </div>
  
  </html>