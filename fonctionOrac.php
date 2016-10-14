<?php

//---------------------------------------------------------------------------------------------
function OuvrirConnexion($session,$mdp,$instance)
{
  $conn = @oci_connect($session, $mdp,$instance,"WE8ISO8859P15"); // @ �vite l'affichage du message d'erreur
//  $conn = oci_connect($session, $mdp,$instance);
  if (!$conn) 
  {  
	$e = oci_error();  
	print htmlentities($e['message']);  
	exit;
  }
  return $conn;
}
//---------------------------------------------------------------------------------------------
function PreparerRequete($conn,$req)
{
  $cur = oci_parse($conn, $req);
  
  if (!$cur) 
  {  
	$e = oci_error($conn);  
	print htmlentities($e['message']);  
	exit;
  }
  return $cur;
}
//---------------------------------------------------------------------------------------------
function ExecuterRequete($cur)
{
  $r = oci_execute($cur, OCI_DEFAULT);
  echo "<br>r�sultat de la requ�te: $r<br />";
  if (!$r) 
  {  
	$e = oci_error($stid);  
	echo htmlentities($e['message']);  
	exit;
  }
  return $r;
}
//---------------------------------------------------------------------------------------------
function LireDonnees3($cur,&$tab)
{
  $nbLignes = 0;
  $i=0;
  while ($row = oci_fetch ($cur)) 
  {    
	$tab[$nbLignes][$i] = oci_result($cur,'VAL'); // respecter la casse
    $tab[$nbLignes][$i+1] = oci_result($cur,'TYPE');
	$tab[$nbLignes][$i+2] = oci_result($cur,'COULEUR');
	$nbLignes++;
  }
  return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonnees1($cur,&$tab)
{
  $nbLignes = oci_fetch_all($cur, $tab,0,-1,OCI_ASSOC); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
  return $nbLignes;
}
//---------------------------------------------------------------------------------------------
// fonctions autres
function AfficherDonnee1($tab,$nbLignes)
{
  if ($nbLignes > 0) 
  {
    echo "<table border=\"1\">\n";
    echo "<tr>\n";
    foreach ($tab as $key => $val)  // lecture des noms de colonnes
    {
      echo "<th>$key</th>\n";
    }
    echo "</tr>\n";
    for ($i = 0; $i < $nbLignes; $i++) // balayage de toutes les lignes
    {
      echo "<tr>\n";
      foreach ($tab as $data) // lecture des enregistrements de chaque colonne
	  {
        echo "<td>$data[$i]</td>\n";
      }
      echo "</tr>\n";
    }
    echo "</table>\n";
  } 
  else 
  {
    echo "Pas de ligne<br />\n";
  } 
  echo "$nbLignes Lignes lues<br />\n";
}
//---------------------------------------------------------------------------------------------
function FermerConnexion($conn)
{
  oci_close($conn);
}

?>