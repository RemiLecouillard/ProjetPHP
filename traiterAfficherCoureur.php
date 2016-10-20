<?php
include("fonctionOrac.php");
if(isset($_POST["envoyer"])){
	if(!empty($_POST["nom"]) || !empty($_POST["prenom"]) || !empty($_POST["anneeNais"]) || !empty($_POST["pays"]) || !empty($_POST["anneePrem"]) || !empty($_POST["dateInser"])){
		$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
	}
}
?>