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
    <title>modifier un annuaire</title>
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
      $id=$_GET["dn"];
      $_SESSION["modif"]=$id;
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
                  <div class="brand-text d-none d-md-inline-block"><strong class="text-primary">Modifier un annuaires</strong></div></a></div>
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
            <li class="breadcrumb-item"><a href="index.php">Annuaire</a></li>
            <li class="breadcrumb-item active">Modifier un annuaire</li>
          </ul>
        </div>
      </div>
      <?php             
          $req = "SELECT * 
                  FROM annuaire
                  WHERE id = '$id';"; 
          $res=mysqli_query($con,$req);
          $data = mysqli_fetch_array($res);
          $_SESSION["modif"]=$id;
                              
        ?>

      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1  style="text-align: center;">Modifier un annuaire            </h1>
          </header>
          <div class="row">            
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="scriptBD_modifAnnuaire.php" class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Annuaire</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " name="site" placeholder="Site" required value="<?php echo $data["site"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Site référencé</label>
                      <div class="col-sm-10">
                        <select class="form-control " name="refsite">
                             <option value="<?php echo $data["refsite"]; ?>" selected disabled><?php echo $data["refsite"]; ?> </option>
                            <?php 
                                $qry = "SELECT * FROM notes"; 
                                $res = mysqli_query($con, $qry); 
                                while($donnees = mysqli_fetch_array($res)) { 
                            ?>
                            <option value="<?php echo $donnees['NOM'] ?>"><?php echo $donnees['NOM'] ?></option>
                            <?php } ?>
                        </select> 
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Accepter</label>
                      <div class="col-sm-10">
                        <select class="form-control " name="accepter">
                            <option value="<?php echo $data["acceptation"]; ?>" selected disabled><?php echo $data["acceptation"]; ?> </option>
                            <option value="OUI">Oui</option>
                            <option value="NON">Non</option>
                            <option value="EN ATTENTE">En Attente</option>
                        </select> 
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Identifiat/Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " name="id" placeholder="ID/Mail" value="<?php echo $data["user"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Mot de passe</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " name="mdp" placeholder="Mot de passe" value="<?php echo $data["mdp"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Lien retour</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " name="lienretour" placeholder="Lien retour" value="<?php echo $data["lienretour"]; ?>">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label ">Observations</label>
                      <div class="col-sm-10">
                        <textarea class="form-control " type="text" name="observation" placeholder="Commentaires" value="<?php echo $data["observations"]; ?>"></textarea>
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-secondary" onclick="history.back();">Annuler</button>
                        <button type="submit" class="btn btn-primary" >Sauvegarder</button>
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
    header("location:../connexion.php");
    } 
    mysqli_close($con);?>
  </body>
</html>