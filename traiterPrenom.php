<?php
  
  function traiterPrenom($ch){
    $ch = transfoApos($ch);
    if(validiteChaine($ch)){
      $ch=premierTerme($ch);
      if(!empty($ch)){
        if(doubleTiretInterdit($ch)){
          $ch=traitementChaine($ch);
          $ch=prenomMaj($ch);
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
      else
        return "-1";
    }
    else
      return "-1";
  }
  ?>