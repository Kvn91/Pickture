<?php

	include 'connection.php';

		$id 					= $_POST['id'];
	
		$req_vote 				= mysql_query("SELECT vote from monkeyfabase.oeuvres WHERE image_full = '$id' ") or die(mysql_error());
		$res					= mysql_fetch_assoc($req_vote);
		$nbr_vote 				= $res['vote'];

		


		echo $nbr_vote;




?>