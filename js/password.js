$(document).ready( function() {
	// Récupération du champs password
	var html_password = $('#password');
	var html_info_mdp = $('#info_mdp');


	// Définition des caractères accéptés
	var strg_min = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']; // 26
	//var strg_min_spe = ['â', 'ä', 'ã', 'à', 'ç', 'ê', 'ë', 'é', 'è', 'ì', 'î', 'ï', 'ñ', 'ô', 'ö', 'õ', 'ò', 'ù', 'û', 'ü', 'ÿ']; // 21
	var strg_maj = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']; // 26
	//var strg_maj_spe = ['À', 'Â', 'Ä', 'Ã', 'È', 'Ê', 'Ë', 'Ì', 'Î', 'Ï', 'Ñ', 'Ò', 'Ô', 'Ö', 'Õ', 'Ù', 'Û', 'Ü',]; // 18
	var strg_num = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
	var min, min_spe, maj, maj_spe, num = false;
	var cur_min, cur_maj, cur_num = false;

	// Vitesse de calcul 3GHz
	var calc_par_sec = 3000000000;

	// Spéc
	var combinaison = 0;
	var combinaison_poss = 0;
	var temps_calc = 0;
	var type_renvoi;



	// Au key up 
	html_password.keyup(function() {
		var password = html_password.val();
		time_pass(password);
		if (type_renvoi == "secondes" || type_renvoi == "minutes") {
			html_info_mdp.attr('class', 'non_libre');
		}else{
			html_info_mdp.attr('class', 'libre');
		};
		html_info_mdp.text("Temps de crack :"+temps_calc+" "+type_renvoi);
	});



	function time_pass(password) {
		// Split du password en tableau
		var sub_password = password.split('');

		// Si le tableau contient qqlch
		if (sub_password.length > 0) {
			min = false;
			maj = false; 
			num = false;
			type_renvoi = "secondes";

			// On le parcours
			for (var i = 0; i < sub_password.length; i++) {
				var current_letter = sub_password[i];

				for (var j = 0; j < strg_min.length; j++) {
					if (current_letter == strg_min[j]) {
						min = true;
					}
				};

				// boucles des caractères accentuer
				// for (var m = 0; m < strg_min_spe.length; m++) {
				// 	if (current_letter == strg_min_spe[m]) {
				// 		min_spe = true;
				// 	}
				// };

				// for (var n = 0; n < strg_maj_spe.length; n++) {
				// 	if (current_letter == strg_maj_spe[n]) {
				// 		maj_spe = true;
				// 	}
				// };

				for (var k = 0; k < strg_maj.length; k++) {
					if (current_letter == strg_maj[k]) {
						maj = true;
					}
				};

				for (var l = 0; l < strg_num.length; l++) {
					if (current_letter == strg_num[l]) {
						num = true;
					}
				};

				// Test des différents caractère présent dans password
				if (min && !maj && !num) {
					combinaison = 26;
				}else if(!min && maj && !num){
					combinaison = 26;
				}else if(!min && !maj && num){
					combinaison = 10;
				}else if(min && maj && !num){
					combinaison = 52;
				}else if(min && !maj && num){
					combinaison = 36;
				}else if(!min && maj && num){
					combinaison = 36;
				}else if(min && maj && num){
					combinaison = 62;
				};
			};

			// Calcul
			// Combinaison ^ longueur = combinaison possible
			// combinaison possible / calc par sec = temps final

			combinaison_poss = Math.pow(combinaison, password.length);
			temps_calc = combinaison_poss / calc_par_sec;

			// Traitement du résultat
			if (temps_calc > 60) {
				temps_calc = temps_calc / 60;
				type_renvoi = "minutes";
				temps_calc = Math.round(temps_calc);

				if (temps_calc > 60) {
					temps_calc = temps_calc / 60;
					type_renvoi = "heures";
					temps_calc = Math.round(temps_calc);

					if (temps_calc > 24) {
						temps_calc = temps_calc / 24;
						type_renvoi = "jours";
						temps_calc = Math.round(temps_calc);

						if (temps_calc > 30) {
							temps_calc = temps_calc / 30;
							type_renvoi = "mois";
							temps_calc = Math.round(temps_calc);

							if (temps_calc > 12) {
								temps_calc = temps_calc / 12;
								type_renvoi = "année(s)";
								temps_calc = Math.round(temps_calc);
							};
						};
					};
				};
			};

		}else{
			combinaison = 0;
			temps_calc = 0;
			type_renvoi = "secondes";
		};
	}
	
});

