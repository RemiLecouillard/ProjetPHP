<?php
include("fonctionOrac.php");
if(isset($_POST["rechercher"])){
	if(!empty($_POST["nom"]) || !empty($_POST["prenom"]) || !empty($_POST["anneeNais"]) || !empty($_POST["pays"]) || !empty($_POST["anneePrem"]) || !empty($_POST["dateInser"])){
		$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
		$req = "SELECT * FROM tdf_coureur where";
		$i=0;
		foreach($_POST as $cle=>$contenu){
			if(!empty($_POST[$cle]) && $cle != "rechercher"){
				if($i==0) $req= $req." $cle='$contenu'";
				else $req = $req." and $cle='$contenu'";
				$i++;
			}
		}
		
		$req = utf8_decode($req);
		$cur = PreparerRequete($conn,$req);
		$res = ExecuterRequete($cur);
		$nb = LireDonnees1($cur,$donnees);
		AfficherDonnee1($donnees,$nb);
		FermerConnexion($conn);
	}
}
?>