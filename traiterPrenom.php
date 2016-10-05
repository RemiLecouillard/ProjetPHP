<?php

function traiterPrenom($ch){
	$ch = transfoApos($ch);
	if(validiteChaine($ch)){
		if(doubleTiretInterdit($ch)){
			$ch=traitementChaine($ch);
			$ch=prenomMaj($ch);
			$ch=premierTerme($ch);
			$ch=SupprimeEspaceAutourTiret($ch);
			return $ch;
			}
			else
				return "-1";
	}
	else
		return "-1";
}
?>