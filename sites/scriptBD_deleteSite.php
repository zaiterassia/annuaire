<?php 
session_start();
require_once("../config.php");
$id = mysqli_real_escape_string($con,$_GET['dn']);

$sql = "DELETE FROM notes WHERE id ='$id'";
$res=mysqli_query($con,$sql);
if($res)
	{
		mysqli_close($con);
		$_SESSION["reussi"]=1;
		$_SESSION["msg"]="Le site a bien été supprimé";
		header("location:index.php");

	}
	else
	{
		mysqli_close($con);
		$_SESSION["reussi"]=0;
		$_SESSION["msg"]="Le site n'a pas pu être supprimé de la liste";
		header("location:index.php");
	}

?>