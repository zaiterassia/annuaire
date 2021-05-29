<?php
session_start ();
require_once("../config.php");
	$site=mysqli_real_escape_string($con,$_POST['site']);
	$accepter=mysqli_real_escape_string($con,$_POST['accepter']);
	$id=mysqli_real_escape_string($con,$_POST['id']);
	$mdp=mysqli_real_escape_string($con,$_POST['mdp']);
	$lienretour=mysqli_real_escape_string($con,$_POST['lienretour']);
	$observation=mysqli_real_escape_string($con,$_POST['observation']);
	$refsite=mysqli_real_escape_string($con,$_POST['refsite']);
	$identifiant=mysqli_real_escape_string($con,$_SESSION["modif"]);

$req= "SELECT *
		   FROM annuaire
		   WHERE site='$site'
		   AND refsite='$refsite'
		   AND id != '$identifiant';";
	$res=mysqli_query($con,$req);
	$nb_resultats = mysqli_num_rows($res);
if($nb_resultats == '0')
{
$req2="UPDATE annuaire SET site = '$site' ,acceptation = '$accepter' ,user = '$id' ,mdp = '$mdp' ,lienretour = '$lienretour' ,observations = '$observation' ,datemodif= NOW(),refsite = '$refsite' WHERE id='$identifiant'";
$res2=mysqli_query($con,$req2);
mysqli_close($con);
unset($_SESSION["modif"]);
$_SESSION["reussi"]=1;
$_SESSION["msg"]="L'annuaire a bien été modifié";
header("location:index.php");
}
else
{
	$_SESSION["reussi"]=0;
	$_SESSION["msg"]="L'annuaire n'a pas pu être modifié";
	mysqli_close($con);
	header("location:index.php");
}
?>