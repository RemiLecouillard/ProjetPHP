<?php
function traiterNom($ch){
	if(validiteChaine($ch)){
		
		doubleTiretNom($ch);
			if(plsrsDoubleTiretNom($ch)){
				$ch=traitementChaine($ch);
				$ch=nomMaj($ch);
				echo $ch;
			}
			else
				echo "invalide";
	}
	else
		echo "invalide";
	
}

?>