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
    <title>ajouter un site</title>
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
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Ajouter un site</strong></div></a></div>
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
            <li class="breadcrumb-item"><a href="index.php">Sites référencés</a></li>
            <li class="breadcrumb-item active">Ajouter un site</li>
          </ul>
        </div>
      </div>
      <?php
        if(isset($_SESSION["reussi"]))
          {
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
          }?>

      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1  style="text-align: center;">Ajouter un site           </h1>
          </header>
          <div class="row">            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="scriptBD_ajoutSite.php" class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">site</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " name="site" placeholder="nom du site" required>
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" type="text" name="description" placeholder="Ajouter une description"></textarea>
                      </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Mots clés</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" type="text" name="motcle" placeholder="Ajouter des mots clés"> </textarea>
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <div style="text-align: center;">
                        <button type="submit" class="btn btn-secondary" onclick="history.back();">Annuler</button>
                        <button type="submit" class="btn btn-primary" >Enregistrer</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
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
    header("location: ../connexion.php");
    } 
    mysqli_close($con);?>
  </body>
</html>