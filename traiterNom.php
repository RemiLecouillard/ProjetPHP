<?php
function traiterNom($ch){
	$ch = transfoApos($ch);
	if(validiteChaine($ch)){
		
		doubleTiretNom($ch);
			if(plsrsDoubleTiretNom($ch)){
				$ch=traitementChaine($ch);
				$ch=nomMaj($ch);
				$ch=doubleTiretNom($ch);
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