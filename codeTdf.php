<?php
	include("fonctionOrac.php");
	
	$req = utf8_decode($req);
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	$req = "SELECT distinct code_tdf FROM tdf_coureur";
	
	foreach($donnees as $cle=>$codeTdf){
		echo "<option value=".$codeTdf.">".$codeTdf."</option>";
	}


?>