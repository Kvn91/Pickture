<?php
include '../php/connection.php';

$id 					= $_POST['id'];

$req_autoriser 			= mysql_query("UPDATE monkeyfabase.oeuvres SET valide='1' WHERE id_oeuvre = '$id' ") or die(mysql_error());


?>