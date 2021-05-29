<?php
  require_once("../config.php");
  session_start();
    $email = mysqli_real_escape_string($con, $_POST['mail']);
    $sql = "SELECT * FROM profil WHERE Email =  '$email' or USER = '$email'";
    $res=mysqli_query($con,$sql);
    $nb_resultats = mysqli_num_rows($res);
    if($nb_resultats == '0'){
    	$_SESSION["reussi"]=0;
    	$_SESSION["msg"]="l'identifiant ou l'email n'existe pas";
    }
    else {
      $user = mysqli_fetch_array($res);
      $db_email = $user['Email'];
      $db_id = $user['ID'];
      $token = uniqid(md5(time())); //this is a random token.
      $sql = "INSERT INTO init_password(email,token) VALUES('$db_email', '$token')";
      if(mysqli_query($con, $sql)){
        $from = "<annuaire@exher.fr>";
        $to = $db_email;
        $subject = "Votre demande de nouveau mot de passe";
        // Create email headers
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        //$headers .= "CC: contact@exher.fr\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $to = $db_email;

        $username = $user["PRENOMPROFIL"];
        $button_link = '<a href="http://annuaire.exher.fr/password/set-new-password.php?id=' . $db_id .'&token=' . $token .'" target="_blank" style="display: inline-block; padding: 10px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 3px;">Confirmer ma demande</a>';
        $copy_link = '<a href="http://annuaire.exher.fr/password/set-new-password.php?id=' . $db_id .'&token=' . $token .'" target="_blank">http://annuaire.exher.fr/set-new-password.php?id=' . $db_id .'&token=' . $token . '</a>';

        $message = file_get_contents('reset.html');
        $message = str_replace("{{name}}",$username,$message);
        $message = str_replace("{{link1}}",$button_link,$message);
        $message = str_replace("{{link2}}",$copy_link,$message);

        mail($to, $subject, $message, $headers);
        $_SESSION["reussi"]=1;
        $_SESSION["msg"]="un lien de réinitialisation du mot de passe a été envoyé à l'adresse e-mail renseigné";
      }
    }
    mysqli_close($con);
    header("location:initMdp.php");
?>