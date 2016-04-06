<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/style_finConcours.css">
	<script type='text/javascript' src="js/jquery.min.js"></script>
	<title>Pickture</title>

</head>
	 
	<body>
		
		<div id="page">


			<?php
				include '../menu.php';
			?>





			<div id="moove">

				<div id="contenu">
					<?php
	
						include '../php/connection.php';

						if ($_POST['id_fin_concours']) {

							$id_fin_concours		 			= $_POST['id_fin_concours'];

							$req_oeuvres 						= mysql_query("SELECT vote from monkeyfabase.oeuvres where id_concours='$id_fin_concours'") or die(mysql_error());
							$nom_concours 						= mysql_query("SELECT nom from monkeyfabase.concours where id='$id_fin_concours'") or die(mysql_error());
							$nombre_images						= mysql_num_rows($req_oeuvres);

							if ($nombre_images == 0) {

								$req_delete_concours = mysql_query("DELETE FROM monkeyfabase.concours  where id = '$id_fin_concours' ") or die(mysql_error());

								if ($req_delete_concours) { 
									echo '<script>alert("Concours supprimé.")</script>';
									header('Location: ../gereConcours.php');
								}
								else 
									echo '<script>alert("Erreur lors de la suppression du concours.")</script>';
							}

							else if ($nombre_images == 1) {

								$req_gagnant					= mysql_query("SELECT id_auteur, nom, description, image_concours, image_full, nom_id from monkeyfabase.oeuvres where id_concours='$id_fin_concours'") or die(mysql_error());
								$rep_gagnant 					= mysql_fetch_assoc($req_gagnant);
								$id_auteur 						= $rep_gagnant['id_auteur'];
								$nom 							= $rep_gagnant['nom'];
								$description 					= $rep_gagnant['description'];
								$miniature 						= $rep_gagnant['image_concours'];
								$image_full 					= $rep_gagnant['image_full'];
								$nom_id 						= $rep_gagnant['nom_id'];

								
								$req_insert = mysql_query("INSERT INTO monkeyfabase.galerie (id_oeuvre, id_auteur, nom, description, miniature, image_full, nom_id, nom_concours) VALUES (NULL, '$id_auteur', '$nom', '$description', '$miniature', '$image_full', '$nom_id', '$nom_concours') ") or die(mysql_error());
								
								if ($req_insert) {
									$req_delete_oeuvres = mysql_query("DELETE FROM monkeyfabase.oeuvres  where id_concours = '$id_fin_concours' ") or die(mysql_error());

									$req_delete_concours = mysql_query("DELETE FROM monkeyfabase.concours  where id = '$id_fin_concours' ") or die(mysql_error());
								

									if ($req_delete_oeuvres && $req_delete_concours) { 
										echo '<script>alert("Concours supprimé.")</script>';
										header('Location: ../gereConcours.php');
									}
										else
											echo '<script>alert("Erreur lors de la suppression des oeuvres ou du concours.")</script>';
								}
								else
									echo '<script>alert("Erreur lors de l\'insertion des oeuvres dans la galerie.")</script>';
							}	

							else {

								$req_sortants = mysql_query("SELECT nom FROM monkeyfabase.galerie ORDER BY id_oeuvre ASC");
								$nbr_images_galerie = mysql_num_rows($req_sortants);

								if ($nbr_images_galerie>=2) {
									$i=0;									
									while ($rep_sortants = mysql_fetch_assoc($req_sortants)) {
										$temp = $rep_sortants['nom'];
										$req_delete_sortants = mysql_query("DELETE FROM monkeyfabase.galerie where nom='$temp'");
										$i++;
										if ($i>=2)
											break;
									}
								}
								


								$vote1 								= 0;
								$vote2 								= 0;

								for ($i=0; $i<mysql_num_rows($req_oeuvres); $i++) {

									$vote_temp = mysql_result($req_oeuvres, $i, 'vote');

									if ($vote_temp>$vote1) {
										$vote2 = $vote1;
										$vote1 = $vote_temp;
									}

									else if ($vote_temp>$vote2)
										$vote2 = $vote_temp;
								}

								$req_gagnants 						= mysql_query("SELECT id_auteur, nom, description, image_concours, image_full, nom_id from monkeyfabase.oeuvres where ((vote='$vote1' or vote='$vote2') and (id_concours='$id_fin_concours'))") or die(mysql_error());

								$nbr_res							= mysql_num_rows($req_gagnants);

								for ( $i=0; $i<$nbr_res; $i++) {

									$id_auteur 						= mysql_result($req_gagnants, $i, 'id_auteur');
									$nom 							= mysql_result($req_gagnants, $i, 'nom');
									$description					= mysql_result($req_gagnants, $i, 'description');
									$miniature 						= mysql_result($req_gagnants, $i, 'image_concours');
									$image_full 					= mysql_result($req_gagnants, $i, 'image_full');
									$nom_id 						= mysql_result($req_gagnants, $i, 'nom_id');

									$req_insert = mysql_query("INSERT INTO monkeyfabase.galerie (id_oeuvre, id_auteur, nom, description, miniature, image_full, nom_id, nom_concours) VALUES (NULL, '$id_auteur', '$nom', '$description', '$miniature', '$image_full', '$nom_id', '$nom_concours') ") or die(mysql_error());
								}

								if ($req_insert) {
									$req_delete_oeuvres = mysql_query("DELETE FROM monkeyfabase.oeuvres  WHERE id_concours = '$id_fin_concours' ") or die(mysql_error());

									$req_delete_concours = mysql_query("DELETE FROM monkeyfabase.concours  WHERE id = '$id_fin_concours' ") or die(mysql_error());
								

									if ($req_delete_oeuvres && $req_delete_concours) { 
										echo '<script>alert("Concours supprimé.")</script>';
										header('Location: ../gereConcours.php');
									}
									else
										echo '<script>alert("Erreur lors de la suppression des oeuvres ou du concours.")</script>';

								}
								else
									echo '<script>alert("Erreur lors de l\'insertion des oeuvres dans la galerie.")</script>';
							}
						}



						else if ($_POST['id_debut_concours'] && $_POST['nom']) {
							$id_debut_concours 					= $_POST['id_debut_concours'];
							$nom 								= utf8_decode($_POST['nom']);

							$req_concours 						= mysql_query("SELECT id from monkeyfabase.concours") or die(mysql_error());

							$nombre_concours					= mysql_num_rows($req_concours);

							$test_id_concours					= true;

							for ( $i=0; $i<$nombre_concours; $i++) {
								$id_concours 					= mysql_result($req_concours, $i, 'id');
								if ($id_concours == $id_debut_concours) {
									$test_id_concours 			= false;
								}
							}

							if ($test_id_concours == true) {
								$req_insert_concours			= mysql_query("INSERT INTO monkeyfabase.concours (id, nom) VALUES ('$id_debut_concours', '$nom') ") or die(mysql_error());

								if ($req_insert_concours) {
									echo '<script>alert("Concours créé.")</script>';
									header('Location: ../gereConcours.php');
								}
								else 
									echo '<script>alert("Erreur lors de la création du concours.")</script>';
							}
							else
								echo '<script>alert("Ce concours existe déjà.")</script>';
						}

						else 
							echo '<script>alert("Vous n\'avez pas remplis tous les champs.")</script>';


					?>
				</div>
			</div>
		</div>
	</body>
</html>					