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
    <title>amodifier un utilisateur</title>
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
    <?php if(isset($_SESSION["nom"]) ){
      if(isset($_SESSION['droits']) && $_SESSION['droits']==2) {
      $nom=$_SESSION["nom"];
      $prenom=$_SESSION["prenom"];
      if(isset($_GET["id"])){
        $id=$_GET["id"];
        $_SESSION['id']= $id;
      }
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
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Modifier un utilisateur</strong></div></a></div>
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
            <li class="breadcrumb-item"><a href="index.php">Utilisateurs</a></li>
            <li class="breadcrumb-item active">Modifier utilisteurs</li>
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

          <?php             
          $req = "SELECT * 
                  FROM profil
                  WHERE id = '$id';"; 
          $res=mysqli_query($con,$req);
          $data = mysqli_fetch_array($res);
          $_SESSION["id"]=$id;
                              
        ?>

      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1  style="text-align: center;">Modifier un utilisateur           </h1>
          </header>
          <div class="row">            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="scriptBD_modifUser.php" class="form-validate">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Identifiant</label>
                      <div class="col-sm-7">
                        <input type="text" name="identifiant" placeholder="identifiant" required data-msg="Ce champ est requis" class="form-control" value="<?php echo $data["USER"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Mot de passe</label>
                      <div class="col-sm-7">
                        <input type="password" name="mdp" placeholder="mot de passe" required data-msg="Ce champ est requis" data-rule-minlength="6" data-msg-minlength="Le mot de passe doit comprendre au moins 6 caractères."  class="form-control" value="<?php echo $data["PASS"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Nom</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" name="nom" placeholder="nom" required data-msg="Ce champ est requis" value="<?php echo $data["NOMPROFIL"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Prénom</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" name="prenom" placeholder="prénom" required  data-msg="Ce champ est requis" value="<?php echo $data["PRENOMPROFIL"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">E-mail</label>
                      <div class="col-sm-7">
                        <input type="email" name="email" required data-msg="Veuillez entrer une adresse e-mail valide" placeholder="email" class="form-control" value="<?php echo $data["Email"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Niveau droit</label>
                      <div class="col-sm-7">
                        <select name="niveaudroit" required data-msg="Selectionner une option dans la liste" class="form-control"  >
                            <?php $droit = ($data['niveaudroit'] == 1 ? 'utilisateur' : 'administrateur') ?>
                            <option value="<?php echo $data['niveaudroit'] ?>" selected disabled><?php echo $droit ?></option>
                            <option value="1">utilisateur</option>
                            <option value="2">administrateur</option>
                        </select> 
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Description</label>
                      <div class="col-sm-7">
                        <input class="form-control" type="text" name="description" placeholder="Ajouter une description" value="<?php echo $data["Description"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-4">
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
    else {header("location:../index.php");}
    } 
    else{header("location:../connexion.php");} 
    mysqli_close($con);?>
  </body>
</html>