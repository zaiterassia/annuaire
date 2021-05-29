<?php
session_start();
require_once("../config.php");
	$id=$_SESSION['id'];
	$identifiant=mysqli_real_escape_string($con,$_POST['identifiant']);
	$password=mysqli_real_escape_string($con,$_POST['mdp']);
	$nom=mysqli_real_escape_string($con,$_POST['nom']);
	$prenom=mysqli_real_escape_string($con,$_POST['prenom']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$niveaudroit= intval(mysqli_real_escape_string($con,$_POST['niveaudroit']));
	$description=mysqli_real_escape_string($con,$_POST['description']);
	
	$option = ['cost'=>11];
    $hashed = password_hash($password, PASSWORD_BCRYPT,$option);

	$sql ="UPDATE profil set 
			USER='$identifiant', 
			MDP='$hashed',
			Email='$email', 
			NOMPROFIL='$nom', 
			PRENOMPROFIL='$prenom', 
			Description='$description', 
			niveaudroit='$niveaudroit'
			 WHERE ID= '$id'";
	$res=mysqli_query($con,$sql);

	if($res)
	{
		mysqli_close($con);
		$_SESSION["reussi"]=1;
		$_SESSION["msg"]="Les modifications ont été bien sauvegardées";
		header("location:index.php");
		echo 1;
	}
	else
	{
		echo mysqli_error($con);
		mysqli_close($con);
		$_SESSION["reussi"]=0;
		$_SESSION["msg"]="Les modifications n'ont pas pu être sauvegardées";
		header("location:index.php");
		echo 0;
	}
	
?>