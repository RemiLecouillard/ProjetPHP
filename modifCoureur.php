	
	<html>
	<meta charset='UTF-8'/>
	<head><link rel="stylesheet" href="designForm.css" type="text/CSS" /></head>
	<?php include("menu.html"); ?>
	<div class="form-style-2">
	<div class="form-style-2-heading">modification d'un coureur</div>
	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<input type="hidden" name="N_COUREUR" value="<?php verifierRempli('N_COUREUR') ?>"/>
		<label for="nom"><span>Nom : <span class="required">*</span></span>
		<input name="nom" id="nom" value="<?php verifierRempli('NOM') ?>"/></label>
		</br>

		<label for="prenom"><span>Prénom : <span class="required">*</span></span>
		<input name="prenom" id="prenom" value="<?php verifierRempli('PRENOM') ?>"/></label>
		</br>

		<label for="anneeNais"><span> Année de Naissance : </span>
		<input name="anneeNais" id="anneeNaiss" type="number" value="<?php verifierRempli('ANNEE_NAISSANCE') ?>" /></label>
		</br>

		<label for="code_tdf"><span> Pays : <span class="required">*</span> </span>
		<select name="code_tdf" id="code_tdf">
				<?php include("codeTdf.php"); ?>
		</select></label>

		<label for="anneePrem"><span> Année du premier tour : </span>
		<input name="anneePrem" id="anneePrem" type="number" value="<?php verifierRempli('ANNEE_PREM') ?>"/></label>
		</br>

		<input name="modifier" id="modifier" type="submit" value="Modifier"/>

	</form>
	</div>
	
	</html>