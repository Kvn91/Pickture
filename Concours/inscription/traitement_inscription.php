<?php 
session_start();
unset($_SESSION['erreur']);

include '../php/connection.php';

if(isset($_POST['submit'])){
	$login                 = $_POST['login'];
	$password              = $_POST['password'];
	$email                 = $_POST['email'];	

	$active					= 0;
	$cle					= 0;
	$from 					= 'From: inscriptions@pickture.fr'."\r\n".
								'Reply-To: contact@monkeyfactory.fr'. "\r\n".
								'X-Mailer: PHP/' . phpversion();

    $reqlog = mysql_query("SELECT login from monkeyfabase.users where login='$login'") or die(mysql_error());
    $replog = mysql_fetch_assoc($reqlog);

    $reqmail = mysql_query("SELECT mail from monkeyfabase.users where mail='$email'") or die(mysql_error());
    $repmail = mysql_fetch_array($reqmail);


    if ($replog == null && $repmail == null) {
    	$cle=md5(uniqid(rand(), true));

        $req = mysql_query("INSERT INTO monkeyfabase.users (id, login, password, mail, cle, active) VALUES (NULL, '$login', '".md5($password)."', '$email', '$cle', '$active')") or die(mysql_error());

    	if ($req) {
            $_SESSION['mail_inscription'] = true ;
    		mail($email, 'Confirmation Insciption Pickture.fr !', 'http://pickture.monkeyfactory.fr/inscription/activation_compte.php?cle='.$cle, $from);
            header('Location: ../index.php');
    	}

    } else{
    	echo "Déjà éxistant";
    }

   }

 ?>