<?php
function images_resize_carre($src, $dest, $largeur){

  list($srcX, $srcY, $type, $attr) = getimagesize($src);


  // $dim représente le plus petit côté

  // si l'image est plus large que haute
  if($srcX>= $srcY){
      $dim=$srcY;
      $horizontale=true;
  }

  // si l'image est plus haute que large
  elseif($srcX<= $srcY){
      $dim=$srcX; 
      $verticale=true;
  }

  else{
      $dim=$srcX;
  }   


  if($horizontale) {      
    $xSource=($srcX/2)-($dim/2);
    $ySource="0";    
  }
  elseif($verticale) {
    $xSource="0";
    $ySource=($srcY/2)-($dim/2);
  }
  else {
    $xSource="0";
    $ySource=($srcY/2)-($dim/2);
  }


  $imgSrc=imagecreatefromstring(file_get_contents($src)); 

  if (empty($imgSrc)){ 
      return false; 
  }

  //créer une image vide 
  $imgDest=@imagecreatetruecolor($largeur, $largeur); 
  
  //copie une partie de $imgSrc dans l'image vide $imgDest
  imagecopyresampled($imgDest, $imgSrc, 0, 0, $xSource, $ySource, $largeur , $largeur, $dim, $dim); 
  imagedestroy($imgSrc); 
  imagejpeg($imgDest, $dest, 100); 
  imagedestroy($imgDest); 
  return true;
}


function images_resize_galerie($image, $largeurMax, $hauteurMax){


  // Définition de la largeur et de la hauteur maximale
  $largeurMax = 1000;
  $hauteurMax = 700;


  // Cacul des nouvelles dimensions
  list($largeur_orig, $hauteur_orig) = getimagesize($image);


  $ratio_orig = $largeur_orig/$hauteur_orig;
  $ratio_max = $largeurMax/$hauteurMax;

  if ($ratio_max > $ratio_orig) {
     $largeurMax = $hauteurMax*$ratio_orig;
  } else {
     $hauteurMax = $largeurMax/$ratio_orig;
  }


  $imgSrc=imagecreatefromstring(file_get_contents($image)); 

  if (empty($imgSrc)){ 
    return false; 
  }

  //créer une image vide 
  $imgDest=@imagecreatetruecolor($largeurMax, $hauteurMax); 


  // Redimensionnement
  imagecopyresampled($imgDest, $imgSrc, 0, 0, 0, 0, $largeurMax, $hauteurMax, $largeur_orig, $hauteur_orig);
  imagedestroy($imgSrc); 
  imagejpeg($imgDest, $image, 100); 
  imagedestroy($imgDest); 
  return true;
}



?>