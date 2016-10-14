<?php
include("traiterPrenom.php");
include("traiterNom.php");
include("fonctionsTraitement.php");
include("fonctionOrac.php");

function calculerNumeroCoureur(){
	$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	$req = "SELECT max(n_coureur)+1 FROM tdf_coureur";
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	$committed = oci_commit($conn);
	FermerConnexion($conn);
	return $donnees['MAX(N_COUREUR)+1'][0];
}

if(isset($_POST["envoyer"])){
	if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["anneeNais"]) && !empty($_POST["pays"]) && !empty($_POST["anneePrem"])){
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		if($prenom == "lance" && $nom == "armstrong")
			echo "On ne rajoute pas de tricheur";
		else{
			$prenom = traiterPrenom($prenom);
			$nom = traiterNom($nom);
			if($prenom != "-1" && $nom != "-1"){
				if($prenom != $_POST["prenom"])
					echo "Le prénom que vous avez rentré a été modifié en ".$prenom."</br>";
				if($nom != $_POST["nom"])
					echo "Le nom que vous avez rentré a été modifié en ".$nom."</br>";
				

				//Insertion dans la base
				$code = calculerNumeroCoureur();
				$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
				$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, annee_prem) values (".$code.",'".$nom."','".$prenom."','".$_POST["pays"]."',".$_POST["anneeNais"].",".$_POST["anneePrem"].")";
				$req = utf8_decode($req);
				$cur = PreparerRequete($conn,$req);
				$res = ExecuterRequete($cur);
				$committed = oci_commit($conn);
				FermerConnexion($conn);
			}
			else{
				if($prenom == "-1")
					echo "</br> le prénom rentré n'est pas valide";
				if($nom == "-1")
					echo "</br> le nom rentré n'est pas valide";
			}
			

			
		}

	}
	else
		echo "</br>Veuillez rentrer tout les champs.";
}


?>