 <?php
//Fonction qui renvoie une erreur
function validiteChaine($ch){
	if(alphabetFr($ch) && caractereExist($ch))
		return true;
	else return false;
}
// Seul l'alphabet français, les accents français, les apostrophe, tirets et espaces sont autorisés
function alphabetFr($ch){
	if(preg_match("/[^a-zA-Z0-9àâäéèêëïîôöùûüçÉÈÊËÎÏÔÖÛÜÙÂÀÄ' -]|[!$%&]/", $ch)){
		return false;
	}
	else{ return true;}
}

//La chaine doit contenir des lettres
function caractereExist($ch){
	if(preg_match("/[-a-zA-Z0-9àâäéèêëïîôöùûü]/", $ch)){
	return true;
	
	}
	else{
		return false;}
}
//faire double tiret interdit
function doubleTiretInterdit($ch){
	if(preg_match("/--/", $ch)){
		return false;
	}
	else
		return true;
}

//S'il y a plusieurs doubles tirets, la chaîne est interdite
function plsrsDoubleTiretNom($ch){
		
		$tab = explode("--", $ch);
		
		if(count($tab)>2){
			return false;
		}
		else
			return true;
}

//Verification de la longueur après toutes les transformations
function longChaine($ch){

	if(iconv_strlen($ch)>31)
		return false;
	else return true;

}

//Fonctions de transformation de la chaine ----------------------------------------------------------------------------
function traitementChaine($ch){
	$ch=plsrsApostrophes($ch);
	$ch=plsrsEspaces($ch);
	$ch=SupprimeEspaceAutourTiret($ch);
	return $ch;
}
//Tous

function transfoApos($ch){
	$apo = array('\'');
	$truc = array('/‘/');
	$ch2 = preg_replace($truc, $apo, $ch);
	return $ch2;
}
//Les premiers et derniers termes doivent être des lettres ou des apostrophes
function premierTerme($ch){
	$ch2 = $ch;
	while(strpos($ch2, " ") === 0 || strpos($ch2, "-") === 0 || strrpos($ch2, " ") == strlen($ch2)-1 || strrpos($ch2, "-") == strlen($ch2)-1){
		$ch2 = trim($ch2);
		$ch2 = trim($ch2, "-");
	}
	return $ch2;
}

//S'il y a plusieurs apostrophes ils sont remplacés par une simple
function plsrsApostrophes($ch){
	$ch2 = $ch;
	if(strpbrk( "/[']{2,}/",$ch2) ){
		$ch2=preg_replace ( "/[']{2,}/", "'", $ch2);
		}

	
	return $ch2;
	
}

//S'il y a plusieurs espaces ils sont remplacés par un seul
function plsrsEspaces($ch){
	$ch2 = $ch;
	if(strpbrk( "/[[:space:]]{2,}/",$ch2) ){
		$ch2=preg_replace ( "/[[:space:]]{2,}/", " ", $ch2);
	}
	
	return $ch2;
	
}

//Les espaces autour d'un tiret ou double tiret sont supprimés
function SupprimeEspaceAutourTiret($ch){

	$tab = explode("-", $ch);
	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]= trim($tab["$i"]);
	}
	$ch2= implode("-", $tab);
	return $ch2;
}

//Nom

//S'il y a plus de deux tirets, ils sont remplacés par un double tiret
function doubleTiretNom($ch){
	$ch2 = $ch;
	if(strpbrk( "/[-]{3,}/",$ch2) ){
		$ch2=preg_replace ( "/[-]{3,}/", "--", $ch2);
		}


		return $ch2;
		
}


//S'il y a des lettres avec accent, on enlève les accents. Le nom est mis en majuscule
function nomMaj($ch){
	$ch2 = $ch;
	if(preg_match("/[àâäéèêëïîôöùûüÉÈÊËÎÏÔÖÛÜÙÂÀÄ]/", $ch)){
		$accent = array('/à/','/â/','/ä/','/é/','/è/','/ê/','/ë/','/ï/','/î/','/ô/','/ö/','/ù/','/û/','/ü/', '/É/', '/È/', '/Ê/', '/Ë/', '/Î/', '/Ï/', '/Ô/', '/Ö/', '/Û/', '/Ü/', '/Ù/', '/Â/', '/À/', '/Ä/');
		$replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','u', 'E', 'E', 'E', 'E', 'I', 'I', 'O', 'O', 'U', 'U', 'U', 'A', 'A', 'A', 'I', 'I');
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
	$ch = mettreMinuscule($ch);
	if(preg_match("/[[:space:]]/", $ch)){
		$ch=espaceMaj($ch);
	}

	if(preg_match('/-/', $ch)){ 
		$ch=tiretMaj($ch);
	
	}

	if(preg_match("/'/", $ch)){ 
		$ch=apostropheMaj($ch);
	}

	else {
		$ch=premiereLettreAccent($ch);
		$ch=ucfirst($ch);
	}

	return $ch;
	
}

	//Pour chaque terme suivant un apostrophe, on le met en majuscule 

function apostropheMaj($ch){
	$tab = explode("'", $ch);

	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]=premiereLettreAccent($tab["$i"]);
		$tab["$i"]=ucfirst($tab["$i"]);
	}

	$ch2= implode("'", $tab);

	return $ch2;

}
function mettreMinuscule($ch){
		$accent = array('/É/', '/È/', '/Ê/', '/Ë/', '/Î/', '/Ï/', '/Ô/', '/Ö/', '/Û/', '/Ü/', '/Ù/', '/Â/', '/À/', '/Ä/');
		$replace = array('é','è','ê','ë', 'î', 'ï', 'ô', 'ö', 'û', 'ü', 'ù', 'â', 'à', 'ä');
		$ch = preg_replace($accent,$replace,$ch);
		$ch = strtolower($ch);
		return $ch;
}

//Cette fonction sert pour la mise en majuscule --> On remplace les accents par les lettres correspondantes
function premiereLettreAccent($ch){
	if(preg_match("/^[àâäéèêëïîôöùûü]/", $ch)){
		$accent = array('/^à/','/^â/','/^ä/','/^é/','/^è/','/^ê/','/^ë/','/^ï/','/^î/','/^ô/','/^ö/','/^ù/','/^û/','/^ü/', '/^É/', '/^È/', '/^Ê/', '/^Ë/', '/^Î/', '/^Ï/', '/^Ô/', '/^Ö/', '/^Û/', '/^Ü/', '/^Ù/', '/^Â/', '/^À/', '/^Ä/');
		$replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','u', 'E', 'E', 'E', 'E', 'I', 'I', 'O', 'O', 'U', 'U', 'U', 'A', 'A', 'A', 'I', 'I');
		$ch2 = preg_replace($accent,$replace,$ch);
		$ch2 = strtolower($ch2);
		return $ch2;
	}
	else return $ch;
}

	
	//Pour chaque terme suivant un tiret, on le met en majuscule 
function tiretMaj($ch){
		
	$tab = explode("-", $ch);
	for( $i=0;$i< count($tab) ;$i++){
		$tab["$i"]=premiereLettreAccent($tab["$i"]);
		$tab["$i"]=ucfirst($tab["$i"]);
	}

	$ch2= implode("-", $tab);
	return $ch2;

}

	//Pour chaque terme suivant un espace, on le met en majuscule 
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