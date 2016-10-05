<?php
include("fonctionsTraitement.php");

include("traiterNom.php");
include("traiterPrenom.php");
echo transfoApos("‘");
$ch = strtoupper("àâäéèêëïîôöùûü");
echo $ch;
function test($ch){
	echo "<td>".$ch."</td><td>";
	traiterNom($ch);
	echo "</td><td>";
	traiterPrenom($ch);
	echo "</td></tr>";
}
if(alphabetFr("é-bé"))
	echo "vrai ";
else
	echo "faux ";
if(validiteChaine("Ébé-ébé"))
	echo "valide ";
else
	echo "non valide ";


echo "<meta charset='UTF-8'/>";
echo "<table> <tr> <th>Truc</th> <th>NOM</th> <th>Prenom</th</tr><tr>";
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
test("-péron-de - la   branche-");
test("'");
test("aa—bb—cc");
test("A ‘ ‘ b");
test("A ‘‘ b");
test("bénard     ébert");



?>