<div id="menu">
			<a href="../index.php"><h2>Pickture</h2></a>
			<span class="slogan">Imag'in Gallery</span>

			<?php
				if (isset($_SESSION['mail_inscription'])) {
					echo '<div class="mail_inscription">Un email de validation a été envoyé. Veullez vérifier vos email pour activer votre compte !</div>';
					unset($_SESSION['mail_inscription']);
				}

				if (isset($_SESSION['activation']) && $_SESSION['activation'] == true) {
					echo '<div class="mail_inscription">Votre compte est maintenant actif !</div>';
					unset($_SESSION['activation']);
				} else if (isset($_SESSION['activation']) && $_SESSION['activation'] == false) {
					echo "<div class='mail_inscription'>Problème lors de l'inscritpion. Veuillez contactez contact@monkeyfactory.fr</div>";
					unset($_SESSION['activation']);
				}
			?>

			<div id="sous_menu">
				<div id="sous_menu_1">
					<h3>Menu</h3>
					<ul id="liste_menu">
						<a href="../index.php"><li id="home"></li></a>
						<a href="../galerie/index.php"><li id="galerie"></li></a>
						<a href="mur.php"><li id="mur"></li></a>
					</ul>


				</div>

				<div id="sous_menu_2">
					<article class='avgrund-contents'>
						<?php
							$id_pageConcours = $_GET['id'];
							if (isset($_SESSION['login'])) {
								echo '<h3>Profil</h3>';
								echo '<a href="../modif_profil.php">Modifier profil</a><br>';
								echo '<a href="php/deconnexion.php">Deconnexion</a>';
							} else if (!isset($_SESSION['login'])){
								echo "<h3>Connexion</h3>
									<form method='post' action='php/connexion.php?id=".$id_pageConcours."' >
									<input type='text' class='input' name='login' placeholder='Username'>
									<input type='password' class='input' name='mdp' placeholder='Mot de passe'>
									<input type='submit' id='submit_connexion' name='submit_connexion' value='&#59200;'>
									<a href='oublie_mdp.php' class='mdpoubli'>Mot de passe oubli&eacute ?</a>
								</form>
								<button id='inscription' onclick='avgrund.activate();'>S'inscrire</button>";
							}
						?>
						
					</article>
				</div>

				<div id="sous_menu_3">
					<h3>Liens utiles</h3>
					<a href="http://www.monkeyfactory.fr">L'agence Monkey Factory</a> <br>
					<a href="../conditions.php">Conditions d'utilisations</a>
					<?php
						if ($_SESSION['login'] == 'Admin') {
							echo '<div id="menu_admin"><a href="http://www.pickture.monkeyfactory.fr/Concours/gereConcours.php">Gérer les concours</a> <br><br>
							<a href="http://www.pickture.monkeyfactory.fr/Concours/gereOeuvres.php">Gérer les oeuvres participantes</a> <br></div>';
						}
					?>
				</div>
			</div>
		</div>

		<div id="menuuser">
				<?php 
					if (isset($_SESSION['login'])) {
						
						echo '<div id="menuuser_contenu">Bonjour '.$_SESSION['login'].' !<br></div>';
						
					} else if (isset($_SESSION['erreur'])){
						echo '<span class="pb_connexion">'.$_SESSION["erreur"].'</span>';
					} else if (!isset($_SESSION['login']) AND !isset($_SESSION['erreur'])){
						echo "<button class='menuuser_inscription' onclick='avgrund.activate();'>Nous rejoindre <span id='add_user'>&#59136</span></button>";
					}
				?>
		</div>