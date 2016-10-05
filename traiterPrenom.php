<?php

function traiterPrenom($ch){
	$ch = transfoApos($ch);
	if(validiteChaine($ch)){
		if(doubleTiretInterdit($ch)){
			$ch=traitementChaine($ch);
			$ch=prenomMaj($ch);
			echo $ch;
			}
			else
				echo "invalide";
	}
	else
		echo "invalide";
}
?>