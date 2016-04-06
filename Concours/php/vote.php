<?php

	session_start();

	include 'connection.php';

	if (isset($_SESSION['login'])) {

		// grâce au login on récupère l'id du votant
		$login					= $_SESSION['login'];
		$req_login 				= mysql_query("SELECT id from monkeyfabase.users WHERE login='$login'") or die(mysql_error());
		$res_login				= mysql_fetch_assoc($req_login);
		$id_votant 				= $res_login['id'];

		// on récupère le nombre de vote et la liste des votants pour l'oeuvre
		$id_image 				= $_POST['id_image'];
		$req_oeuvre				= mysql_query("SELECT vote, tab_votant from monkeyfabase.oeuvres WHERE id_oeuvre='$id_image'") or die(mysql_error());
		$res					= mysql_fetch_assoc($req_oeuvre);
		$tab_votant 			= $res['tab_votant'];
		$vote 					= $res['vote'];

		// cette variable permet de savoir si la personne a déjà votée pour cette oeuvre
		$test 					= true;

		// si il n'y a pas encore eu de vote on n'a pas besoin de vérifier que le votant a déjà voté
		// sinon :
		if ($vote != 0) {

			// on récupère chaque id des personnes ayant votées
			$tab_votant_temp = explode("-", $tab_votant);

			for ($i=0; $i < $vote; $i++) { 

				// on fait la vérification
				if ($id_votant == $tab_votant_temp[$i]) {

					$test = false;
					break; 
				}
			}
		}

		// si la personne n'a pas encore votée :
		if ($test) {

			$vote					+= 1;

			$req_update_vote		= mysql_query("UPDATE monkeyfabase.oeuvres SET vote = '$vote' WHERE id_oeuvre = '$id_image'") or die(mysql_error());

			$tab_votant_new			= $tab_votant."".$id_votant."-";

			$req_update_votans		= mysql_query("UPDATE monkeyfabase.oeuvres SET tab_votant = '$tab_votant_new'  WHERE id_oeuvre = '$id_image'") or die(mysql_error());

			echo $vote;
		}

		else {
			$vote = "Vous avez déjà voté pour cette oeuvre.";
			echo $vote;	
		}
	}

	else {
		$vote = "Vous n'êtes pas inscrit.";
		echo $vote;
	}





?>