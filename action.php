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
	}
	
}


?>