<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400' rel='stylesheet' type='text/css'>
  	<link type="text/css" rel="stylesheet" href="css/style3.css" />
    
    .<script type='text/javascript' src="js/jquery.min.js"></script>
    <title>Pickture</title>
  </head>
  	
  <body>
  	<?php
      include '../php/connection.php';
      $req_image           = mysql_query("SELECT * from monkeyfabase.galerie ORDER BY id_oeuvre DESC") or die(mysql_error());
    ?>

    <div class="panneau"></div>
    <div class="panneau2"></div>
    <!-- IMAGES GRAND FORMAT -->
    <img src="" class="img_full">
    <div class='cover'></div>

    <div class='verticAlign'>
    			
    <div id="slider">
        <div id="mask">
            
            <ul id="image_container">
                
                    
            
                <li>
                	<div id="un">
                      <div id="conteneur" align="center">
                            <table>
                                <tr><td >     
                                    <div class="hauteur">
                                      <?php
                                        for ($i=0; $i<3; $i++) {

                                              $miniature                        = mysql_result($req_image, $i, 'miniature');
                                              $nom                              = mysql_result($req_image, $i, 'nom');
                                              $description                      = mysql_result($req_image, $i, 'description');
                                              $image_full                       = mysql_result($req_image, $i, 'image_full');
                                              $id_auteur                        = mysql_result($req_image, $i, 'id_auteur');

                                              $req_nom_auteur                   = mysql_query("SELECT nom from monkeyfabase.users where id='$id_auteur'");
                                              $rep_nom_auteur                   = mysql_fetch_assoc($req_nom_auteur);
                                              $nom_auteur                       = $rep_nom_auteur["nom"];
                                              list($srcX, $srcY, $type, $attr)  = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);

                                              echo'<div class="tableau">
                                                <div class="lien_full">
                                                  <input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input><input type="hidden" value="'.$nom.'"></input><input type="hidden" value="'.$description.'"></input><input type="hidden" value="'.$nom_auteur.'"></input><img src="http://www.pickture.monkeyfactory.fr/Concours/'.$miniature.'" alt="'.$i.'">
                                                </div>
                                                <div class="descriptionTableau"><center>'.$nom.'</center></div>
                                              </div>';
                                            
                                          }
                                      ?>
                                    </div>	
                                </td></tr>
                            </table>
                       </div>     
               		 </div>
                </li>
        
                <li><div id="deux">
                    <div id="conteneur" align="center"> 
               
                                <div class="hauteur">
                                      <?php
                                       
                                        for ($i=3; $i<6; $i++) {

                                              $miniature                        = mysql_result($req_image, $i, 'miniature');
                                              $nom                              = mysql_result($req_image, $i, 'nom');
                                              $description                      = mysql_result($req_image, $i, 'description');
                                              $image_full                       = mysql_result($req_image, $i, 'image_full');
                                              $id_auteur                        = mysql_result($req_image, $i, 'id_auteur');

                                              $req_nom_auteur                   = mysql_query("SELECT nom from monkeyfabase.users where id='$id_auteur'");
                                              $rep_nom_auteur                   = mysql_fetch_assoc($req_nom_auteur);
                                              $nom_auteur                       = $rep_nom_auteur["nom"];
                                              list($srcX, $srcY, $type, $attr)  = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);

                                              echo'<div class="tableau">
                                                <div class="lien_full">
                                                  <input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input><input type="hidden" value="'.$nom.'"></input><input type="hidden" value="'.$description.'"></input><input type="hidden" value="'.$nom_auteur.'"></input><img src="http://www.pickture.monkeyfactory.fr/Concours/'.$miniature.'" alt="'.$i.'">
                                                </div>
                                                <div class="descriptionTableau"><center>'.$nom.'</center></div>
                                              </div>';
                                          }
                                          
                                      ?>                         
                                </div>
                    </div>	
                </div></li>

        
                <li><div id="trois">
                    <div id="conteneur" align="center"> 
                        <div class="hauteur">
                                      <?php
                                       
                                        for ($i=6; $i<9; $i++) {

                                              $miniature                        = mysql_result($req_image, $i, 'miniature');
                                              $nom                              = mysql_result($req_image, $i, 'nom');
                                              $description                      = mysql_result($req_image, $i, 'description');
                                              $image_full                       = mysql_result($req_image, $i, 'image_full');
                                              $id_auteur                        = mysql_result($req_image, $i, 'id_auteur');

                                              $req_nom_auteur                   = mysql_query("SELECT nom from monkeyfabase.users where id='$id_auteur'");
                                              $rep_nom_auteur                   = mysql_fetch_assoc($req_nom_auteur);
                                              $nom_auteur                       = $rep_nom_auteur["nom"];
                                              list($srcX, $srcY, $type, $attr)  = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);

                                              echo'<div class="tableau">
                                                <div class="lien_full">
                                                  <input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input><input type="hidden" value="'.$nom.'"></input><input type="hidden" value="'.$description.'"></input><input type="hidden" value="'.$nom_auteur.'"></input><img src="http://www.pickture.monkeyfactory.fr/Concours/'.$miniature.'" alt="'.$i.'">
                                                </div>
                                                <div class="descriptionTableau"><center>'.$nom.'</center></div>
                                              </div>';
                                          }
                                          
                                      ?>
                        </div>	
                    </div>
                </div></li>
        
        
                <li><div id="quatre">
                    <div id="conteneur" align="center"> 
                    	<div class="hauteur">
                                      <?php
                                       
                                        for ($i=9; $i<12; $i++) {

                                              $miniature                        = mysql_result($req_image, $i, 'miniature');
                                              $nom                              = mysql_result($req_image, $i, 'nom');
                                              $description                      = mysql_result($req_image, $i, 'description');
                                              $image_full                       = mysql_result($req_image, $i, 'image_full');
                                              $id_auteur                        = mysql_result($req_image, $i, 'id_auteur');

                                              $req_nom_auteur                   = mysql_query("SELECT nom from monkeyfabase.users where id='$id_auteur'");
                                              $rep_nom_auteur                   = mysql_fetch_assoc($req_nom_auteur);
                                              $nom_auteur                       = $rep_nom_auteur["nom"];
                                              list($srcX, $srcY, $type, $attr)  = getimagesize("http://www.pickture.monkeyfactory.fr/Concours/".$image_full);

                                              echo'<div class="tableau">
                                                <div class="lien_full">
                                                  <input type="hidden" value="'.$image_full.'"></input><input type="hidden" value="'.$srcX.'"></input><input type="hidden" value="'.$srcY.'"></input><input type="hidden" value="'.$nom.'"></input><input type="hidden" value="'.$description.'"></input><input type="hidden" value="'.$nom_auteur.'"></input><img src="http://www.pickture.monkeyfactory.fr/Concours/'.$miniature.'" alt="'.$i.'">
                                                </div>
                                                <div class="descriptionTableau"><center>'.$nom.'</center></div>
                                              </div>';
                                          }
                                          
                                      ?>
                        </div>      
                    </div>
                    
                </div></li>
           
            </ul>
            
        </div> <!--fin div mask -->
    </div>

          <ul id="dots">
              <li class="button1" onClick="changeImage(1)" ></li>
              <li class="button2" onClick="changeImage(2)" ></li>
              <li class="button3" onClick="changeImage(3)" ></li>
              <li class="button4" onClick="changeImage(4)" ></li>
          </ul>
          <img src="images/icones/arrowG.png" id="fleche_gauche" class="fleche" onClick="prevImage()" alt="">
          <img src="images/icones/arrowD.png" id="fleche_droite" class="fleche" onClick="nextImage()" alt="">
          
    </div>

    <script type="text/javascript">

      cover = document.querySelector( '.cover' );

              // annuler le pop-up avec la touche echappe
              function escape( event ) {
                if( event.keyCode === 27 ) {
                  $('.img_full').removeClass('img_active');
                  $('.cover').removeClass('active');
                  $('.panneau').removeClass('panneau_active');
                  $('.panneau2').removeClass('panneau_active2');
                  document.addEventListener( 'keyup', escape, false );
                  document.addEventListener( 'click', clickout, false );
                }
              };

              // annuler le pop-up en cliquant en dehors de l'image
              function clickout( event ) {
                if( event.target === cover ) {
                  $('.img_full').removeClass('img_active');
                  $('.cover').removeClass('active');
                  $('.panneau').removeClass('panneau_active');
                  $('.panneau2').removeClass('panneau_active2');
                  document.addEventListener( 'keyup', escape, false );
                  document.addEventListener( 'click', clickout, false );
                }
              };


              /*//////////////////////////////////////////////////////
              //////////////////// POP-UP IMAGE //////////////////////
              //////////////////////////////////////////////////////*/

              $('.lien_full').click( function(e) {
                console.log(e);
                var _path_full        = null;
                var _id               = null;
                var _width            = null;
                var _height           = null;
                var _nom              = null;
                var _description      = null;

                // on récupère les dimensions de l'image et son chemin
                _path_full            = e.target.parentNode.childNodes[1].value.toString();
                _width                = e.target.parentNode.childNodes[2].value.toString();
                _height               = e.target.parentNode.childNodes[3].value.toString();
                _nom                  = e.target.parentNode.childNodes[4].value.toString();
                _description          = e.target.parentNode.childNodes[5].value.toString();
                _nom_auteur           = e.target.parentNode.childNodes[6].value.toString();

                $(".panneau").html("<div class='info'><div id='nom'><p>Nom :</p><p>"+_nom+"</p></div><div id='auteur'><br><p>Artiste :</p><p>"+_nom_auteur+"</p></div></div>");

                $(".panneau2").html("<div class='info'><div id='description'><p>Description :</p><p>"+_description+"</p></div></div>");


                _id = 'http://www.pickture.monkeyfactory.fr/Concours/'+_path_full;

                //on donne l'attribut correspondant à la minitature sur laquelle on a cliqué
                $('.img_full').attr('src',_id);
                console.log($('.img_full').attr('src'));
                // on gère l'affichage centré
                $('.img_full').css({'margin-left': -_width/2, 'margin-top': -_height/2});
              
                // on ajoute des classes pour afficher l'image et mettre une opacité sur le reste de la page
                  $('.img_full').addClass('img_active');
                  $('.cover').addClass('active');
                  $('.panneau').addClass('panneau_active');
                  $('.panneau2').addClass('panneau_active2');

                document.addEventListener( 'keyup', escape, false );
                document.addEventListener( 'click', clickout, false );
                
              });
    	
          function touche(Event) 
            { 
            resCode = Event.keyCode;  

            switch (resCode) 
            { 
              case 37: prevImage(); 
              break;  

              case 39: nextImage(); 
              break; 

              default: return; 
            } 
          } 

          var image = 1;
          var maxImages = 5;
          var slider = document.getElementById('slider');
          
          function changeImage(imageDemande) {
            if (!imageDemande && imageDemande != 0){
              if(image < maxImages){
                image++;
              }
              else{
                image = 1;
              }
            }
            else{
              if(imageDemande > maxImages){
                image = 1;
              }
              else if(imageDemande < 1){
                image = maxImages;
              }
              else{
                image = imageDemande;
              }
            }

            slider.className = "image"+image;
          }
          
          function nextImage(){
            changeImage(image+1);
          }
          function prevImage(){
            changeImage(image-1);
          }
          
          changeImage(1);
    </script>
  </body>
</html>
