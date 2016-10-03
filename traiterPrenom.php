<?php
function traiterPrenom($ch){
	if(validiteChaine($ch)){
		if(doubleTiretInterdit($ch))
			$ch=traitementChaine($ch);
			$ch=prenomMaj($ch)
	}
	
}
?>