
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

			<label for="annee_Naissance"><span> Année de Naissance :</span>
			<input name="annee_Naissance" id="annee_Naissance" type="number" /> </label>
			</br>


			<label for="code_tdf"> Pays : 
			<select name="code_tdf" id="code_tdf">
				<option value="" selected> Code Pays</option>

				<?php include("codeTdf.php"); ?>
			</select></label>
			</br>

			<label for="annee_Prem"><span> Année du premier tour : </span>
			<input name="annee_Prem" id="annee_Prem" type="number" /></label>
		
			</br>
			<label for="date_Insert">
			<span>Date d'insertion :</span>
			<input name="date_Insert" id="date_Insert" type="date" placeholder="jj/mm/aa" /></label>
			</br>
			
			<input name="rechercher" id="rechercher" type="submit" value="rechercher"/>
		</form>
		</div>
	
		<?php include("traiterAfficherCoureur.php"); ?>
	</body>
</html>