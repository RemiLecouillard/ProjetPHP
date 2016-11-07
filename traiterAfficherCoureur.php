<?php
  include("fonctionsTraitement.php");
  include("traiterNom.php");
  include("traiterPrenom.php");
  function afficherListe($tab,$nbLignes){
    echo "$nbLignes resultats trouvés<br />\n";
    $ctr = 0;
    if ($nbLignes > 0) 
    {
      echo "<table border=\"1\">\n";
      echo "<tr>\n";
      foreach ($tab as $key => $val)  // lecture des noms de colonnes
               {
                 if($key == "N_COUREUR")
                   echo "<th style='display:none;'>$key</th>\n";
                 else
                   echo "<th>$key</th>\n";
               }
      echo "<th></th><th></th><th></th>";
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
                        if($ctr == 0)
                          echo "<td style='display:none;'>$data[$i]</td>\n";
                        else
                          echo "<td>$data[$i]</td>\n";
                        $ctr++;
                      }
             echo "<td><input type='submit'value ='modifier' name='modif'/></td>";
             echo "<td><input type='submit'value ='supprimer' name='supp'/></td>";
             echo "<td><input type='submit'value ='visualiser' name='visualiser'/></td></tr>";
             echo "</form>\n";
             //include("voirToutCou.htm");
           }
      echo "</table>\n";
    } 
    else 
    {
      echo "Pas de ligne<br />\n";
    } 
    
  }
  
  if(isset($_POST["rechercher"])){
    if(!empty($_POST["nom"]) || !empty($_POST["prenom"]) || !empty($_POST["annee_Naissance"]) || !empty($_POST["code_tdf"]) || !empty($_POST["annee_Prem"]) || !empty($_POST["date_Insert"])){
      //$conn = OuvrirConnexion('ETU2_58', 'remixav16','info');
      $req = "SELECT * FROM tdf_coureur where ";
      $i=0;
      
      foreach($_POST as $cle=>$contenu){
        if(!empty($_POST[$cle]) && $cle != "rechercher"){
          if($i != 0)
            $req = $req." and ";
          if($cle == "nom"){
            $nom = traiterNom($_POST["nom"]);
            $nom = doublerApostrophe($nom);
            $req = $req."$cle='$nom'";
          }
          else if($cle == "prenom"){
            $prenom = traiterPrenom($_POST["prenom"]);
            $prenom = doublerApostrophe($prenom);
            $req = $req." $cle='$prenom'";
          }
          else $req = $req."$cle='$contenu'";
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

