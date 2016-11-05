<?php
  $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
  $req = "SELECT NOM,CODE_TDF  FROM tdf_pays";
  $req = utf8_decode($req);
  $cur = PreparerRequete($conn,$req);
  $res = ExecuterRequete($cur);
  $nb = LireDonnees1($cur,$donnees);
  $i = 0;
  while($i < count($donnees["NOM"])){
     $nom=$donnees["NOM"][$i];
     $code=$donnees["CODE_TDF"][$i];
     echo "<option value=$code ";
     VerifSelect("code_tdf",$donnees["CODE_TDF"][$i]);
     echo ">$nom </option>";
     $i = $i + 1;
 }

?>