<?php 
session_start();
require_once("../config.php");
$id = mysqli_real_escape_string($con,$_GET['id']);

$sql = "DELETE FROM profil WHERE id ='$id'";
$res=mysqli_query($con,$sql);
if($res)
	{
		mysqli_close($con);
		$_SESSION["reussi"]=1;
		$_SESSION["msg"]="L'utilisateur a bien été supprimé";
		header("location:index.php");

	}
	else
	{
		mysqli_close($con);
		$_SESSION["reussi"]=0;
		$_SESSION["msg"]="L'utilisateur n'a pas pu être supprimé";
		header("location:index.php");
	}

?>