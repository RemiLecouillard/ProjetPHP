<?php

	/************************
	*    Traitement du Nom  *
	*************************/
	
  function traiterNom($ch){
    $ch = transfoApos($ch);
    if(validiteChaine($ch)){
      // echo "chaine valid";
      doubleTiretNom($ch);
      $ch=premierTerme($ch);
      if(!empty($ch)){
        if(plsrsDoubleTiretNom($ch)){
          // echo "pas pls double tiret";
          $ch=traitementChaine($ch);
          $ch=nomMaj($ch);
          $ch=doubleTiretNom($ch);
          $ch=SupprimeEspaceAutourTiret($ch);
          if(longChaine($ch)){
            return $ch;
          }
          else
            return "-1";
        }
        else
          return "-1";
      }
      return "-1";
    }
    else
      return "-1";
  }
  
  ?>