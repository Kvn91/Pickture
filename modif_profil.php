<?php
	session_start();
	include 'php/connection.php';

	if (!$_SESSION['login']) {
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<head>
<meta charset=utf-8>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style_modif.css">
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
				<div id="milieu">
					<div id="info_utlisateur">
						<?php 
							$req = mysql_query('SELECT * FROM users WHERE login="'.$_SESSION['login'].'"');

							$info = mysql_fetch_assoc($req);

							if ($info) {
								echo '
										<div id="titre_modif">
											<h1>Informations personnelles</h1>
										</div>
										<form method="POST" action="modif_profil.php">
										<label>Ancien Password</label><input type="password" class="input" name="mdp"><br>
										<label>Nouveau Password</label><input type="password" class="input" name="mdp_nouveau">
										<label>E-mail</label><input type="email" class="input" name="mail" value="'.$info['mail'].'">
										<label>Nom</label><input type="text" class="input" name="nom" value="'.$info['nom'].'">
										<label>Prenom</label><input type="text" class="input" name="prenom" value="'.$info['prenom'].'"><br>
										<label>Description</label><textarea class="input" name="description" value="'.$info['description'].'"></textarea><br>
										<input type="submit" name="submit_modif" id="submit_modif" value="Enregistrer les modifications">
									</form>';
							}

							if (isset($_POST['submit_modif'])) {
								$mdp = $_POST['mdp'];
								$mdp_nouveau = $_POST['mdp_nouveau'];
								$nom = $_POST['nom'];
								$prenom = $_POST['prenom'];
								$mail = $_POST['mail'];
								$description = $_POST['description'];
								$change_mdp_vieux = false;

								if ($mdp) {
									if (md5($mdp) == $info['password']) {
										$change_mdp_vieux = true;
									}else{
										$erreur = '<span id="changement_erreur">Erreur mot de passe.</span>';
										$change_mdp_vieux = false;
									}
								}

								if ($mdp_nouveau && $change_mdp_vieux) {
									$req = mysql_query('UPDATE users SET password="'.md5($mdp_nouveau).'" WHERE login="'.$_SESSION['login'].'"');
									$erreur = '<span id="changement_ok">Changement enregistrer</span>';
								}

								if ($nom) {
									$req = mysql_query('UPDATE users SET nom="'.$nom.'" WHERE login="'.$_SESSION['login'].'"');
								}

								if ($prenom) {
									$req = mysql_query('UPDATE users SET prenom="'.$prenom.'" WHERE login="'.$_SESSION['login'].'"');
								}

								if ($description) {
									$req = mysql_query('UPDATE users SET description="'.$description.'" WHERE login="'.$_SESSION['login'].'"');
								}

								if ($mail) {
									if ($mail == $info['mail']) {

									}else{
										$req = mysql_query('SELECT mail FROM users WHERE mail="'.$_POST['mail'].'"');
										$repmail = mysql_fetch_assoc($req);

										if ($repmail) {
											echo '<span id="changement_erreur">Email déjà utilisé.</span>';
										}else{
											$req = mysql_query('UPDATE users SET mail="'.$mail.'" WHERE login="'.$_SESSION['login'].'"');
										}
									}
								}

								if (isset($erreur)) {
									echo $erreur;
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
		var _hauteur_milieu_haut= $('#info_utlisateur').height();
		var _hauteur_page = $(window).height();

		if (_hauteur_milieu_haut < _hauteur_page) {
			$('#moove').height(_hauteur_page);
			$('#milieu').height($('#moove').height);
		}else{
			$('#moove').height(_hauteur_milieu_haut);
			$('#milieu').height(_hauteur_milieu_haut);
		};

		$(window).resize( function() {
			_hauteur_milieu_haut= $('#info_utlisateur').height();
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