<?php
//include("fonctionsTraitement.php");
include("traiterAjoutCoureur.php");
//include("traiterNom.php");
//include("traiterPrenom.php");
/*echo transfoApos("‘");
$ch = strtoupper("àâäéèêëïîôöùûü");
echo $ch;
function test($ch){
	echo "<td>".$ch."</td><td>";
	echo traiterNom($ch);
	echo "</td><td>";
	echo traiterPrenom($ch);
	echo "</td></tr>";
}*/

echo "<meta charset='UTF-8'/>";
/*echo "<table> <tr> <th>Truc</th> <th>NOM</th> <th>Prenom</th</tr><tr>";
test("Départ");
test("Ébé-ébé");
test("ébé-ébé");
test("éÉé-Ébé");
test("'éÉ'é-É'bé'");
test("'éæé-É'bé'");
test("'éæé-É'Ŭé'");
test("'é !é-É'Ŭé'");
test("éé''éé--uù  gg");
test("DE LA TR€UC");
test("DE LA TRUC");
test("ééééééééééééééééééééééééééééééééééééééééééééééé");
test("éééééééééééééééééééééééééééééé"); //30 caractères
test("-pééron-de - la   branche-");
test("'");
test("aa—bb—cc");
test("A ‘ ‘ b");
test("A ‘‘ b");
test("bénard     ébert");
test("àpàààp");
test("--- - - - -   Êbde-àDjndsdn    'Âhjghj---  ");
test("- SigMNd-BOuAkAr'-");
test("---------");*/
echo calculerNumeroCoureur();
				$code = calculerNumeroCoureur();
				$nom = "Fremont";
				$prenom = "Xaviere";
				$date1 = "10/10/1980";
				$date2 = "10/10/2000";
				$pays = "FRA";
				$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
				$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, annee_prem) values (".$code.",'".$nom."','".$prenom."','".$pays."',".$date1.",".$date2.")";
				echo $req."</br>";
				$req = utf8_decode($req);
				echo $req;
				$cur = PreparerRequete($conn,$req);
				ExecuterRequete($cur);
?>