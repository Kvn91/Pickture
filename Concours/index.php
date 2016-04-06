<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset=utf-8>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_concours.css">
	<link rel="stylesheet" href="css/style_btn_participer.css">
	<link rel="stylesheet" href="css/popup_participer.css">
	<link rel="stylesheet" type="text/css" href="css/style_hover.css" />
	<script type='text/javascript' src="js/jquery.min.js"></script>
	<script src="../js/password.js"></script>
	<script src="../js/valid_form2.js"></script>
	<script type="text/javascript">
		// script pour le design du champs d'upload d'image
		 function getFile(){
		   document.getElementById("upfile").click();
		 }
		 function sub(obj){
		    var file = obj.value;
		    var fileName = file.split("\\");
		    document.getElementById("upImage").innerHTML = fileName[fileName.length-1];
		    event.preventDefault();
		}
	</script>
	<title>Pickture</title>

</head>
	 
	<body>
		
		<div id="page">


			<?php
				include 'menu.php';
				include '../php/connection.php';

				//récupère l'id du concours
				$id_pageConcours = $_GET['id'];
				
			?>

			<div id="moove">
				<!-- IMAGES GRAND FORMAT -->
				<img src="" class="img_full">
				<div class='cover'></div>

				<!--//////////////////////////////////////////////////////
				/////////////// FORMULAIRE D'INSCRIPTION /////////////////
				//////////////////////////////////////////////////////-->

				<aside class='inscription_popup'>
					<h4>Inscription</h4>
					<form id="form_insc" method="post" action="inscription/traitement_inscription.php">
		    	    	<input id="login" type="text" name="login" placeholder="Login" required> <div id="pseudobox" class=""></div><br>
		    	    	<input id="password" type="password" name="password" placeholder="Mot de passe alphanumérique" required> <div id="info_mdp" class="">Temps de crack :</div><br>
		    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
		    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
		    	    	<input class="valider" id="envoyer" type="submit" name="submit">
	        		</form>
					<button id="close" onclick='avgrund.deactivate();'>Close</button>
				</aside>


				<!--//////////////////////////////////////////////////////
				////////////////// FORMULAIRE D'UPLOAD ///////////////////
				//////////////////////////////////////////////////////-->

				<div class='concours_cover'></div> 
				<aside class='concours_popup'>
					<h4>UPLOAD :</h4>
					<?php
						// on passe l'id du concours dans le traitement pour ajoutée l'image au bon concours
						echo "<form id='form_post' action='php/traitementUpload.php?id=".$id_pageConcours."' method='post' enctype='multipart/form-data'>";
					?>

						<div id="upImage" onclick="getFile()">Choisir une image</div>
						<div style='height: 0px;width: 0px; overflow:hidden;'><input name="image" id="upfile" type="file" value="upload" onchange="sub(this)" required></div>

						<p class="nomImage"> <input type='text' name='nomImage' placeholder="Nom" required></p>
						<p class"descImage"> <textarea name='descriptionImage' placeholder="Description"></textarea></p>
						<p><input class="valider" type="submit" name="sendImage"></p>
					</form>
					<button id="close_concours" onclick='post.deactivate2();'>Close</button>
				</aside>


				<div id="contenu">


					



					<!-- TITRE/BOUTON -->
					<div>	
						<?php
							// on va chercher le nom du concours pour l'afficher
							$req_concours 		= mysql_query("SELECT nom from monkeyfabase.concours where id='$id_pageConcours' ") or die(mysql_error());
							$rep_concours		= mysql_fetch_assoc($req_concours);
							$nom 				= $rep_concours['nom'];
							echo '<h4>CONCOURS<br>#'.utf8_encode($nom).'</h4>';
						?>


						<div id="participer">
			                <p>	
			                    <?php
									if (isset($_SESSION['login'])) 
										echo '<a href="#" class="participer_btn" onclick="post.activate2();">PARTICIPER </a>';
				                    else
				                        echo '<a style="font-size:2em;" href="#" class="participer_btn" onclick="avgrund.activate();">Vous devez vous inscrire pour participer.</a>';
			                    ?> 
			                </p>
		               	</div>
	               	</div>

				
				<!--//////////////////////////////////////////////////////
				/////////////////////// CARROUSEL ////////////////////////
				//////////////////////////////////////////////////////-->

					<div id="carousel" class="list_carousel">
						<ul id="foo3"> 

							<?php

								$req_image 				= mysql_query("SELECT image_concours, image_full, valide, id_oeuvre, id_concours from monkeyfabase.oeuvres where id_concours='$id_pageConcours'") or die(mysql_error());
								$nombreImages			= mysql_num_rows($req_image);

								for ( $i=0; $i<$nombreImages; $i++) {
								
									$valide 			= mysql_result($req_image, $i, 'valide');

									// si l'image  a été autorisée par un administrateur
									if ($valide == 1) {

										$image_concours 	= mysql_result($req_image, $i, 'image_concours');
										$image_full 		= mysql_result($req_image, $i, 'image_full');								
										$id_oeuvre			= mysql_result($req_image, $i, 'id_oeuvre');
										list($srcX, $srcY, $type, $attr) = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);

										// affichage des images. On passe leurs dimensions en input pour gérer leur affichage en JavaScript. On passe également leur id pour gérer le vote etc...
										echo '<li class="view"><div class="back"><div id="img_open" class="lien_full"><input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input></div><div id="img_coeur" class="vote"><input type="hidden" value="'.$id_oeuvre.'"></input></div><div id="'.$id_oeuvre.'" class="div_vote"></div></div><img src="http://www.pickture.monkeyfactory.fr/Concours/'.$image_concours.'" alt="1"></li>';				
									}
								}
							?>
						</ul>	
						<div class="clearfix"></div>
					</div>
					<span  id="prev" >&#9666;</span>
					<span id="next" >&#9656;</span>


				<!--////////////////////////////////////////////////////////////////
				/////////////////////// AFFICHAGE DES VOTES ////////////////////////
				/////////////////////////////////////////////////////////////////-->

						<?php

							$req_image2 			= mysql_query("SELECT image_full, id_oeuvre from monkeyfabase.oeuvres") or die(mysql_error());
							$nombre_images			= mysql_num_rows($req_image2);

							for ( $i=0; $i<$nombre_images; $i++) {
								$images_galerie 		= mysql_result($req_image2, $i, 'image_full');
								$id_oeuvre 				= mysql_result($req_image2, $i, 'id_oeuvre');

								echo '<script type="text/javascript">
										var _id_image = "'.$images_galerie.'";
										
										/*En ajax on récupère le nombre de vote*/

										$.post("php/get_vote.php", {id:_id_image}, 
									        function(nbr_vote){  
									        	$("#'.$id_oeuvre.'").text(nbr_vote);
									    	}
									    );
								</script>';
							}
					?>
									
	
					<script type="text/javascript" src="js/caroufredsel.js"></script>

					<script type="text/javascript" src="js/carousel.js"></script>
					<script type='text/javascript' src='js/avgrund.js'></script>
					<script type='text/javascript' src='js/post.js'></script>
					<script type="text/javascript" src="js/modernizr.custom.69142.js"></script>
					<script type="text/javascript">	
				
						Modernizr.load({
							test: Modernizr.csstransforms3d && Modernizr.csstransitions,
							yep : ['http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js','js/jquery.hoverfold.js'],
							nope: 'css/fallback.css',
							callback : function( url, result, key ) {
									
								if( url === 'js/jquery.hoverfold.js' ) {
									$( '#foo3' ).hoverfold();
									$( '#fooX' ).hoverfold();
								}
							}
						});


						



							cover = document.querySelector( '.cover' );

							// annuler le pop-up avec la touche echappe
							function escape( event ) {
								if( event.keyCode === 27 ) {
									$('.img_full').removeClass('img_active');
									$('.cover').removeClass('active');
									document.removeEventListener( 'keyup', escape, false );
									document.removeEventListener( 'click', clickout, false );
									$('.img_full').attr('src',"");
								}
							};

							// annuler le pop-up en cliquant en dehors de l'image
							function clickout( event ) {
								if( event.target === cover ) {
									$('.img_full').removeClass('img_active');
									$('.cover').removeClass('active');
									document.removeEventListener( 'keyup', escape, false );
									document.removeEventListener( 'click', clickout, false );
									$('.img_full').attr('src',"");
								}
							};


							/*//////////////////////////////////////////////////////
							//////////////////// POP-UP IMAGE //////////////////////
							//////////////////////////////////////////////////////*/

							$('.lien_full').click( function(e) {
								var _path_full					= null;
								var _id 						= null;
								var _width						= null;
								var _height						= null;

								// on récupère les dimensions de l'image et son chemin
								_path_full 						= e.target.childNodes[0].value.toString();
								_width							= e.target.childNodes[1].value.toString();
								_height							= e.target.childNodes[2].value.toString();


								_id = 'http://www.pickture.monkeyfactory.fr/Concours/'+_path_full;

								//on donne l'attribut correspondant à la minitature sur laquelle on a cliqué
								$('.img_full').attr('src',_id);

								// on gère l'affichage centré
								$('.img_full').css({'margin-left': -_width/2, 'margin-top': ((-_height/2)-40)});
							
								// on ajoute des classes pour afficher l'image et mettre une opacité sur le reste de la page
									$('.img_full').addClass('img_active');
									$('.cover').addClass('active');

								document.addEventListener( 'keyup', escape, false );
								document.addEventListener( 'click', clickout, false );
								
							});


							/*//////////////////////////////////////////////////////
							//////////////////////// VOTE //////////////////////////
							//////////////////////////////////////////////////////*/

							$(".vote").click( function(e) {
				 				var _id 						= e.target.childNodes[0].value.toString();

				 				// En ajax on gère le vote qui est actualisé si l'on clique sur le coeur.
								$.post("php/vote.php", {id_image : _id },  
					                function(vote){  
					                	if (vote == "Vous avez déjà voté pour cette oeuvre.") {
					                		alert(vote);
					                	}
					                	else if (vote == "Vous n'êtes pas inscrit.") {
					                		alert(vote);
					                	}
					                	else {
					                		$('#'+_id+'').text(vote);
					                	}
					            	}
					            );
							});
					</script>	
				</div>
			</div>
		</div>
	</body>
</html>