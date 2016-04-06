<?php
session_start();

include '../php/connection.php';

if(isset($_POST['submit_connexion'])){
	$login = $_POST['login'];
	$mdp = $_POST['mdp'];

	$replog = mysql_query('select login from users where login="'.$login.'"') or die ("Erreur login");
	if ($replog) {
		$req = mysql_query('select * from users where login="'.$login.'" ') or die (mysql_error());

		$info = mysql_fetch_assoc($req);
		if (md5($mdp) == $info['password']) {
			if ($info['active'] == 1) {
				$_SESSION['login'] = $login;
				unset($_SESSION['erreur']);
			}
			else{
				$_SESSION['erreur'] = "Compte non activé";
			}
		}
		else{
			$_SESSION['erreur'] = "Identifiant et/ou mot de passe errones";
		}
	}
	else{
		$_SESSION['erreur'] = "Identifiant et/ou mot de passe errones";
	}

}

header('location: ../index.php')

?>