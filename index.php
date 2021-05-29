<?php
ini_set('display_errors', 'on');
session_start();
require_once("config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Annuaire Exher</title>
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
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/notebook.jfif">
  </head>
  <body>
    <?php if(isset($_SESSION["nom"])){
      $nom=$_SESSION["nom"];
      $prenom=$_SESSION["prenom"];
    ?>
    <!-- Side Navbar -->
    <?php include_once("nav.php"); ?>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.php" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Accueil</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">                
                <!-- Log out-->
                <li class="nav-item"><a href="connexion.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Déconnexion</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
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
      <!-- Counts Section -->
      <?php 
      $result=mysqli_query($con, "SELECT count(*) as total from profil");
      $data=mysqli_fetch_assoc($result);
      $user_number = $data['total'];
      $result=mysqli_query($con, "SELECT count(*) as total from notes");
      $data=mysqli_fetch_assoc($result);
      $site_number = $data['total'];
      $result=mysqli_query($con, "SELECT count(*) as total from annuaire");
      $data=mysqli_fetch_assoc($result);
      $annuaire_number = $data['total'];
      $result=mysqli_query($con, 'SELECT count(*) as total from annuaire where acceptation="OUI"');
      $data=mysqli_fetch_assoc($result);
      $accepted_number = $data['total'];
      $result=mysqli_query($con, 'SELECT count(*) as total from annuaire where acceptation="EN ATTENTE"');
      $data=mysqli_fetch_assoc($result);
      $wait_number = $data['total'];
      $result=mysqli_query($con, "SELECT count(*) as total from annuaire where datemodif >= DATE_ADD(CURDATE(),INTERVAL -15 DAY) ");
      $data=mysqli_fetch_assoc($result);
      $update_number = $data['total'];
      $percent = intval(($update_number/$wait_number)*100);
      ?>
      
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-4 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Membres</strong><span>utilisateur de l'annuaire</span>
                  <div class="count-number">
                    <?php echo $user_number; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-4 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-website"></i></div>
                <div class="name"><strong class="text-uppercase">Sites référencés</strong><span>dans l'annuaire</span>
                  <div class="count-number">
                   <?php echo $site_number;  ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-4 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-presentation"></i></div>
                <div class="name"><strong class="text-uppercase">Annuaires</strong><span>annaires de référencement</span>
                  <div class="count-number">
                    <?php echo $annuaire_number; ?>                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      

      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-4">

              <div class="card income text-center">
                <div class="icon"><i class="icon-line-chart"></i></div>
                <div class="number"><?php echo $accepted_number; ?></div><strong class="text-primary">référencement accepté</strong>
                <p><?php echo $accepted_number; ?> référencement de site ont été accepté dans les annuaires.</p>
              </div>
            </div>
            <div class="col-lg-4">

              <div class="card data-usage">
                <h2 class="display h4">demande en attente</h2>
                <div class="row d-flex align-items-center">
                  <div class="col-sm-6">
                    <div id="progress-circle" class="d-flex align-items-center justify-content-center"></div>
                  </div>
                  <div class="col-sm-6"><strong class="text-primary"><?php echo $wait_number; ?></strong><span>Demande en cours</span></div>
                </div>
                <a href="annuaires/index.php" style="color: black">visualisez la liste pour plus de détails.</a>
              </div>
            </div>
            <div class="col-lg-4">

              <div class="card user-activity">
                <h2 class="display h4">Activité utilisateurs</h2>
                <div class="number"><?php echo $user_number; ?></div>
                <h3 class="h4 display">utilisateurs</h3>
                <div class="progress">
                  <div role="progressbar" style="width: <?php echo $percent ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
                </div>
                <div class="page-statistics d-flex justify-content-between">
                  <div class="page-statistics-left">
                  </div>
                  <div class="page-statistics-right"><span>Nouvelles mise-à-jour</span><strong><?php echo $update_number ?></strong>
                  </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
      var number = <?php echo intval(($wait_number/$annuaire_number)*100); ?>;
      console.log(number);
    </script>
    <?php }
    else{
    header("location:connexion.php");
    } ?>
  </body>
</html>