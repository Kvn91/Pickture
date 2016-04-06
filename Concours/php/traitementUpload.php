<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/style_concours.css">
	<link rel="stylesheet" type="text/css" href="css/style_hover.css" />
	<title>Pickture</title>

</head>
	 
	<body>
		<div id="page">


			<?php
				include '../menuUpload.php';
				$id_pageUpload = $_GET['id'];
				include 'connection.php';
				include 'resize.php';
			?>





			<div id="moove">

				

				
					<aside class='inscription_popup'>
						<h4>Inscription</h4>
						<form id="form_insc" method="post" action="inscription/traitement_inscription.php">
			    	    	<input id="login" type="text" name="login" placeholder="Login" required> <div id="pseudobox" class=""></div><br>
			    	    	<input id="password" type="password" name="password" placeholder="Mot de passe" required> <br>
			    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
			    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
			    	    	<input class="valider" id="envoyer" type="submit" name="submit">
		        		</form>
						<button id="close" onclick='avgrund.deactivate();'>Close</button>
					</aside>

				<div id="contenu">
					<?php
						$extensions_valides = array( 'jpg' , 'jpeg' , 'png', 'gif');
						$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

							if (isset($_POST['sendImage'])) {
								$login = $_SESSION['login'];
								$req_id_participant 		= mysql_query("SELECT id from monkeyfabase.users where login='$login'") or die(mysql_error());
								$rep_id_participant 		= mysql_fetch_assoc($req_id_participant);
								$id_participant 			= $rep_id_participant['id'];
								$test_id 					= true;

								// on récupère l'id des participants à ce concours
								$req_id_auteur_concours 	= mysql_query("SELECT id_auteur from monkeyfabase.oeuvres where id_concours='$id_pageUpload'") or die(mysql_error());

								for ($i=0; $i<mysql_num_rows($req_id_auteur_concours); $i++) { 

									$id_participant_temp 	= mysql_result($req_id_auteur_concours, $i, 'id_auteur');
									if ($id_participant_temp == $id_participant) {
										$test_id 			= false;
									}
								}
								/*if ($test_id) {*/

									if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0) {
								       if ($_FILES['image']['size'] > $maxsize) {  
								        	if ( in_array($extension_upload,$extensions_valides) ) {

								        		$nom 		= $_POST['nomImage'];
									        	$nom 		= preg_replace('/\s/', '', $nom); 
										        $nom 		= strip_tags($nom);
									        	$test_nom 	= true;
								        		

								        		$req_nbr_votes = mysql_query("SELECT id_oeuvre from monkeyfabase.oeuvres where id_concours='$id_pageUpload'") or die(mysql_error());
								        		if (mysql_num_rows($req_nbr_votes)<= 11) {

								        			$req_nom_image = mysql_query("SELECT nom from monkeyfabase.oeuvres") or die(mysql_error());
								        			for ($i=0; $i<mysql_num_rows($req_nom_image); $i++) {
								        				$test_nom 	= mysql_result($req_nom_image, $i, 'nom');
								        				if ($test_nom == $nom) {
								        					$test_nom = false;
								        				}	
								        			}

									        		if ($test_nom==true) {

										        		$desc = $_POST['descriptionImage'];
										        		$desc = strip_tags($desc);

										        		// chemin des 3 dossiers d'image
										        		$image_path = 'images_concours/' . $nom . '.' . $extension_upload;
														$mini_concours_path = 'miniatures_concours/' . $nom . '.' . $extension_upload;
														$mini_accueil_path = 'miniatures_accueil/' . $nom . '.' . $extension_upload;

														//upload de l'image
														$resultat = move_uploaded_file($_FILES['image']['tmp_name'], "../".$image_path);
														if ($resultat) echo '<script>alert("Votre image a bien été postée.");
														window.location.href ="../index.php?id='.$id_pageUpload.'";</script>';
														else echo '<script>alert("Erreur lors du transfert, veuillez réessayer.");
														window.location.href ="../index.php?id='.$id_pageUpload.'";</script>';

													

													// si l'image est trop grande on la resize pour la galerie
													$largeurMax = 1000;
			 							 			$hauteurMax = 700;
			 							 			list($largeur_orig, $hauteur_orig) = getimagesize("../".$image_path);
			 							 			if ($largeur_orig > $largeurMax || $hauteur_orig > $hauteurMax) 
			 							 				images_resize_galerie("../".$image_path, $largeurMax, $hauteurMax);

			 							 			//resize pour le concours et l'accueil 
													images_resize_carre("../".$image_path,"../".$mini_concours_path,250);
													images_resize_carre("../".$image_path,"../".$mini_accueil_path,150);

														
													
													$valide					= 0;
													    	
													$req = mysql_query("INSERT INTO monkeyfabase.oeuvres (id_oeuvre, id_auteur, nom, description, image_concours, image_accueil, image_full, id_concours, nom_id, valide, vote, tab_votant) VALUES (NULL, '$id_participant', '$nom', '$desc', '$mini_concours_path', '$mini_accueil_path', '$image_path', '$id_pageUpload', '$nom"."$id_participant', '$valide', '0', '')") or die(mysql_error());

													if ($req)
														header('location: ../index.php?id='.$id_pageUpload);
													else
														echo '<script>alert("Erreur lors de l\'insertion dans la base de donnée."); 
													window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 

													}
													else
														echo '<script>alert("Ce nom a déjà été pris.");
													window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 
												}
												else 
													echo '<script>alert("Le nombre maximum d\'oeuvres participantes au concours a été atteint.");
												window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 
								        	}
								        	else
								        		echo '<script>alert("Mauvais type d\'image.");
								        	window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 
								        }
								    	else
								    		echo '<script>alert("L\'image est trop grosse.");
								    	window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 
								   	 }
									else
										echo '<script>alert("Erreur lors du transfert, veuillez réessayer.");
									window.location.href ="../index.php?id='.$id_pageUpload.'";</script>'; 
								/*}
								else 
									echo '<script>alert("Vous avez déjà participé à ce concours.")</script>'; */
							}
					?>
				</div>
			</div>
		</div>
	</body>
</html>