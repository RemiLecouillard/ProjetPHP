<?php

include("fonctionOrac.php");
include("fonctionsUtiles.php");
if(isset($_POST['supp'])){
  $req = "delete from tdf_coureur where N_COUREUR = ".$_POST['N_COUREUR'];
  echo $req;
  $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
  $req = utf8_decode($req);
  $cur = PreparerRequete($conn,$req);
  $res = ExecuterRequete($cur);
  oci_commit($conn);
  FermerConnexion($conn);
  header('Location: afficherCoureur.php');
}
if(isset($_POST['modif']) || isset($_POST['modifier'])){
  include("modifCoureur.php");
  if(isset($_POST['modifier'])){
    include("traiterAjoutCoureur.php");
    echo $prenom.$nom;
    echo "on est là";
    echo $_POST['N_COUREUR'];
  }
  
}
 if(isset($_POST['visualiser'])){
   include("menu.html");
   echo "<html>
  <meta charset='UTF-8'/>
  <head><link rel='stylesheet' href='designForm.css' type='text/CSS' /></head>";
   echo "<div class='form-style-2-heading' >Palmares de ".$_POST['NOM']." ".$_POST['PRENOM']."</div></br>";
  $req = "select annee, n_epreuve, rang_arrivee  from tdf_coureur cou join tdf_temps tps using(N_COUREUR) where N_COUREUR = ".$_POST['N_COUREUR'];
  $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
  $req = utf8_decode($req);
  $cur = PreparerRequete($conn,$req);
  $res = ExecuterRequete($cur);
  $nb = LireDonnees1($cur, $donnees);
  AfficherDonnee1($donnees, $nb);
  FermerConnexion($conn);
}


?>