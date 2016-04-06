<?php 

	$defaut_largeur_max=250;
	$defaut_hauteur_max=250;
	$size_im=getimagesize('../images_concours/test.jpg');

	if(isset($_GET["w"]) && ($_GET["w"]+0)) 
		$largeur_max = $_GET["w"]; 
	else 
		$largeur_max = $defaut_largeur_max;

	if(isset($_GET["h"]) && ($_GET["h"]+0)) 
		$hauteur_max = $_GET["h"]; 
	else 
		$hauteur_max = $defaut_hauteur_max;

	if($size_im[0]>=$size_im[1] && $size_im[0]>$largeur_max) {
		$largeur=$largeur_max;
		$hauteur=ceil(($largeur/$size_im[0])*$size_im[1]);
	} 
	elseif($size_im[1]>=$size_im[0] && $size_im[1]>$hauteur_max) {
		$hauteur=$hauteur_max;
		$largeur=ceil(($hauteur/$size_im[1])*$size_im[0]);
	} 
	else {
		$largeur=$size_im[0];
		$hauteur=$size_im[1];
	}

										header("Content-Type: image/jpeg");
										$img_in = imagecreatefromjpeg('../images_concours/test.jpg');
										$img_out = imagecreatetruecolor($largeur, $hauteur);
										imagecopyresampled($img_out, $img_in, 0, 0, 0, 0, imagesx($img_out), imagesy($img_out), imagesx($img_in), imagesy($img_in));
										$t = imagejpeg($img_out);
										echo $t;
?>