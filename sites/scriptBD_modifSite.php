<?php

session_start ();
require_once("../config.php");
$description=mysqli_real_escape_string($con,$_POST['description']);
$motcle=mysqli_real_escape_string($con,$_POST['motcle']);
$nom=$_SESSION["site"];
$idauteur=$_SESSION["idauteur"];

$req="UPDATE notes SET auteur='$idauteur', datemodif=NOW(), texte = '$description', motcle = '$motcle' WHERE NOM = '$nom'";

$res=mysqli_query($con,$req);

if($res)
	{
		mysqli_close($con);
		$_SESSION["reussi"]=1;
		$_SESSION["msg"]="Les modifications ont été bien sauvegardées";
		echo 1;
	}
	else
	{
		mysqli_close($con);
		$_SESSION["reussi"]=0;
		$_SESSION["msg"]="Les modifications n'ont pas pu être sauvegardées";
		echo 0;
	}
	die();

?>