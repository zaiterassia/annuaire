<?php
  require_once("../config.php");
  session_start();
  if(isset($_SESSION["token"])) {
    $token = $_SESSION["token"];
    $sql = "SELECT * FROM init_password WHERE token='$token'";
    $res=mysqli_query($con,$sql);
    $nb_resultats = mysqli_num_rows($res);
    if($nb_resultats == '0'){
      header("location:../connexion.php");
    }
    else {
      $row = mysqli_fetch_array($res);
      $db_token = $row['token'];
      $db_email = $row['Email'];
    }
  }

  $password = mysqli_real_escape_string($con, $_POST['password']);
  $password2 = mysqli_real_escape_string($con, $_POST['password2']);
  if($password!=$password2){
      $_SESSION["reussi"]=0;
      $_SESSION["msg"]="Les mots de passe ne correspondent pas!";
      header("location:set-new-password.php?token=$token");
    }
    elseif(strlen($password)<6){
     $_SESSION["reussi"]=0;
      $_SESSION["msg"]="Le mot de passe doit contenir au moins 6 caractères";
      header("location:set-new-password.php?token=$token");
    }
    else{
      $option = ['cost'=>11];
      $hashed = password_hash($password, PASSWORD_BCRYPT,$option); 

      $sql = "UPDATE profil set MDP='$hashed', PASS='$password' WHERE Email =  '$db_email'";
      $res=mysqli_query($con,$sql);
      $sql = "delete from init_password WHERE Email='$db_email'";
      $res=mysqli_query($con,$sql);
      $_SESSION["reussi"]=1;
      $_SESSION["msg"]="le mot de passe est initialisé avec succès";
      header("location:../connexion.php");

    }

   
  ?>