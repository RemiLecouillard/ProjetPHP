<?php
	include("fonctionOrac.php");
	$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	$req = "SELECT code_tdf FROM tdf_pays";
	$req = utf8_decode($req);
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	
	
	
	foreach($donnees as $liste){
			
			$nom=$liste["NOM"];
			$code=$liste["CODE"];
			echo "<option value=$code>$nom </option>";
		}
	}


?>