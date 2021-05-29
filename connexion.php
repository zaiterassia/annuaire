<?php
ini_set('display_errors', 'on');
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>connexion</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/notebook.ico">

  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>annuaire</span><strong class="text-primary"> Exher</strong></div>
            <p>Bienvenue dans l'annuaire de référencement de la société Exher, Veuillez entrer votre identifiant et votre mot de passe</p>
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
            <form method="POST" action="scriptBD_connexion.php" class="text-left form-validate">
              <div class="form-group-material">
                <input id="login" type="text" name="login" required data-msg="Veuillez renseigner votre nom" class="input-material">
                <label for="login" class="label-material">Nom</label>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="password" required data-msg="Veuillez renseigner votre mot de passe" class="input-material">
                <label for="password" class="label-material">Mot de passe:</label>
              </div>
              <div class="form-group text-center">
              	<input id="connexion" type="submit" value="Se connecter" class="btn btn-primary">
              </div>
            </form><a href="password/initMdp.php" class="forgot-pass">Mot de passe oublié?</a>
            <!-- <small>Vous n'avez pas de compte </small><a href="register.php" class="signup">inscrivez-vous</a> -->
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>