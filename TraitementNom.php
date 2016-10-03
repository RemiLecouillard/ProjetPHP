<?php
//Fonction qui renvoi une erreur
//On n'accepte pas les chaînes avec des caractères autres que l'alphabet normal français, les accents français, les apostrophe, tirets et espaces
function alphabetFr($ch){
	
	if(preg_match("/[^-a-zA-Z0-9àâäéèêëïîôöùûü -']/", $ch)){
	return false;
	
	}
	else return true;
}

//Si la chaîne n'a que des caractères tels que l'apostrophe ou le tiret qui sont utilisés (soit aucune lettre) alors la chaîne est fausse
function caractereExist($ch){
	if(preg_match("/[-a-zA-Z0-9àâäéèêëïîôöùûü]/", $ch)){
	return true;
	
	}
	else return false;
}
//faire double tiret interdit


//S'il y a plusieurs double tirets, la chaîne est interdite
function plsrsDoubleTiretNom($ch){
		
		$tab = explode("--", $ch);
		
		if(count($tab)>2){
			return false;
		}
		else
			return true;
}


//Fonctions de transformation de la chaine

//Tous
function premierTerme($ch){
	$ch2 = $ch;
	while(strpos($ch2, " ") === 0 || strpos($ch2, "-") === 0 || strrpos($ch2, " ") == strlen($ch2)-1 || strrpos($ch2, "-") == strlen($ch2)-1){
		$ch2 = trim($ch2);
		$ch2 = trim($ch2, "-");
	}
	return $ch2;
}

//S'il y a plusieurs apostrophes, on les remplace par une simple
function plsrsApostrophes($ch){
	
if(strpbrk( "/[']{2,}/",$ch) ){
	$ch2=preg_replace ( "/[']{2,}/", "'", $ch);
	}

	
	return $ch2;
	
}
//S'il y a plusieurs espaces, on les remplace par un seul
function plsrsEspaces($ch){
if(strpbrk( "/[[:space:]]{2,}/",$ch) ){
	$ch2=preg_replace ( "/[[:space:]]{2,}/", " ", $ch);
	}
	
	return $ch2;
	
}
function SupprimeEspaceAutourTiret($ch){

	$tab = explode("-", $ch);
	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]= trim($tab["$i"]);
	}
	$ch2= implode("-", $tab);
	return $ch2;
}

//Nom

function doubleTiretNom($ch){
		
	if(strpbrk( "/[-]{3,}/",$ch) ){
		$ch2=preg_replace ( "/[-]{3,}/", "--", $ch);
		}


		return $ch2;
		
}


//S'il y a des lettres avec accent, on enlève les accents, puis on met le nom en majuscule
function nomMaj($ch){
	
	if(preg_match("/[àâäéèêëïîôöùûü]/", $ch)){
		$accent = array('/à/','/â/','/ä/','/é/','/è/','/ê/','/ë/','/ï/','/î/','/ô/','/ö/','/ù/','/û/','/ü/');
		$replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','u');
		$ch2 = preg_replace($accent,$replace,$ch);

	}
	$ch3=strtoupper($ch2);
	return $ch3;
}


//Prenom

//S'il y a des espaces ou des tirets, on appelle les fonctions qui mettent des majuscules à chaque mot après un espace ou un tiret ou une apostrophe
//sinon on met seulement la première lettre en majuscule
//On enlève l'accent de la première lettre pour le mettre en majuscule
function prenomMaj($ch){
	
	if(preg_match("/[[:space:]]/", $ch)){
		$ch=espaceMaj($ch);
	}
	
	if(preg_match('/-/', $ch)){ 
		$ch=tiretMaj($ch);
	
	}
	if(preg_match("'", $ch)){ 
		$ch=apostropheMaj($ch);
	
	}
	else {
		$ch=ucfirst($ch);
		$ch=premiereLettreAccent($ch);
	}
	return $ch;
	
}


function apostropheMaj($ch){
	$tab = explode("'", $ch);

	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]=premiereLettreAccent($tab["$i"]);
		$tab["$i"]=ucfirst($tab["$i"]);
	}

	$ch2= implode("'", $tab);

	return $ch2;

}

//Cette fonction sert pour la mise en majuscule --> On remplace les accents par les lettres correspondantes
	function premiereLettreAccent($ch){
	if(preg_match("/^[àâäéèêëïîôöùûü]/", $ch)){
		$accent = array('/^à/','/^â/','/^ä/','/^é/','/^è/','/^ê/','/^ë/','/^ï/','/^î/','/^ô/','/^ö/','/^ù/','/^û/','/^ü/');
		$replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','u');
		$ch2 = preg_replace($accent,$replace,$ch);

		return $ch2;
	}
	else return $ch;
	}

	function tiretMaj($ch){
		
	$tab = explode("-", $ch);
	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]=premiereLettreAccent($tab["$i"]);
		$tab["$i"]=ucfirst($tab["$i"]);
	}

	$ch2= implode("-", $tab);
	return $ch2;

	}

	//Pour chaque terme suivant un espace, on le met en majuscule (pour le prénom)
function espaceMaj($ch){
	
$tab = explode(" ", $ch);
for( $i=0;$i< count($tab) ;$i++){
	$tab["$i"]=premiereLettreAccent($tab["$i"]);
	$tab["$i"]=ucfirst($tab["$i"]);
}

$ch2= implode(" ", $tab);
return $ch2;

}


?>