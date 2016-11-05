<?php

function afficherListe($tab,$nbLignes){
	echo "$nbLignes resultats trouvés<br />\n";
	$ctr = 0;
  if ($nbLignes > 0) 
  {
    echo "<table border=\"1\">\n";
    echo "<tr>\n";
    foreach ($tab as $key => $val)  // lecture des noms de colonnes
    {
      echo "<th>$key</th>\n";
    }
	echo "<th></th><th></th>";
    echo "</tr>\n";
    for ($i = 0; $i < $nbLignes; $i++) // balayage de toutes les lignes
    {
		$ctr = 0;
      echo "<form method='post' action='action.php' enctype='application/x-www-form-urlencoded' name='supp'><tr>\n";
      foreach ($tab as $data) // lecture des enregistrements de chaque colonne
	  {
		$data[$i] = utf8_encode($data[$i]);
			if($ctr == 0){
			  echo '<input type="hidden" name="N_COUREUR" value="'.$data[$i].'"/>';
		  }
		  else if($ctr == 1)
			echo '<input type="hidden" name="NOM" value="'.$data[$i].'"/>';
		  else if($ctr == 2)
			echo '<input type="hidden" name="PRENOM" value="'.$data[$i].'"/>';
		  else if($ctr == 3)
			echo '<input type="hidden" name="ANNEE_NAISSANCE" value="'.$data[$i].'"/>';
		  else if($ctr == 4)
			echo '<input type="hidden" name="code_tdf" value="'.$data[$i].'"/>';
		  else if($ctr == 5)
			echo '<input type="hidden" name="ANNEE_PREM" value="'.$data[$i].'"/>';
		  else if($ctr == 7)
			echo '<input type="hidden" name="DATE_INSERT" value="'.$data[$i].'"/>';
        echo "<td>$data[$i]</td>\n";
		$ctr++;
      }
	  echo "<td><input type='submit'value ='modifier' name='modif'/></td>";
      echo "<td><input type='submit'value ='supprimer' name='supp'/></td></tr></form>\n";
    }
    echo "</table>\n";
  } 
  else 
  {
    echo "Pas de ligne<br />\n";
  } 
	
}

if(isset($_POST["rechercher"])){
	if(!empty($_POST["nom"]) || !empty($_POST["prenom"]) || !empty($_POST["annee_Nais"]) || !empty($_POST["code_tdf"]) || !empty($_POST["annee_Prem"]) || !empty($_POST["date_Insert"])){
		//$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
		$req = "SELECT * FROM tdf_coureur where";
		$i=0;
		foreach($_POST as $cle=>$contenu){
			if(!empty($_POST[$cle]) && $cle != "rechercher"){
				if($i==0) $req= $req." $cle='$contenu'";
				else $req = $req." and $cle='$contenu'";
				$i++;
			}
		}
	}
	else{
		$req = "SELECT * FROM tdf_coureur";
	}
	$req = utf8_decode($req);
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nb = LireDonnees1($cur,$donnees);
	AfficherListe($donnees,$nb);
	FermerConnexion($conn);
}
?>

