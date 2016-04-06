<?php
include '../php/connection.php';

$id 					= $_POST['id'];

$req_refuser			= mysql_query("DELETE FROM monkeyfabase.oeuvres  WHERE id_oeuvre = '$id' ") or die(mysql_error());

?>