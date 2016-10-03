<?php
function traiterPrenom($ch){
	if(validiteChaine($ch)){
		if(doubleTiretInterdit($ch)){
			$ch=traitementChaine($ch);
			$ch=prenomMaj($ch);
			return $ch;
		}
		//voir ce qu'on renvoie pour le formulaire
	}
	//voir ce qu'on renvoie pour le formulaire
}
?>