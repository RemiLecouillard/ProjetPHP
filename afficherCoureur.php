
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="designForm.css" type="text/CSS" />
	</head>
	<body>
		<?php include("menu.html"); ?>
		<div class="form-style-2">
		<div class="form-style-2-heading">Rechercher un coureur</div>
		<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="afficheCoureur"/>
			<label for="nom"><span> Nom :</span> 
			<input name="nom" id="nom"/></label>
			</br>

			<label for="prenom"><span> Prenom :</span> 
			<input name="prenom" id="prenom"/></label>
			</br>

			<label for="anneeNais"><span> Année de Naissance :</span>
			<input name="anneeNais" id="anneeNaiss" type="number" /> </label>
			</br>

<<<<<<< HEAD
			<label for="code_tdf"> Pays : </label>
			<select name="code_tdf" id="code_tdf">
				<option value="" selected> >Code Pays</option>
=======
			<label for="pays"><span> Pays : </span>
			<select name="pays" id="pays">
>>>>>>> origin/master
				<?php include("codeTdf.php"); ?>
			</select></label>
			</br>

			<label for="anneePrem"><span> Année du premier tour : </span>
			<input name="anneePrem" id="anneePrem" type="number" /></label>
		
			</br>
			<label for="dateInser">
			<span>Date d'insertion :</span>
			<input name="dateInser" id="dateInser" type="date" /></label>
			</br>
			
			<input name="rechercher" id="rechercher" type="submit" value="rechercher"/>
		</form>
		</div>
	
		<?php include("traiterAfficherCoureur.php"); ?>
	</body>
</html>