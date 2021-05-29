<?php
session_start ();
include("config.php");
	$login=mysqli_real_escape_string($con, $_POST['login']);
	$password=mysqli_real_escape_string($con, $_POST['password']);
	$req = "SELECT * 
			FROM profil
			WHERE USER = '$login' OR Email = '$login'";
	$res=mysqli_query($con,$req);
	$data = mysqli_fetch_array($res);
	$nb_resultats = mysqli_num_rows($res);
	if($nb_resultats == '0')
	{
		$_SESSION["reussi"]=0;
      	$_SESSION["msg"]="identifiant incorrect";
      	echo "first clause";
		header("location:connexion.php");

	}
	elseif(!password_verify($password, $data['MDP'] )){
		$_SESSION["reussi"]=0;
      	$_SESSION["msg"]="mot de passe incorrect";
      	echo "seconde clause";
		header("location:connexion.php");
	}
	else
	{
		$id = $data['ID'];
		$sql = "UPDATE profil set lastlogin= NOW() WHERE ID =  '$id'";
		$res=mysqli_query($con,$sql);
		$_SESSION["idauteur"]=$data["ID"];
		$_SESSION["login"] = $data["USER"];
		$_SESSION["password"] = $data["MDP"];
		$_SESSION['email']=$data["Email"];
		$_SESSION["nom"]=$data["NOMPROFIL"];
		$_SESSION["prenom"]=$data["PRENOMPROFIL"];
		$_SESSION["droits"]=$data["niveaudroit"];		
		$_SESSION["description"] = $data["Description"];
		header("location:index.php");
	}
	mysqli_close($con);
?>