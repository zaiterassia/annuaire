<?php
  require_once("../config.php");
  session_start();

  $id = $_SESSION["idauteur"];
  $oldpassword = mysqli_real_escape_string($con, $_POST['oldpassword']);
  $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
  $newpassword2 = mysqli_real_escape_string($con, $_POST['newpassword2']);
  echo $password;
  if(!password_verify($oldpassword,$_SESSION['password'])){
    $_SESSION["reussi"]=0;
    $_SESSION["msg"]="l'ancien mot de passe est incorrect'!";
     
  }

  elseif($newpassword!=$newpassword2){
    $_SESSION["reussi"]=0;
    $_SESSION["msg"]="les mots de passe ne correspondent pas!";
  }
  elseif(strlen($newpassword)<6){
    $_SESSION["reussi"]=0;
    $_SESSION["msg"]="le mot de passe doit contenir au moins 6 caractères";
  }
  else{
      $option = ['cost'=>11];
      $hashed = password_hash($newpassword, PASSWORD_BCRYPT,$option); 

      $sql = "UPDATE profil set MDP='$hashed', PASS='$newpassword' WHERE ID= '$id'";
      $res=mysqli_query($con,$sql);
      if ($res) {
        $_SESSION["password"] = $newpassword;
        $_SESSION["reussi"]=1;
        $_SESSION["msg"]="le mot de passe est modifié avec succès";
      }

    }
    mysqli_close($con);
    header("location:profile.php");

   
  ?>