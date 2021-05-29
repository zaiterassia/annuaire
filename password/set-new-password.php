<?php
ini_set('display_errors', 'on');
require_once("../config.php");
session_start();
$_SESSION["token"] = mysqli_real_escape_string($con, $_GET['token']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>initialiser mot de passe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="../css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/notebook.ico">

  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span><strong class="text-primary">nouveau mot de passe</strong></div>
            <p>Entrez un nouveau mot de passe </p>

            <?php
              if(isset($_SESSION["reussi"])){
                if($_SESSION["reussi"]==1) { ?>
                  <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Succès!</strong> <?php echo $_SESSION['msg']; ?>
                  </div>
              <?php
                }
                else if($_SESSION["reussi"]==0) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Echec!</strong> <?php echo $_SESSION['msg']; ?>
                  </div> 
              <?php
                }
                unset($_SESSION['reussi']);
              }
            ?> 
            <form method="POST" action="scriptBD_newpassword.php" class="text-left form-validate">
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Veuillez renseigner votre mot de passe" data-rule-minlength="6" data-msg-minlength="Le mot de passe doit comprendre au moins 6 caractères." class="input-material">
                <label for="password" class="label-material">Mot de passe:</label>
              </div>
              <div class="form-group-material">
                <input id="password2" type="password" name="password2" required data-msg="Veuillez confirmer votre mot de passe" data-rule-equalto="#password" data-msg-equalto="Les mots de passe ne correspondent pas" class="input-material">
                <label for="password2" class="label-material">Confirmer votre mot de passe:</label>
              </div>
              <div class="form-group text-center">
                <input id="newpassword" type="submit" value="Modifier" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="../js/front.js"></script>
  </body>
</html>



  

