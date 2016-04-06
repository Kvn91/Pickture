<?php
	session_start();
	include 'php/connection.php';
?>
<!DOCTYPE html>
<head>
<meta charset=utf-8>
<link rel="stylesheet" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"></script>
<script src="js/valid_form2.js"></script>
<meta name="viewport" content="initial-scale=1.0">
<script src="js/password.js"></script>

<title>Pickture</title>

</head>
<div class='cover'></div> 
<body>
	<div id="page">
		<?php
			include 'menu.php';
		?>
		<div id="moove">
			<div id="contenu">

				<div class='cover'></div> 
				<aside class='inscription_popup'>
					<h4>Inscription</h4>
					<form id="form_insc" method="post" action="inscription/traitement_inscription.php">
		    	    	<input id="login" type="text" name="login" placeholder="Login" required> <div id="pseudobox" class=""></div><br>
		    	    	<input id="password" type="password" name="password" placeholder="Mot de passe" required> <div id="info_mdp" class="">Temps de crack :</div><br>
		    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
		    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
		    	    	<input class="valider" id="envoyer" type="submit" name="submit">
	        		</form>
					<button id="close" onclick='avgrund.deactivate();'>Close</button>
				</aside>

				<div id="milieu">
					<div id="milieu_haut">
						<h1>CONCOURS</h1>
						<ul>
							<?php
								$req = mysql_query('SELECT * FROM concours');

								for ($i = 1; $i <= mysql_num_rows($req); $i++) {
									$r = 0;
									$other = false;

									$req_name = mysql_query('SELECT nom FROM concours WHERE id="'.$i.'"');
									$nom_concours = mysql_fetch_array($req_name);

									$req_place = mysql_query('SELECT * FROM oeuvres WHERE id_concours="'.$i.'"');
									$nmbr_participant = mysql_num_rows($req_place);
									$place_dispo = 12 - $nmbr_participant;

									$req_users = mysql_query('SELECT id_auteur FROM oeuvres WHERE valide="1" AND id_concours="'.$i.'"') or die(mysql_error());


									echo '<a href="/Concours/index.php?id='.$i.'"><li><span class="titre_concours">#'.$i.' '.utf8_encode($nom_concours['nom']).'</span><br>
						    					<span class="places_restantes">'.$place_dispo.' place(s)</span> disponible(s)<br>
						     					<span class="participants_concours">Participant(s): <br>
						     					<span class="decal_nom">';

						     		
						     		while ($rep_users = mysql_fetch_assoc($req_users)) {
						     			foreach ($rep_users as $key => $value) {
											$req_login = mysql_query('SELECT login FROM users WHERE id="'.$value.'"');
											$rep_login = mysql_fetch_assoc($req_login);

											if ($r >= 3) {
												$autres_participants = $nmbr_participant - 3;
												if (!$other) {
													echo $autres_participants.' autres...';
													$other = true;
												}
											} else{
												echo $rep_login['login'].'<br>';
												$r ++;
											}
										}
						     		}
						     		echo '</span></span></li></a>';			
								}
							?>
						</ul>
					</div>

					<div id="milieu_bas">
						<?php
							if (!isset($_SESSION['login'])) {
								echo '<h1>VIENS !</h1>
										<ul>
										    <li id="un_signup" class="slide_etape"><span>Étape #1</span><span class="slide_prec">Prec</span><span class="slide_suiv">Suiv</span><br><div class="contenu"><p>Clique sur le lien d\'inscription dans le menu déroulant, pour rejoindre la galérie d\'art la plus connecter !</p><br><img src="img/un_signup.png" ></div></li>
										    <li id="deux_signup" class="slide_etape"><span>Étape #2</span><span class="slide_prec">Prec</span><span class="slide_suiv">Suiv</span><br><div class="contenu"><p>Remplis le formulaire d\'inscription en validant tout les champs !</p><br><img src="img/deux_signup.png" ></div></li>
										    <li id="trois_signup" class="slide_etape"><span>Étape #3</span><span class="slide_prec">Prec</span><span class="slide_suiv">Suiv</span><br><div class="contenu"><p>Regarde tes mails afin de récupérer le message de confirmation d\'inscription.</p><br><img src="img/trois_signup.png" ></div></li>
										    <li id="quatre_signup" class="slide_etape"><span>Étape #4</span><span class="slide_prec">Prec</span><span class="slide_suiv">Suiv</span><br><div class="contenu"><p>Choisis un concours qui te plaît et force le destin pour devenir l\'artiste numérique le plus connu de la toile !</p><br><img src="img/quatre_signup.png" ></div></li>
										</ul>';
							} else{
								echo '<h1>MUR</h1>
										<a href="mur.php"><span id="bouton_mur">Accéder au mur</span></a>';
							}
						?>
					</div>
				</div>

				<div id="bas">
					<div id="wrapper">
						<div id="carousel">
							<img src="http://lorempixel.com/150/150/abstract/1" alt="1"/>
							<img src="http://lorempixel.com/150/150/abstract/2" alt="2"/>
							<img src="http://lorempixel.com/150/150/abstract/3" alt="4"/>
							<img src="http://lorempixel.com/150/150/abstract/4" alt="5"/>
							<img src="http://lorempixel.com/150/150/abstract/5" alt="7"/>
							<img src="http://lorempixel.com/150/150/abstract/6" alt="8"/>
							<img src="http://lorempixel.com/150/150/abstract/7" alt="9"/>
							<img src="http://lorempixel.com/150/150/abstract/8" alt="10"/>
							<img src="http://lorempixel.com/150/150/abstract/9" alt="11"/>
							<img src="http://lorempixel.com/150/150/abstract/1" alt="12"/>
							<img src="http://lorempixel.com/150/150/abstract/2" alt="13"/>
							<img src="http://lorempixel.com/150/150/abstract/3" alt="14"/>
							<img src="http://lorempixel.com/150/150/abstract/4" alt="15"/>
							<img src="http://lorempixel.com/150/150/abstract/5" alt="16"/>
							<img src="http://lorempixel.com/150/150/abstract/6" alt="17"/>
						</div>
					</div>
					<a id="prev" href="#">&#59237;</a>
					<a id="next" href="#">&#59238;</a>
					<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
					<script type="text/javascript" src="js/caroufredsel.js"></script>
					<script type="text/javascript" src="js/carrousel.js"></script>
				</div>
			</div>
		</div>	
	</div>
	<script type='text/javascript' src='js/avgrund.js'></script>
	<script type="text/javascript">
		console.log('Vous êtes curieux ? Alors venez travailler chez nous ! contact@monkeyfactory.fr ')
		var _hauteur_milieu_haut= $('#milieu_haut').height();
		var _hauteur_page = $(window).height();

		if (_hauteur_milieu_haut < _hauteur_page - 250) {
			$('#moove').height(_hauteur_page - 220);
			$('#milieu').height(_hauteur_page - 220);
		}else{
			$('#moove').height(_hauteur_milieu_haut + 110);
			$('#milieu').height(_hauteur_milieu_haut + 110);
		};

		$(window).resize( function() {
			_hauteur_milieu_haut= $('#milieu_haut').height();
			_hauteur_page = $(window).height();

			if (_hauteur_milieu_haut < _hauteur_page - 250) {
				$('#moove').height(_hauteur_page - 220);
				$('#milieu').height(_hauteur_page - 220);
			}else{
				$('#moove').height(_hauteur_milieu_haut + 110);
				$('#milieu').height(_hauteur_milieu_haut + 110);
			};
		});

		/*
		** ETAPE INSCRIPTION
		*/
		var html_un_signup = $('#un_signup');
		var html_deux_signup = $('#deux_signup');
		var html_trois_signup = $('#trois_signup');
		var html_quatre_signup = $('#quatre_signup');
	
		var suivant = $('.slide_suiv');
		var precedent = $('.slide_prec');
	
		var current_slide = 1;
	
		html_deux_signup.hide();
		html_trois_signup.hide();
		html_quatre_signup.hide();
	
		suivant.mouseup(function () {
			current_slide += 1;
			if (current_slide > 4) {
				current_slide = 1;
			};
			affiche();
		});

		precedent.mouseup(function () {
			current_slide -= 1;
			if (current_slide < 1) {
				current_slide = 4;
			};
			affiche();
		});


		function affiche() {
			switch(current_slide){
				case 1:
					html_deux_signup.fadeOut(200);
					html_trois_signup.fadeOut(200);
					html_quatre_signup.fadeOut(200);
					setTimeout("html_un_signup.fadeIn(500);", 200);
					break;
				case 2:
					html_un_signup.fadeOut(200);
					html_trois_signup.fadeOut(200);
					html_quatre_signup.fadeOut(200);
					setTimeout("html_deux_signup.fadeIn(500);", 200);
					break;
				case 3:
					html_un_signup.fadeOut(200);
					html_deux_signup.fadeOut(200);
					html_quatre_signup.fadeOut(200);
					setTimeout("html_trois_signup.fadeIn(500);", 200);
					break;
				case 4:
					html_un_signup.fadeOut(200);
					html_deux_signup.fadeOut(200);
					html_trois_signup.fadeOut(200);
					setTimeout("html_quatre_signup.fadeIn(500);", 200);
					break;
				default:
					break;
			}
		}
	</script>
</body>

</html>