<?php
  include("traiterPrenom.php");
  include("traiterNom.php");
  include("fonctionsTraitement.php");
  
  function calculerNumeroCoureur(){
    $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
    $req = "SELECT max(n_coureur)+1 FROM tdf_coureur";
    $cur = PreparerRequete($conn,$req);
    $res = ExecuterRequete($cur);
    $nb = LireDonnees1($cur,$donnees);
    $committed = oci_commit($conn);
    FermerConnexion($conn);
    return $donnees['MAX(N_COUREUR)+1'][0];
  }
  
  function regarderDejaPresent($nom, $prenom){
    $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
    $req = "SELECT count(*) FROM tdf_coureur where nom ='".$nom."' and prenom ='".$prenom."'";
    $req = utf8_decode($req);
    $cur = PreparerRequete($conn,$req);
    $res = ExecuterRequete($cur);
    $nb = LireDonnees1($cur,$donnees);
    $committed = oci_commit($conn);
    FermerConnexion($conn);
    if($donnees['COUNT(*)'][0] == 0)
      return false;
    else
      return true;
  }
  function anneeActuel(){ 
    return 2016;
  }
  
  function ajoutCoureur($nom, $prenom, $code){
    $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
    //création de la requete
    $req = "";
    if(!empty($_POST["ANNEE_NAISSANCE"]) && !empty($_POST["ANNEE_PREM"]))
      $req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, annee_prem, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["code_tdf"]."',".$_POST["ANNEE_NAISSANCE"].",".$_POST["ANNEE_PREM"].", sysdate, 'ETU2_58')";
    else if(!empty($_POST["ANNEE_NAISSANCE"]))
      $req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_naissance, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["code_tdf"]."',".$_POST["ANNEE_NAISSANCE"].", sysdate, 'ETU2_58')";
    else if(!empty($_POST["ANNEE_PREM"]))
      $req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, annee_prem, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["code_tdf"]."',".$_POST["ANNEE_PREM"].", sysdate, 'ETU2_58')";
    else
      $req = "Insert into tdf_coureur(n_coureur, nom, prenom, code_tdf, DATE_INSERT, COMPTE_ORACLE) values (".$code.",'".$nom."','".$prenom."','".$_POST["code_tdf"]."', sysdate, 'ETU2_58')";
    //echo $req;
    $req = utf8_decode($req);
    $cur = PreparerRequete($conn,$req);
    $res = ExecuterRequete($cur);
    $committed = oci_commit($conn);
    FermerConnexion($conn);
    if($prenom != $_POST["PRENOM"])
      echo "Le prénom que vous avez rentré a été modifié en ".$prenom."</br>";
    if($nom != $_POST["NOM"])
      echo "Le nom que vous avez rentré a été modifié en ".$nom."</br>";
    echo "le joueur a été ajouté";
    
  }
  
  function ajoutable(){
    if(isset($_POST["envoyer"]) || isset($_POST['modifier'])){
      $test = true;
      if(empty($_POST["NOM"]) || empty($_POST["PRENOM"]) || empty($_POST["code_tdf"]))
        throw new Exception("Veuillez rentrer tout les champs.");
      $nom = $_POST["NOM"];
      $prenom = $_POST["PRENOM"];
      $prenom = traiterPrenom($prenom);
      $nom = traiterNom($nom);
      if($prenom == "-1")
        throw new Exception('Le prenom que vous avez rentré n est pas valide');
      if($nom == "-1")
        throw new Exception('Le nom que vous avez rentré n est pas valide');
      $prenom = doublerApostrophe($prenom);
      $nom = doublerApostrophe($nom);
      if(regarderDejaPresent($nom, $prenom) && !isset($_POST['modifier']))
        throw new Exception('Ce coureur est déja présent');
      if(!empty($_POST["ANNEE_NAISSANCE"])){
        if(anneeActuel() - $_POST["ANNEE_NAISSANCE"] < 18)
          throw new Exception("L'age n'est pas valide");
        if(!empty($_POST["ANNEE_PREM"]))
          if($_POST["ANNEE_PREM"] - $_POST["ANNEE_NAISSANCE"] < 18 || $_POST["ANNEE_PREM"] - $_POST["ANNEE_NAISSANCE"] > 110 )
            throw new Exception("L'age du premier tour n'est pas valide");
      }
      //Insertion dans la base
      if(isset($_POST["envoyer"])){
        $code = calculerNumeroCoureur();
        ajoutCoureur($nom, $prenom, $code);
      }
      //ce fichier s'occupe également de la modification des coureurs
      if(isset($_POST['modifier'])){
        if(($_POST['EXNOM'] != $nom || $_POST['EXPRENOM'] != $prenom) && regarderDejaPresent($nom, $prenom))
          throw new Exception('Ce coureur est déja présent');
        $req = "";
        if(!empty($_POST["ANNEE_NAISSANCE"]) && !empty($_POST["ANNEE_PREM"]))
          $req = "update tdf_coureur SET NOM='".$nom."', PRENOM='".$prenom."', ANNEE_NAISSANCE=".$_POST['ANNEE_NAISSANCE'].", code_tdf='".$_POST['code_tdf']."', ANNEE_PREM=".$_POST['ANNEE_PREM']." where N_COUREUR = ".$_POST['N_COUREUR'];
        else if(!empty($_POST["ANNEE_NAISSANCE"]))
          $req = "update tdf_coureur SET NOM='".$nom."', PRENOM='".$prenom."', ANNEE_NAISSANCE=".$_POST['ANNEE_NAISSANCE'].", code_tdf='".$_POST['code_tdf']."' where N_COUREUR = ".$_POST['N_COUREUR'];
        else if(!empty($_POST["ANNEE_PREM"]))
          $req = "update tdf_coureur SET NOM='".$nom."', PRENOM='".$prenom."', code_tdf='".$_POST['code_tdf']."', ANNEE_PREM=".$_POST['ANNEE_PREM']." where N_COUREUR = ".$_POST['N_COUREUR'];
        else
          $req = "update tdf_coureur SET NOM='".$nom."', PRENOM='".$prenom."', code_tdf='".$_POST['code_tdf']."' where N_COUREUR = ".$_POST['N_COUREUR'];
        $conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
        $req = utf8_decode($req);
        $cur = PreparerRequete($conn,$req);
        $res = ExecuterRequete($cur);
        oci_commit($conn);
        FermerConnexion($conn);
        if($prenom != $_POST["PRENOM"])
          echo "Le prénom que vous avez rentré a été modifié en ".$prenom."</br>";
        if($nom != $_POST["NOM"])
          echo "Le nom que vous avez rentré a été modifié en ".$nom."</br>";
        echo "Le coureur a été modifié";
      }
    }
    
  }
  
  ?>