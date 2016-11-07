<?php
  
  $db = "oci:dbname=info;charset=WE8ISO8859P15";
  $dbUserName = "ETU2_58".
    $dbPass = "remixav16";
  $connect = connectPdo($db, $dbUserName, $dbPass);
  
  if($connect){
    $requete="INSERT INTO :table VALUES(); ";
    
  }
  
  function connectPdo($db, $dbUserName, $dbPass){
    try
    {
      $connex = new PDO($db,$db_username,$db_password);
      $res = true;
    }
    catch (PDOException $erreur)
    {
      echo $erreur->getMessage();
    }
    return $connex;
  }
  ?>