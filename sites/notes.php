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
    <title>notes</title>
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
      if(isset($_GET["site"])){
        $site=$_GET["site"];
        $_SESSION['site']= $site;
      }
      else {$site=$_SESSION['site'];}
      
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
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Description site</strong></div></a></div>
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
            <li class="breadcrumb-item"><a href="index.php">Contenu</a></li>
            <li class="breadcrumb-item active"><?php echo $site; ?></li>
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

      <section>
        <?php 
          $qry = "SELECT * FROM notes WHERE nom='$site'";
          $res = mysqli_query($con, $qry);
          $donnees = mysqli_fetch_array($res);
          $qry = "SELECT * FROM annuaire WHERE refsite='$site'";
          $res = mysqli_query($con, $qry);
          $result=mysqli_query($con, "SELECT count(*) as total from annuaire WHERE refsite='$site'");
          $data=mysqli_fetch_assoc($result);
          $annuaire_number = $data['total'];
          $result=mysqli_query($con, "SELECT count(*) as total from annuaire WHERE refsite='$site' AND acceptation='OUI'");
          $data=mysqli_fetch_assoc($result);
          $accepted_number = $data['total'];
          $result=mysqli_query($con, "SELECT count(*) as total from annuaire WHERE refsite='$site' AND acceptation='EN ATTENTE'");
          $data=mysqli_fetch_assoc($result);
          $waited_number = $data['total'];
          $result=mysqli_query($con, "SELECT count(*) as total from annuaire WHERE refsite='$site' AND (acceptation='NON' OR acceptation='')");
          $data=mysqli_fetch_assoc($result);
          $inaccepted_number = $data['total'];




        ?>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1  style="text-align: center;"><?php echo $site; ?>           </h1>
          </header>
          <div class="card">
            <div class="card-body">
              <div class="row"> 
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="card-title">Liste des annuaires</h3>
                    </div>
                    <div class="card-body">
                    <?php
                      $nb_resultats = mysqli_num_rows($res);
                      if($nb_resultats !=0){ ?>
                      <ul class="text-small list-unstyled">
                        <li><strong><?php echo $annuaire_number ?></strong> annuaire</li>
                        <?php for ($i = 1; $i < 10; $i++) {
                          if ($data = mysqli_fetch_array($res)){
                          if ($data['acceptation'] =="OUI"){ ?>
                            <li><i aria-hidden="true" class="fa fa-check text-success mr-2"></i><?php echo $data['site']; ?> </li>
                           <?php }elseif ($data['acceptation'] =="EN ATTENTE"){ ?>
                            <li><i aria-hidden="true" class="fa fa-exclamation-triangle text-warning mr-2"></i><?php echo $data['site']; ?> </li>
                           <?php }else{ ?>
                            <li><i aria-hidden="true" class="fa fa-times text-danger mr-2"></i><?php echo $data['site']; ?> </li>

                            <?php } }
                      }?>
                      <li>...</li>
                      </ul>
                      <div class="float-right"><a href="../annuaires/index.php?site=<?php echo $_SESSION['site'] ?>" ><p>Visualiser la liste pour plus de details</p></a></div>
                    <?php } else { ?>
                      <p style="text-align: center;">  aucune donnée à afficher </p>
                    <?php } ?>                      
                    </div>
                  </div>
                </div> 
                <div class="col-lg-6">
                  <div class="card pie-chart-example">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="card-title">Représentation des données</h3>
                    </div>
                    <div class="card-body">
                    <?php if($nb_resultats!=0) { ?>
                      <div class="chart-container">
                        <canvas id="pieChartExample"></canvas>
                      </div>
                    <?php } else { ?> 
                      <p style="text-align: center;">  aucune donnée à afficher </p>
                    <?php } ?>
                    </div>
                  </div>
                </div>            
              </div>
              <!-- Descripstion          -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title"><a data-toggle="collapse" data-parent="#new-updates" href="#desc" aria-expanded="true" aria-controls="desc">Description</a></h3><a data-toggle="collapse" data-parent="#new-updates" href="#desc" aria-expanded="true" aria-controls="desc"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="desc" role="tabpanel" class="collapse show">
                  
                  <p id="description" onblur="divNoedit()" style="padding: 30px; font-size: 16px;"><?php echo $donnees['texte'];?></p>
                  <div title="Modifier" class="float-right" style="padding: 20px;" onclick="divEdit(0)" onblur="divNoedit()">
                    <i class="fa fa-pencil" style="font-size:20px;color:blue"></i>
                  </div>
              
                </div>
              </div>

              <!-- Mots cles           -->
              <div id="new-updates" class="card updates recent-updated">
                <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title"><a data-toggle="collapse" data-parent="#new-updates" href="#cle" aria-expanded="true" aria-controls="cle">Mots clés</a></h3><a data-toggle="collapse" data-parent="#new-updates" href="#cle" aria-expanded="true" aria-controls="cle"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="cle" role="tabpanel" class="collapse show">
                  <p id="motcle" onblur="divNoedit()" style="padding: 30px; font-size: 16px;"><?php echo $donnees['motcle'];?></p>
                  <div class="float-right" style="padding: 20px;"  onclick="divEdit(1)" >
                    <i class="fa fa-pencil" style="font-size:20px;color:blue"></i>
                  </div>
                </div>
              </div>
              <div class="form-group row">
              	<div class="col-sm-4 offset-sm-2">
                	<button type="submit" class="btn btn-secondary" onclick="history.back();">Annuler</button>
                	<button id="myButton" type="button" class="btn btn-primary" >Sauvegarder</button>
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
    <script src="../js/charts-note.js"></script>
    
    <!-- Main File-->
    <script src="../js/front.js"></script>
    <script type="text/javascript">
      function divEdit(arg) {
        if(arg) {
          document.getElementById("motcle").contentEditable = true;
          document.getElementById("motcle").style.outline = "1px solid";
        }
        else{
          document.getElementById("description").contentEditable = true;
          document.getElementById("description").style.outline = "1px solid";
        }
      }

      function divNoedit() {
      	document.getElementById("description").contentEditable = false;
        document.getElementById("description").style.outline = "0px solid transparent";
      	document.getElementById("motcle").contentEditable = false;
        document.getElementById("motcle").style.outline = "0px solid transparent";

      }

      var accepted_number = <?php echo $accepted_number; ?>;
      var waited_number = <?php echo $waited_number; ?>;
      var inaccepted_number = <?php echo $inaccepted_number; ?>;
      
// function to remvove style when paste from web
      document.addEventListener ("paste", function (e) {
        e.preventDefault ();
        var text;
        if (window.clipboardData) {
            text = window.clipboardData.getData ("text");
        } else {
            text = e.clipboardData.getData ("text/plain");
        }
        if (document.selection) {
            // ~ Internet Explorer 10
            var range = document.selection.createRange ();
            range.text = text;
        } else {
            // Internet Explorer 11/Chrome/Firefox
            var selection = window.getSelection ();
            var range = selection.getRangeAt (0);
            var node = document.createTextNode (text);
            range.insertNode (node);
            range.setStartAfter (node);
            range.setEndAfter (node);
            selection.removeAllRanges ();
            selection.addRange (range);
        }
      }, false);

    </script>
    <?php }
    else{
      header("location: ../connexion.php");
    } mysqli_close($con);?>
  </body>
</html>