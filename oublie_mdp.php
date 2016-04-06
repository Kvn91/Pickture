<?php
	session_start();
	include 'php/connection.php';
?>
<!DOCTYPE html>
<head>
<meta charset=utf-8>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style_oublie.css">
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"></script>
<meta name="viewport" content="initial-scale=1.0">
<!-- <script src="js/password.js"></script> -->

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
		    	    	<input id="password" type="password" name="password" placeholder="Mot de passe" required> <br>
		    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
		    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
		    	    	<input class="valider" id="envoyer" type="submit" name="submit">
	        		</form>
					<button id="close" onclick='avgrund.deactivate();'>Close</button>
				</aside>

				<div id="milieu">
					<div id="form_oublie">
						Afin de vous envoyer un nouveau mot de passe, veuillez saisir votre email.
						<br>
						<form method="POST" action="oublie_mdp.php">
							<input type="email" id="email_oublie" name="email_oublie"/>
							<input type="submit" id="envoi_email_oublie" name="submit_oublie" value="Nouveau mot de passe" />
						</form>

						<?php
							$from 					= 'From: contact@pickture.fr';
							if (isset($_POST['submit_oublie'])) {
								$email = $_POST['email_oublie'];

								$req = mysql_query('SELECT * FROM users WHERE mail="'.$email.'"')or die (mysql_error());

								$info = mysql_fetch_assoc($req);
								if ($info) {
									$new_mdp = rand(1000, 10000);
									$req = mysql_query('UPDATE users SET password="'.md5($new_mdp).'" WHERE mail="'.$email.'"');
									echo '<span class="email_oublie_bon">Email envoyé</span>';

									mail($email, 'Changement de mot de passe Pickture.fr', 'Suite à votre changement de mot de passe voici le nouveau: '.$new_mdp, $from);
								}else{
									echo '<span class="email_oublie_mauvais">Adresse email invalide</span>';
								}

							}
						?>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<script type='text/javascript' src='js/avgrund.js'></script>
	<script type="text/javascript">
		console.log('Vous êtes curieux ? Alors venez travailler chez nous ! contact@monkeyfactory.fr ')
		var _hauteur_milieu_haut= $('#milieu_haut').height();
		var _hauteur_page = $(window).height();

		if (_hauteur_milieu_haut < _hauteur_page) {
			$('#moove').height(_hauteur_page);
			$('#milieu').height(_hauteur_page);
		}else{
			$('#moove').height(_hauteur_milieu_haut);
			$('#milieu').height(_hauteur_milieu_haut);
		};

		$(window).resize( function() {
			_hauteur_milieu_haut= $('#milieu_haut').height();
			_hauteur_page = $(window).height();

			if (_hauteur_milieu_haut < _hauteur_page) {
				$('#moove').height(_hauteur_page);
				$('#milieu').height(_hauteur_page);
			}else{
				$('#moove').height(_hauteur_milieu_haut);
				$('#milieu').height(_hauteur_milieu_haut);
			};
		});
	</script>
</body>

</html>