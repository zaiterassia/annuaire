<?php
  require_once("../config.php");
  session_start();

  $id = $_SESSION["idauteur"];
  $identifiant = mysqli_real_escape_string($con, $_POST['identifiant']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $nom = mysqli_real_escape_string($con, $_POST['nom']);
  $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
  $desc = mysqli_real_escape_string($con, $_POST['description']);
  
  if(strlen($identifiant)<0 || strlen($email)<0){
    $_SESSION["reussi"]=0;
    $_SESSION["msg"]="l'identifiant ou l'email ne peut pas être null!";
  }
  else{
      // $option = ['cost'=>11];
      // $hashed = password_hash($password, PASSWORD_BCRYPT,$option); 

      $sql = "UPDATE profil set USER='$identifiant', Email='$email', NOMPROFIL='$nom', PRENOMPROFIL='$prenom', Description='$desc' WHERE ID= '$id'";
      $res=mysqli_query($con,$sql);
      if ($res) {
        $_SESSION["login"] = $identifiant;
        $_SESSION['email']=$email;
        $_SESSION["nom"]=$nom;
        $_SESSION["prenom"]=$prenom;  
        $_SESSION["description"] = $desc;        
        $_SESSION["reussi"]=1;
        $_SESSION["msg"]="le profile est mis-à-jour avec succès";
      }
    }
    mysqli_close($con);
    header("location:profile.php");

   
  ?>