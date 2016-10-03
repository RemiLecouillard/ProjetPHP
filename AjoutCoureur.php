<html>
nom, prenom, année nais, code tdf(pays), annee premier tour
	<meta charset='UTF-8'/>

	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<label for="nom"> Nom : </label>
		<input name="nom" id="nom"/>
		</br>

		<label for="prenom"> Prenom : </label>
		<input name="prenom" id="prenom"/>
		</br>

		<label for="anneeNais"> Année de Naissance : </label>
		<input name="anneeNais" id="anneeNaiss" type="date" placeholder="JJ/MM/AAAA"/>
		</br>

		<label for="pays"> Pays : </label>
		<select name="pays" id="pays">
			<?php

			creerListe();
			?>
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
		</select>
		</br>

		<label for="anneePrem"> Année du premier tour : </label>
		<input name="anneePrem" id="anneePrem" type="date" placeholder="JJ/MM/AAAA"/>
		</br>

		<input name="envoyer" id="envoyer" type="submit"/>

	</form>

<?php

function creerListe($bdd,$sql,$table, $form){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees[$table] . '" ' ;
		VerifSelect($form, $donnees[$table]);
		echo  ' >'.$donnees[$table] . '</option>';
	}
	$reponse->closeCursor();
}


?>



</html>