<?php
	/*
	*Traitement des chaines de caractère et modifications pour le nom et le prénom
	*/
	
	
	//-------------------------------------------------- Fonctions d'erreurs ---------------------------------------------------------------
	
	
	
  /*
  *test de validité de la chaîne
  *appel de fonction alphabetFr()
  *appel de fonction caractereExist
  */
  function validiteChaine($ch){
    if(alphabetFr($ch) && caractereExist($ch))
      return true;
    else return false;
  }
  
	/* 
	* test alphabet français
	*accents français, les apostrophe, tirets et espaces autorisés
	*/
  function alphabetFr($ch){
    if(preg_match("/[^a-zA-Z0-9àâäéèêëïîôöùûüçœæñÑÉÈÊËÎÏÔÖÛÜÙÂÀÄŒÆ' -]|[!$%&]/", $ch)){
      return false;
    }
    else{ return true;}
  }
  
	/*
	*test si la chaîne contient des lettres
	*/
  function caractereExist($ch){
    if(preg_match("/[-a-zA-Z0-9àâäéèêëïîôöùûüçœæñÑÉÈÊËÎÏÔÖÛÜÙÂÀÄŒÆ]/", $ch)){
      return true;
    }
    else{
      return false;}
  }
  
	/*
	*test de double tiret
	*utilisé pour le prenom
	*/
  function doubleTiretInterdit($ch){
    if(preg_match("/--/", $ch)){
      return false;
    }
    else
      return true;
  }
  
	/*
	*test la présence de plusieurs double tiret
	*utilisée pour le nom
	*/
  function plsrsDoubleTiretNom($ch){
    
    $tab = explode("--", $ch);
    
    if(count($tab)>2){ 
      return false;
    }
    else
      return true;
  }
  
  /*
  *test la longueur de la chaîne après tous les traitementChaine
  */
  function longChaine($ch){
    
    if(iconv_strlen($ch)>31)
      return false;
    else return true;
    
  }
  
  //---------------------------------------------------------Fonctions de transformation de la chaine -------------------------------------
  
	/*
	* fonction générale 
	* appel de fonctions de traitement pour les noms et prénoms
	*/
  function traitementChaine($ch){
    $ch=plsrsApostrophes($ch);
    $ch=plsrsEspaces($ch);
    $ch=SupprimeEspaceAutourTiret($ch);
    $ch=decolleCarac($ch);
    return $ch;
  }
  
  /*
  *Modification de caractères non-valides mais autorisés
  *lettres collée, n tilde
  */
  function decolleCarac($ch){
    if(preg_match("/[œæŒÆ]/", $ch))
    {
      
      $carac = array('/œ/','/æ/','/Œ/','/Æ/','/ñ/','/Ñ/');
      $decolle = array('oe','ae','OE','AE','n','N');
      $ch2 = preg_replace($carac, $decolle, $ch);
      return $ch2;
    }  
    else return $ch;
  }
  
	/*
	*Transformations en apostrophes autorisées
	*/
  function transfoApos($ch){
    $apo = array('\'');
    $truc = array('/‘/');
    $ch2 = preg_replace($truc, $apo, $ch);
    return $ch2;
  }
  /*
  * Suppression des caractères de début et de fin 
  * Utilisé s'ils sont autres que des lettres ou apostrophes
  */
  function premierTerme($ch){
    $ch2 = $ch;
    if(strlen($ch2) > 1){
      while(strpos($ch2, " ") === 0 || strpos($ch2, "-") === 0 || strpos($ch2, " ") == strlen($ch2)-1 || strpos($ch2, "-") == strlen($ch2)-1){
        $ch2 = trim($ch2);
        $ch2 = trim($ch2, "-");
      }
    }
    else {
      $ch2 = trim($ch2);
      $ch2 = trim($ch2, "-");
    }
    return $ch2;
  }
  
  /*
  * Les apostrophes doublés sont remplacés par une simple apostrophe
  * Utilisation lors de l'entrée du nom par l'utilisateur
  * Utilisation lors de la sortie de la base de donnée
  */
  function plsrsApostrophes($ch){
    $ch2 = $ch;
    if(strpbrk( "/[']{2,}/",$ch2) ){
      $ch2=preg_replace ( "/[']{2,}/", "'", $ch2);
    }
    return $ch2;
    
  }
  
	/*
	* Doubles espaces remplacés par un simple
	*/
  function plsrsEspaces($ch){
    $ch2 = $ch;
    if(strpbrk( "/[[:space:]]{2,}/",$ch2) ){
      $ch2=preg_replace ( "/[[:space:]]{2,}/", " ", $ch2);
    }
    
    return $ch2;
    
  }
  
  /*
  * Suppression des espaces autour des tirets
  */
  function SupprimeEspaceAutourTiret($ch){
    
    $tab = explode("-", $ch);
    for( $i=0;$i< count($tab) ;$i++){
      $tab["$i"]= trim($tab["$i"]);
    }
    $ch2= implode("-", $tab);
    return $ch2;
  }
  
  //-----------------------------------Fonctions de traitement pour les NOMS --------------------------------------------------
  
  /*
  * Remplacement d'un grand nombre de tiret par des double tirets
  */
  function doubleTiretNom($ch){
    $ch2 = $ch;
    if(strpbrk( $ch2,"/[-]{3,}/") ){
      $ch2=preg_replace ( "/[-]{3,}/", "--", $ch2);
    }
    
    
    return $ch2;
    
  }
  
  /*
  * Enlèvement des accents
  *Mise en majuscule
  */
  
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
  
  
   //-----------------------------------Fonctions de traitement pour les PRENOMS --------------------------------------------------
  
  /*
  *Fonction générale
  *Appel des fonctions nécessaires
  */
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
  
  /*
  *Mise en majuscule
  *Terme suivant un apostrophe
  */
  function apostropheMaj($ch){
    $tab = explode("'", $ch);
    
    for( $i=0;$i< count($tab) ;$i++){
      $tab["$i"]=premiereLettreAccent($tab["$i"]);
      $tab["$i"]=ucfirst($tab["$i"]);
    }
    
    $ch2= implode("'", $tab);
    
    return $ch2;
    
  }
  
  /*
  *Mise en minuscule
  *Gestion des accents
  */
  function mettreMinuscule($ch){
    $accent = array('/É/', '/È/', '/Ê/', '/Ë/', '/Î/', '/Ï/', '/Ô/', '/Ö/', '/Û/', '/Ü/', '/Ù/', '/Â/', '/À/', '/Ä/');
    $replace = array('é','è','ê','ë', 'î', 'ï', 'ô', 'ö', 'û', 'ü', 'ù', 'â', 'à', 'ä');
    $ch = preg_replace($accent,$replace,$ch);
    $ch = strtolower($ch);
    return $ch;
  }
  
  /*
  *Mise en majuscule de la première lettre
  *Gestion des accents
  */
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
  
  /*
  *Mise en majuscule
  *Terme suivant un tiret
  */
  
  function tiretMaj($ch){
    
    $tab = explode("-", $ch);
    for( $i=0;$i< count($tab) ;$i++){
      $tab["$i"]=premiereLettreAccent($tab["$i"]);
      $tab["$i"]=ucfirst($tab["$i"]);
    }
    
    $ch2= implode("-", $tab);
    return $ch2;
    
  }
  
  /*
  *Mise en majuscule
  *Terme suivant un espace
  */
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