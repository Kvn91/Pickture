<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_finConcours.css">
	<script type='text/javascript' src="js/jquery.min.js"></script>
	<title>Pickture</title>

</head>
	 
	<body>
		
		<div id="page">


			<?php
				include 'menuAdmin.php';
			?>





			<div id="moove">

				<div id="contenu">
					<?php

						if ($_SESSION['login'] == 'Admin') {
							echo '<h4>Gérer les concours</h4>
							<form id="form_admin" method="post" action="script/finConcours.php">
								<div><p>Commencer un concours : </p>
									<input id="id_debut_concours" type="text" name="id_debut_concours" placeholder="Id du concours"><br>
									<input id="nom_concours" type="text" name="nom" placeholder="Nom du concours"><br>
								</div>
								<div><p>Supprimer un concours : </p>
				    	    		<input id="id_fin_concours" type="text" name="id_fin_concours" placeholder="Id du concours"><br>
				    	    	</div>
				    	    	<br>
				    	    	<input id="submitFin" type="submit" name="submit">
			        		</form>';
			        	}
			        ?>
				</div>
			</div>
		</div>
	</body>
</html>