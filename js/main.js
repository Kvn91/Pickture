$(document).ready( function() {
	console.log('Vous êtes curieux ? Alors venez travailler chez nous ! contact@monkeyfactory.fr ');
	
	/*
	** RESIZE DE LA PAGE
	*/
	var _hauteur = $('#canvas_holder').height() + $('#en_tete').height() + 50;
	console.log(_hauteur);
	var _hauteur_page = $(window).height();

	if (_hauteur < _hauteur_page - 30) {
		$('#moove').height(_hauteur_page);
		$('#milieu').height(_hauteur_page);
	}else{
		$('#moove').height(_hauteur + 110);
		$('#milieu').height(_hauteur + 110);
	};

	$(window).resize( function() {
		_hauteur = $('#canvas_holder').height() + $('#en_tete').height();
		_hauteur_page = $(window).height();

		if (_hauteur < _hauteur_page - 30) {
			$('#moove').height(_hauteur_page);
			$('#milieu').height(_hauteur_page);
		}else{
			$('#moove').height(_hauteur + 110);
			$('#milieu').height(_hauteur + 110);
		};
	});


	/*
	** OUVERTURE DU MENU OUTIL
	*/
	var bouton = $('#ouverture_bas'),
		croix  = $('#ouverture_bas span'),
		div    = $('#bas'), 
		fermer = true;

	bouton.mouseup(function() {
		if (fermer) {
			div.animate({
				bottom: '0px'
			}, 300);
			fermer = false;
		}else{
			div.animate({
				bottom: '-210px'
			}, 200);
			fermer = true;
		}
	});
});