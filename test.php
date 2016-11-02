<?php
include("fonctionOrac.php");
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
// fonction principale -------------------------------------------------------------------
/*echo "<PRE>";
echo "Coonnexion à la base<br>";
$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
echo "<br>identifiant : $conn<hr>";

$req = "INSERT INTO bidon VALUES(:r2,'écumoire','grise') returning ROWID into :rid ";
$cur = PreparerRequete($conn,$req);
oci_bind_by_name($cur,":rid",$rid, 32);
oci_bind_by_name($cur,":r2",$r2, 32);
$r2=70;
$res = ExecuterRequete($cur);
$r2=88;
$res = ExecuterRequete($cur);
echo "Nouvelle donnée insérée :$rid <hr />";*/

$ch = "'salut'salut'";
$ch = doublerApostrophe($ch);
echo $ch."</br>";
$ch = "'salut'salut";
$ch = doublerApostrophe($ch);
echo $ch."</br>";
$ch = "salut'salut'";
$ch = doublerApostrophe($ch);
echo $ch;
?>