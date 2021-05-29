<?php
ini_set('display_errors', 'on');
session_start();
require_once("../config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>profile</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
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
    <link rel="shortcut icon" href="../img/notebook.jfif">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <?php if(isset($_SESSION["nom"])){ 
      $nom=$_SESSION["nom"];
      $prenom=$_SESSION["prenom"];
      $email=$_SESSION["email"];
      $description=$_SESSION["description"];
      $identifiant=$_SESSION["login"];
      $droits=$_SESSION["droits"];
    ?>
<!-- Side Navbar -->
    <?php include_once("../nav.php"); ?>
    <div class="page">
      <!-- navbar-->
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Profile</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">                
                <!-- Log out-->
                <li class="nav-item"><a href="../connexion.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Déconnexion</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ul>
        </div>
      </div>

      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1  style="text-align: center;">Profile         </h1>
          </header>
          <div class="row">
            <div class="col-lg-4">
              <div class="card card-profile">
                <div style="background-image: url(img/paul-morris-116514-unsplash.jpg);" class="card-header"></div>
                <div class="card-body text-center"><img src="../img/avatar.png" class="card-profile-img">
                  <h3 class="mb-3"><?php echo $prenom." ".$nom; ?></h3>
                  <p class="mb-4"><?php echo $description ?> </p>
                  <button class="btn btn-outline-dark btn-sm"><span class="fa fa-twitter"></span> Suivre</button>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="media"><span style="background-image: url(../img/avatar.png)" class="avatar avatar-xl mr-3"></span>
                    <div class="media-body">
                      <h4><?php echo $prenom." ".$nom; ?></h4>
                      <p class="text-muted mb-0"><?php echo $description ?> </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
            <?php 
            if(isset($_SESSION["reussi"])){
              if($_SESSION["reussi"]==1) { ?>
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Succès!</strong> <?php echo $_SESSION['msg']; ?>
                </div>
              <?php
                unset($_SESSION['reussi']);
              }
              else if($_SESSION["reussi"]==0) { ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Echec!</strong> <?php echo $_SESSION['msg']; ?>
                </div> 
              <?php
                unset($_SESSION['reussi']);
              }
            }
            ?>
              <!-- form pour modifier le profile -->	
              <form action="scriptBD_modifProfile.php" method="POST" class="card form-validate">
                <div class="card-body">
                  <h3 class="card-title">Modifier le profile</h3>
                  <div class="row">
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-4">
                        <label class="form-label">Identifiant</label>
                        <input type="text" name="identifiant" placeholder="identifiant" value="<?php echo $identifiant ?>" required data-msg="Ce champ est requis" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-4">
                        <label class="form-label">Email addresse</label>
                        <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required data-msg="Veuillez entrer une adresse e-mail valide" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-4">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" placeholder="Nom"  value="<?php echo $nom ?>" required data-msg="Ce champ est requis" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group mb-4">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom ?>" required data-msg="Ce champ est requis" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group mb-4">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" placeholder="description" value="<?php echo $description ?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-secondary" onclick="history.back();">Annuler</button>
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
              </form>
              <!-- form pour modifier le mot de passe -->
              <form action="scriptBD_modifMdp.php" method="POST" class="card form-validate">
                <div class="card-body">
                  <h3 class="card-title">Modifier le mot de passe</h3>
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group mb-4">
                        <label class="form-label">ancien mot de passe</label>
                        <input type="password" name="oldpassword" required data-msg="Ce champ est requis" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group mb-4">
                        <label class="form-label">nouveau mot de passe</label>
                        <input type="password" id="newpassword" name="newpassword" required data-msg="Ce champ est requis" data-rule-minlength="6" data-msg-minlength="Le mot de passe doit comprendre au moins 6 caractères."  class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group mb-4">
                        <label class="form-label">confirmer le mot de passe</label>
                        <input type="password" name="newpassword2" required data-msg="Veuillez confirmer votre mot de passe." data-rule-equalto="#newpassword" data-msg-equalto="Les mots de passe ne correspondent pas"  class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-secondary" onclick="history.back();">Annuler</button>
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Exher &copy; 2017-2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://www.exher.fr/#section_0" class="external">Exher</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/charts-home.js"></script>
    <!-- Main File-->
    <script src="../js/front.js"></script>
    <?php }
    else{
    header("location:../connexion.php");} 
    mysqli_close($con);?>
  </body>
</html>