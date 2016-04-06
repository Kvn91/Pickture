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
		    	    	<input id="password" type="password" name="password" placeholder="Mot de passe alphanumérique" required> <div id="info_mdp" class="">Temps de crack :</div><br>
		    	    	<input id="password_confirm" type="password" name="password_confirm" placeholder="Confirmer Mot de passe" required> <div id="mdpbox" class=""></div><br>
		    	    	<input id="email" type="email" name="email" placeholder="E-mail" required> <div id="mailbox" class=""></div><br>
		    	    	<input class="valider" id="envoyer" type="submit" name="submit">
	        		</form>
					<button id="close" onclick='avgrund.deactivate();'>Close</button>
				</aside>

				<div id="milieu_cond">
					<h1>Conditions <br>d'utilisations</h1>
					<div id="texte_cond">
						Le présent document a pour objet de définir les modalités et conditions dans lesquelles d’une part, L'equipe PICKTURE , ci-après dénommé l’EDITEUR, met à la disposition de ses utilisateurs le site, et les services disponibles sur le site et d’autre part, la manière par laquelle l’utilisateur accède au site et utilise ses services.
					Toute connexion au site est subordonnée au respect des présentes conditions.
					Pour l’utilisateur, le simple accès au site de l’EDITEUR à l’adresse URL suivante pickture.monkeyfactory.fr implique l’acceptation de l’ensemble des conditions décrites ci-après.<br><br>
					<h2>Propriété intellectuelle</h2><br>
					La structure générale du site www.pickture.monkeyfactory.fr , ainsi que les textes, graphiques, images, sons et vidéos la composant, sont la propriété de l'éditeur ou de ses partenaires. Toute représentation et/ou reproduction et/ou exploitation partielle ou totale des contenus et services proposés par le site www.pickture.monkeyfactory.fr, par quelque procédé que ce soit, sans l'autorisation préalable et par écrit de Fabien Moline et/ou de ses partenaires est strictement interdite et serait susceptible de constituer une contrefaçon au sens des articles L 335-2 et suivants du Code de la propriété intellectuelle.
					Aucune reproduction, même partielle prévue à l’article L.122-5 du Code de la propriété intellectuelle, ne peut être faite de ce site sans l’autorisation du directeur de publication.
					Responsabilité de l’éditeur
					Les informations et/ou documents figurant sur ce site et/ou accessibles par ce site proviennent de sources considérées comme étant fiables.
					Toutefois, ces informations et/ou documents sont susceptibles de contenir des inexactitudes techniques et des erreurs typographiques.
					L’EDITEUR (l'équipe PICKTURE ) se réserve le droit de les corriger, dès que ces erreurs sont portées à sa connaissance.
					Les informations et/ou documents disponibles sur ce site sont susceptibles d’être modifiés à tout moment, et peuvent avoir fait l’objet de mises à jour.
					L’utilisation des informations et/ou documents disponibles sur ce site se fait sous l’entière et seule responsabilité de l’utilisateur, qui assume la totalité des conséquences pouvant en découler, sans que l’EDITEUR puisse être recherché à ce titre, et sans recours contre ce dernier.
					<br><br>
					<h2>Accès au site</h2><br>
					L’éditeur s’efforce de permettre l’accès au site 24 heures sur 24, 7 jours sur 7, sauf en cas de force majeure ou d’un événement hors du contrôle de l’EDITEUR, et sous réserve des éventuelles pannes et interventions de maintenance nécessaires au bon fonctionnement du site et des services.
					Par conséquent, l’EDITEUR ne peut garantir une disponibilité du site et/ou des services, une fiabilité des transmissions et des performances en terme de temps de réponse ou de qualité. Il n’est prévu aucune assistance technique vis à vis de l’utilisateur que ce soit par des moyens électronique ou téléphonique.
					La responsabilité de l’éditeur ne saurait être engagée en cas d’impossibilité d’accès à ce site et/ou d’utilisation des services.
					Par ailleurs, l’EDITEUR peut être amené à interrompre le site ou une partie des services, à tout moment sans préavis, le tout sans droit à indemnités. L’utilisateur reconnaît et accepte que l’EDITEUR ne soit pas responsable des interruptions, et des conséquences qui peuvent en découler pour l’utilisateur ou tout tiers.
					</div>
				</div>

			</div>
		</div>	
	</div>
	<script type='text/javascript' src='js/avgrund.js'></script>
	<script type="text/javascript">
		console.log('Vous êtes curieux ? Alors venez travailler chez nous ! contact@monkeyfactory.fr ')
		var _hauteur_milieu_haut= $('#texte_cond').height();
		var _hauteur_page = $(window).height();

		if (_hauteur_milieu_haut < _hauteur_page - 250) {
			$('#moove').height(_hauteur_page - 220);
			$('#milieu').height(_hauteur_page - 220);
		}else{
			$('#moove').height(_hauteur_milieu_haut + 110);
			$('#milieu').height(_hauteur_milieu_haut + 110);
		};

		// $(window).resize( function() {
		// 	_hauteur_milieu_haut= $('#milieu').height();
		// 	_hauteur_page = $(window).height();

		// 	if (_hauteur_milieu_haut < _hauteur_page - 250) {
		// 		$('#moove').height(_hauteur_page - 220);
		// 		$('#milieu').height(_hauteur_page - 220);
		// 	}else{
		// 		$('#moove').height(_hauteur_milieu_haut + 110);
		// 		$('#milieu').height(_hauteur_milieu_haut + 110);
		// 	};
		// });
	</script>
</body>

</html>