<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8>
<link rel="stylesheet" href="css/style_mur.css">
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
<script src="http://10.0.10.222:1337/socket.io/socket.io.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/valid_form2.js"></script>
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
				<aside class='avgrund-popup'>
					<h4>Inscription</h4>
					<form method="post" action="inscription/traitement_inscription.php">
		    	    	<input id="login" type="text" name="login" placeholder="Login" required> <div id="pseudobox" class=""></div><br>
		    	    	<input id="password" type="password" name="password" placeholder="Mot de passe" required><div id="info_mdp" class=""></div><br>
		    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
		    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
		    	    	<input id="envoyer" type="submit" name="submit">
	        		</form>
					<button onclick='avgrund.deactivate();'>Close</button>
				</aside>

				<div id="milieu">
					<div id="en_tete">
						<h1>Mur Dessin</h1>
						<h2><span id="span_jours">07</span>:<span id="span_heures">10</span>:<span id="span_minutes">40</span>:<span id="span_secondes">00</span></h2>
					</div>

					<div id="canvas_holder">
						<!--
						Dimensions du canvas à préciser directement dans le HTML en tant qu'attributs de la balise.
						Si c'est fait dans la CSS, le ratio H/L est faussé.
						-->
						<div class="cursor"></div>
						<canvas id="canvas" width="1000" height="700"></canvas>
					</div>


					<?php 
						$id = $_SESSION['login'];
						echo '<input type="hidden" id="id_user" value="'.$id.'">';
					?>
				</div>

				<div id="bas">
					<div id="ouverture_bas">Outils <span>&oplus;</span></div>
					<div id="contenu_bas">
						<div id="utilisateur_connecter"><h3>Artistes présents : </h3><ul id="liste_user"></ul></div>
						<div id="bouton_taille">
							Taille de l'outil<br>
							<button id="fin">Fin</button>
							<button id="moyen">Moyen</button>
							<button id="epais">Épais</button>
						</div>
						<div id="couleur"><canvas id="canvas_couleur" width="200" height="200"></canvas></div>
						<!-- <div id="map"><span id="pos_carte">vous</span></div> -->
					</div>
				</div>
			</div>
		</div>	
	</div>
	<script type='text/javascript' src='js/avgrund.js'></script>
	<script src="http://localhost:1337/socket.io/socket.io.js"></script>
	<script src="js/client.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
