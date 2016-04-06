<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
    	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
    	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style_admin.css">
		<link rel="stylesheet" type="text/css" href="css/style_hover.css" />
		<script type='text/javascript' src="js/jquery.min.js"></script>
		<title>Pickture</title>
	</head>

	<body>
		<div id="page">
			<?php
				include 'menuAdmin.php';
				include '../php/connection.php';
			?>
			<div id="moove">
				<img src="" class="img_full">
				<div class='cover'></div> 

				<div id="contenu">
					
					
					
					<div id="carousel" class="list_carousel">
						<ul id="foo3"> 
							<?php
								// si on est connecté en tant qu'admin
								if ($_SESSION['login'] == 'Admin') {
									$req_image 					= mysql_query("SELECT image_concours, image_full, valide, id_oeuvre, nom, id_concours, id_auteur from monkeyfabase.oeuvres") or die(mysql_error());
									$nombreImages				= mysql_num_rows($req_image);


									// boucle pour afficher toutes les images présentes dans les concours
									for ( $i=0; $i<$nombreImages; $i++) {

										$valide 				= mysql_result($req_image, $i, 'valide');

										// si l'image  a été autorisée par un administrateur
										if ($valide == 0) {
											$image_concours 	= mysql_result($req_image, $i, 'image_concours');
											$image_full 		= mysql_result($req_image, $i, 'image_full');
											$valide 			= mysql_result($req_image, $i, 'valide');
											$id_oeuvre			= mysql_result($req_image, $i, 'id_oeuvre');
											$nom_oeuvre			= mysql_result($req_image, $i, 'nom');
											$id_concours		= mysql_result($req_image, $i, 'id_concours');
											$id_auteur			= mysql_result($req_image, $i, 'id_auteur');

											$req_concours 		= mysql_query("SELECT nom from monkeyfabase.concours where id='$id_concours' ") or die(mysql_error());
											$rep_concours		= mysql_fetch_assoc($req_concours);
											$nom_concours		= $rep_concours['nom'];

											$req_nom_auteur		= mysql_query("SELECT login from monkeyfabase.users where id='$id_auteur'");
											$rep_nom_auteur		= mysql_fetch_assoc($req_nom_auteur);
											$nom_auteur 		= $rep_nom_auteur['login'];

											list($srcX, $srcY, $type, $attr) = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);


											echo '<li class="view">
											<p id="concours">'.utf8_encode($nom_concours).'</p><p id="auteur">'.utf8_encode($nom_auteur).'</p>
											<div class="back">

												<div class="lien_full"><input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input>Full</div>

												<div class="autoriser"><input type="hidden" value="'.$id_oeuvre.'"></input>Autoriser</div>

												<div class="refuser"><input type="hidden" value="'.$id_oeuvre.'"></input>Refuser</div>

												<div id="'.$id_oeuvre.'" class="affiche_valide">'.$valide.'</div>

											</div>

											<img src="http://www.pickture.monkeyfactory.fr/Concours/'.$image_concours.'" alt="1"></li>';				
										}
									}
								}

								
							?>
						</ul>	
						<div class="clearfix"></div>
					</div>
					
					<span  id="prev" >&#9666;</span>
					<span id="next" >&#9656;</span>
									
	
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



							var cover = document.querySelector( '.cover' );

							function escape( event ) {
								if( event.keyCode === 27 ) {
									$('.img_full').removeClass('img_active');
									$('.cover').removeClass('active');
									document.addEventListener( 'keyup', escape, false );
									document.addEventListener( 'click', clickout, false );
									$('.img_full').attr('src',"");
								}
							};

							function clickout( event ) {
								if( event.target === cover ) {
									$('.img_full').removeClass('img_active');
									$('.cover').removeClass('active');
									document.addEventListener( 'keyup', escape, false );
									document.addEventListener( 'click', clickout, false );
									$('.img_full').attr('src',"");
								}
							};


							$('.lien_full').click( function(e) {
								var _path_full					= null;
								var _id 						= null;
								var _width						= null;
								var _height						= null;

								_path_full 						= e.target.childNodes[0].value.toString();
								_width							= e.target.childNodes[1].value.toString();
								_height							= e.target.childNodes[2].value.toString();


								_id = 'http://www.pickture.monkeyfactory.fr/Concours/'+_path_full;

								$('.img_full').attr('src',_id);

								$('.img_full').css({'margin-left': -_width/2, 'margin-top': -_height/2});
							

									$('.img_full').addClass('img_active');
									$('.cover').addClass('active');

								document.addEventListener( 'keyup', escape, false );
								document.addEventListener( 'click', clickout, false );
								
							});


							$(".autoriser").click( function(e) {
				 				var _id 						= e.target.childNodes[0].value.toString();

								$.post("script/autoriser.php", {id : _id },  
					                function(){  
					                	$("#"+_id+"").text('1');
					            	}
					            );
							});


							$(".refuser").click( function(e) {
				 				var _id 						= e.target.childNodes[0].value.toString();

								$.post("script/refuser.php", {id : _id },  
					                function(){  
					            	}
					            );
							});

									
							</script>
					
				</div>
			</div>
		</div>
	</body>
</html>