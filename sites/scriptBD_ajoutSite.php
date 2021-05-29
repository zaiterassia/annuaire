<?php
session_start ();
require_once("../config.php");
$site=mysqli_real_escape_string($con,$_POST['site']);
$description=mysqli_real_escape_string($con,$_POST['description']);
$motcle=mysqli_real_escape_string($con,$_POST['motcle']);
$idauteur=$_SESSION["idauteur"];


$req= "SELECT *
FROM notes
WHERE NOM='$site'";
$res=mysqli_query($con,$req);
$nb_resultats = mysqli_num_rows($res);
if($nb_resultats == '0')
{
	$req2="INSERT INTO notes (NOM,auteur, datemodif, texte, motcle) VALUES('$site', '$idauteur', NOW(), '$description', '$motcle')";
	if ($con->query($req2) === TRUE) {
  			$_SESSION["reussi"]=1;
  			$_SESSION["msg"]="Succès, le site a bien été ajouté !.";
  			header("location:index.php");
		} else {
  			$SESSION["reussi"]= 0;
  			$_SESSION["msg"]="Echec, le site n'a pu être ajouté.";
  			header("location:index.php");
		}

		$con->close();

}
else
{
	mysqli_close($con);
	$_SESSION["reussi"]=0;
	$_SESSION["msg"]="Echec, le site ajouté existe déjà !.";
	header("location:ajoutSite.php");
}
?>