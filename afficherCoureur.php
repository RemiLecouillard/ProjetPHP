
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="afficheCoureur"/>
			<label for="nom"> Nom : </label>
			<input name="nom" id="nom"/>
			</br>

			<label for="prenom"> Prenom : </label>
			<input name="prenom" id="prenom"/>
			</br>
<label for="annee_naissance"> Année de Naissance : </label>
			<input name="annee_naissance" id="annee_naissance" type="number" />
			</br>

			<label for="code_tdf"> Pays : </label>
			<select name="code_tdf" id="code_tdf">
				<option value="" selected> >Code Pays</option>
				<?php include("codeTdf.php"); ?>
			</select>
			</br>

			<label for="annee_Prem"> Année du premier tour : </label>
			<input name="annee_Prem" id="annee_Prem" type="number" />
		
			</br>
			Date d'insertion :
			<input name="date_Insert" id="date_Insert" type="date" />
			</br>
			
			<input name="rechercher" id="rechercher" type="submit" value="rechercher"/>
		</form>
		
	
		<?php include("traiterAfficherCoureur.php"); ?>
	</body>
</html>