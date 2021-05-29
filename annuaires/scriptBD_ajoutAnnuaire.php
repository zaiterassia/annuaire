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
$idauteur=$_SESSION["idauteur"];


$req= "SELECT *
FROM annuaire
WHERE site='$site'
AND refsite='$refsite';";
$res=mysqli_query($con,$req);
$nb_resultats = mysqli_num_rows($res);
if($nb_resultats == '0')
{
	$req2="INSERT INTO annuaire (site, acceptation, user, mdp, lienretour, observations, datemodif, refsite, auteur) VALUES('$site', '$accepter', '$id', '$mdp', ' $lienretour','$observation',NOW(),'$refsite','$idauteur')";
	$res1=mysqli_query($con,$req2);
	$_SESSION["reussi"]=1;
	$_SESSION["msg"]="L'annuaire a bien été inséré dans la liste.";
	mysqli_close($con);
	header("location:index.php");
}
else
{
	$_SESSION["reussi"]=0;
	$_SESSION["msg"]="Le site est déjà référencé pour cet annuaire.";
	mysqli_close($con);
	header("location:index.php");
}
?>