<?php 
session_start();

include '../php/connection.php';

$cle = $_GET['cle'];

$req = mysql_query("UPDATE monkeyfabase.users SET active = 1 WHERE cle='$cle'") or die(mysql_error());

if ($req) {
	$_SESSION['activation'] = true;
	unset($_SESSION['erreur']);
	header('location: ../index.php');
} else {
	$_SESSION['activation'] = false;
	header('location: ../index.php');
}

 ?>