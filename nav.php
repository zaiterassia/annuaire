  <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><a href="<?php echo $url . "/utilisateurs/profile.php" ?>"><img src="<?php echo $url . "/img/avatar.png" ?>" alt="person" class="img-fluid rounded-circle"></a>
            <h2 class="h5">
              <?php echo $prenom." ".$nom; ?>
            </h2><span><?php echo $_SESSION["description"]; ?></span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.php" class="brand-small text-center"> <strong><?php echo $prenom[0]; ?></strong><strong class="text-primary"><?php echo $nom[0]; ?></strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Menu</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="<?php echo $url ."/index.php" ?>"> <i class="icon-home"></i>Accueil</a></li>
            <li><a href="#dropdown0" aria-expanded="false" data-toggle="collapse"> <i class="icon-presentation"></i>Annuaires</a>
              <ul id="dropdown0" class="collapse list-unstyled ">
                <li><a href="<?php echo $url . "/annuaires" ?>" >Liste des annuaires</a></li>
                <li><a href="<?php echo $url . "/annuaires/ajoutAnnuaire.php" ?>">Ajouter un annuaire</a></li>
              </ul>
            </li>
            <li><a href="#dropdown1" aria-expanded="false" data-toggle="collapse"> <i class="icon-website"></i>Sites référencés</a>
              <ul id="dropdown1" class="collapse list-unstyled ">
                <li><a href="<?php echo $url ."/sites" ?>">Liste des sites</a></li>
                <li><a href="<?php echo $url ."/sites/ajoutSite.php" ?>">Ajouter un site</a></li>
              </ul>
            </li>
            <?php if(isset($_SESSION['droits']) && $_SESSION['droits']==2){ ?>
            <li><a href="#dropdown2" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Utilisateurs</a>
              <ul id="dropdown2" class="collapse list-unstyled ">
                <li><a href="<?php echo $url ."/utilisateurs" ?>">Liste des utilisateurs</a></li>
                <li><a href="<?php echo $url ."/utilisateurs/ajoutUser.php" ?>">Ajouter un utilisateur</a></li>              
              </ul>
            </li>
            <?php } ?>
            <li><a href="#dropdown3" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Contenu</a>
              <ul id="dropdown3" class="collapse list-unstyled ">
                <?php 
                  $qry = "SELECT * FROM notes"; 
                  $res = mysqli_query($con, $qry); 
                  while($donnees = mysqli_fetch_array($res)) { 
                ?>
                <li><a href="<?php echo $url . "/sites/notes.php?site=" . $donnees['NOM']; ?>"><?php echo $donnees['NOM']; ?></a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>