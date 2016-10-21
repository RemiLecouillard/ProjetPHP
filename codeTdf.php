<?php
	include("fonctionOrac.php");
	$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	$req = "SELECT distinct code_tdf FROM tdf_coureur";
	$req = utf8_decode($req);
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	
	
	
	foreach($donnees as $cle=>$contenu){
		foreach($contenu as $cle=$codeTdf){
		echo "<option value=$codeTdf>$codeTdf</option>";
		}
	}


?>