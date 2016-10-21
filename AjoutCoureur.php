<html>
	<meta charset='UTF-8'/>
	<head><link rel="stylesheet" href="designForm.css" type="text/CSS" /></head>
	<?php include("menu.html"); ?>
	<div class="form-style-2">
	<div class="form-style-2-heading">Ajout d'un coureur</div>
	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		
		<label for="nom"><span>Nom : <span class="required">*</span></span>
		<input name="nom" id="nom"/></label>
		</br>

		<label for="prenom"><span>Prénom : <span class="required">*</span></span>
		<input name="prenom" id="prenom"/></label>
		</br>

		<label for="anneeNais"><span> Année de Naissance : </span>
		<input name="anneeNais" id="anneeNaiss" type="number" /></label>
		</br>

		<label for="pays"><span> Pays : </span>
		<select name="pays" id="pays">
			<option value="FRA">
				France
			</option>
			<option value="BEL">
				Belgique
			</option>
			<option value="ESP">
				Espagne
			</option>
			<option value="ALM">
				Allemagne
			</option>
		</select></label>

		<label for="anneePrem"><span> Année du premier tour : </span>
		<input name="anneePrem" id="anneePrem" type="number" /></label>
		</br>

		<input name="envoyer" id="envoyer" type="submit"/>

	</form>
	</div>
	<?php include("traiterAjoutCoureur.php"); ?>

</html>