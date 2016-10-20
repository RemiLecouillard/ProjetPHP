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

function regarderDejaPresent($nom, $prenom){
	$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	$req = "SELECT count(*) FROM tdf_coureur where nom ='".$nom."' and prenom ='".$prenom."'";
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	$committed = oci_commit($conn);
	FermerConnexion($conn);
	if($donnees['COUNT(*)'][0] == 0)
		return false;
	else
		return true;
}
function anneeActuel(){
	return 2016;
}

if(isset($_POST["envoyer"])){
	$test = true;
	if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["pays"])){
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
				if(!regarderDejaPresent($nom, $prenom)){
					if(!empty($_POST["anneeNais"])){
						if(anneeActuel() - $_POST["anneeNais"] < 18)
							$test = false;
						if(!empty($_POST["anneePrem"]))
							if($_POST["anneePrem"] - $_POST["anneeNais"] < 18)
								$test = false;
					}
						if($test){//Ce test ne marche pas encore

							//Insertion dans la base
							$code = calculerNumeroCoureur();
							$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
							
							//création de la requete
							$req = "";
							if(!empty($_POST["anneeNais"]) && !empty($_POST["anneePrem"]))
								$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, annee_prem, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["pays"]."',".$_POST["anneeNais"].",".$_POST["anneePrem"].", sysdate, 'ETU2_58')";
							else if(!empty($_POST["anneeNais"]))
								$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["pays"]."',".$_POST["anneeNais"].", sysdate, 'ETU2_58')";
							else if(!empty($_POST["anneePrem"]))
								$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_prem, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["pays"]."',".$_POST["anneePrem"].", sysdate, 'ETU2_58')";
							else
								$req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["pays"]."', sysdate, 'ETU2_58')";
							$req = utf8_decode($req);
							
							$cur = PreparerRequete($conn,$req);
							$res = ExecuterRequete($cur);
							$committed = oci_commit($conn);
							FermerConnexion($conn);
						}
						echo "L'age du coureur n'est pas valide";
				}
				else
					echo "Ce coureur est déja présent dans la base";
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