<?php
session_start();
require_once("../config.php");

	$identifiant=mysqli_real_escape_string($con,$_POST['identifiant']);
	$password=mysqli_real_escape_string($con,$_POST['mdp']);
	$nom=mysqli_real_escape_string($con,$_POST['nom']);
	$prenom=mysqli_real_escape_string($con,$_POST['prenom']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$niveaudroit= intval(mysqli_real_escape_string($con,$_POST['niveaudroit']));
	$description=mysqli_real_escape_string($con,$_POST['description']);
	

	$req = "SELECT * 
			FROM profil
			WHERE USER = '$identifiant' or Email =  '$email';";
	$res=mysqli_query($con,$req);
	$nb_resultats = mysqli_num_rows($res);
	if($nb_resultats == '0')
	{
		$option = ['cost'=>11];
      	$hashed = password_hash($password, PASSWORD_BCRYPT,$option);
		$req="INSERT INTO profil (USER, MDP, PASS, Email, niveaudroit, NOMPROFIL, PRENOMPROFIL, Description) 
		  VALUES('$identifiant', '$hashed', '$password', '$email', '$niveaudroit', '$nom', '$prenom', '$description')";

		if ($con->query($req) === TRUE) {
  			$_SESSION["reussi"]=1;
  			$_SESSION["msg"]="Succès, l'utilisateur est bien ajouté !.";
  			header("location:index.php");
		} else {
  			$SESSION["reussi"]= 0;
  			$_SESSION["msg"]="Echec, l'utilisateur n'a pas pu être ajouté.";
  			header("location:index.php");
		}

		$con->close();

	}
	else {
		mysqli_close($con);
		$_SESSION["reussi"]=0;
		$_SESSION["msg"]="Echec, l'identifiant ou l'email existe déjà !.";
		header("location:ajoutUser.php");
		
	}
	
?>