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

/*
$ch = "'salut'salut'";
$ch = doublerApostrophe($ch);
echo $ch."</br>";
$ch = "'salut'salut";
$ch = doublerApostrophe($ch);
echo $ch."</br>";
$ch = "salut'salut'";
$ch = doublerApostrophe($ch);
echo $ch;*/
  $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
  $req = "SELECT NOM,CODE_TDF  FROM tdf_pays";
  $req = utf8_decode($req);
  $cur = PreparerRequete($conn,$req);
  $res = ExecuterRequete($cur);
  $nb = LireDonnees1($cur,$donnees);
  print_r($donnees);
  $i = 0;
  while($i < count($donnees["NOM"])){
        $nom=$donnees["NOM"][$i];
        $code=$donnees["CODE_TDF"][$i];
      echo "<option value=$code ";
         // VerifSelect("code_tdf",$codeTdf);
      echo ">$nom </option>";
    $i = $i + 1;
    }
 
?>