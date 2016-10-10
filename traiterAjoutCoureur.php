<?php
include("traiterPrenom.php");
include("traiterNom.php");
include("fonctionsTraitement.php");
include("fonctionOrac.php");

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
					echo "Le prénom que vous avez rentrez a été modifier en ".$prenom."</br>";
				if($nom != $_POST["nom"])
					echo "Le nom que vous avez rentrez a été modifier en ".$nom."</br>";
				
				//Insertion dans la base
				// $conn = OuvrirConnexion('ETU2_62', 'remixav2016','info');
				// $req = "Insert into  ";
				// $cur = PreparerRequete($conn,$req);
				// ExecuterRequete($cur);
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