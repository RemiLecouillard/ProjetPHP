<html>
	
	<!-- Formulaire pour l'ajout d'un coureur -->
	
  <meta charset='UTF-8'/>
  <head><link rel="stylesheet" href="designForm.css" type="text/CSS" /></head>
  <?php include("menu.html");
    include("fonctionOrac.php");
    include("fonctionsUtiles.php");
    ?>
  <div class="form-style-2">
    <div class="form-style-2-heading">Ajout d'un coureur</div>
    <form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
      
      <label for="NOM"><span>Nom : <span class="required">*</span></span>
        <input name="NOM" id="NOM" value="<?php verifierRempli('NOM') ?>"/></label>
    </br>
      
      <label for="PRENOM"><span>Prénom : <span class="required">*</span></span>
        <input name="PRENOM" id="PRENOM" value="<?php verifierRempli('PRENOM') ?>"/></label>
    </br>
      
      <label for="ANNEE_NAISSANCE"><span> Année de Naissance : </span>
        <input name="ANNEE_NAISSANCE" id="ANNEE_NAISSANCE" type="number" value="<?php verifierRempli('ANNEE_NAISSANCE') ?>" /></label>
    </br>
      
      <label for="code_tdf"><span> Pays : <span class="required">*</span> </span>
        <select name="code_tdf" id="code_tdf">
          <option value="" selected> Code Pays</option>
          <?php include("codeTdf.php"); ?>
        </select></label>
      
      <label for="anneePrem"><span> Année du premier tour : </span>
        <input name="anneePrem" id="anneePrem" type="number" value="<?php verifierRempli('anneePrem') ?>" /></label>
    </br>
      
      <input name="envoyer" id="envoyer" value="Ajouter" type="submit"/>
      
    </form>
  </div>
  <?php include("traiterAjoutCoureur.php");
    try{
      ajoutable();
    }catch (Exception $e) {
      echo 'Erreur : '.$e->getMessage()."\n";
    }; ?>
  
</html>