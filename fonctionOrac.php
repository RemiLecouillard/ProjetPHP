<?php

//---------------------------------------------------------------------------------------------
function OuvrirConnexion($session,$mdp,$instance)
{
  $conn = @oci_connect($session, $mdp,$instance,"WE8ISO8859P15"); // @ évite l'affichage du message d'erreur
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
  echo "<br>résultat de la requête: $r<br />";
  if (!$r) 
  {  
	$e = oci_error($stid);  
	echo htmlentities($e['message']);  
	exit;
  }
  return $r;
}
//---------------------------------------------------------------------------------------------
function FermerConnexion($conn)
{
  oci_close($conn);
}

?>