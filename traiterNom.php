<?php
function traiterNom($ch){
	if(validiteChaine($ch)){
		
		doubleTiretNom($ch)
			if(plsrsDoubleTiretNom($ch)){
				$ch=traitementChaine($ch);
				$ch=nomMaj($ch);
				return $ch;
			}
			//voir ce qu'on renvoit pour le formulaire
		
	}
	
	//voir ce qu'on renvoie pour le formulaire
}

?>