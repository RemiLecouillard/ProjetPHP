<?php
include("fonctionOrac.php");
include("menu.html");
if(isset($_POST['visualiser'])){
  $req = "select cou.N_coureur, nom, prenom, annee, rang_arrivee from tdf_coureur cou join tdf_temps tps on tps.N_COUREUR = cou.N_COUREUR where N_COUREUR = ".$_POST['num'];
  $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
  $req = utf8_decode($req);
  $cur = PreparerRequete($conn,$req);
  $res = ExecuterRequete($cur);
  oci_commit($conn);
  FermerConnexion($conn);
}
else echo "nope";
?>