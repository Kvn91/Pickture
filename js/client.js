$(function(){

	if(!('getContext' in document.createElement('canvas'))){
		alert('Votre navigateur ne supporte pas le canvas, désoler!');
		return false;
	}

	var url = 'http://localhost:1337';

	// Id unique
	var id = Math.round($.now()*Math.random());
	var drawing = false;
	var username = $('#id_user').val();

	var clients = {};
	var cursors = {};

	var socket = io.connect(url);

	// Connexion 
	socket.emit('login', {
		'username' : username,
		'id' : id
	});
	
	// Nouvel utilisateur
	socket.on('newusr', function(user) {
		$('#liste_user').append("<li id="+user+">"+user+"</li>");
	});

	socket.on('ancien', function(trace_user){
		for (var i = 0; i < trace_user.length; i++) {
			if (trace_user[i].drawing) {
				drawLine(trace_user[i].x, trace_user[i].y, trace_user[i+1].x, trace_user[i+1].y, trace_user[i].size, trace_user[i].color);
			}else{
				i = i + 1;
			};
		};
	});

	socket.on('time', function(secondes, minutes, heures, jours){
		console.log(jours, heures, minutes, secondes);
		$('#span_jours').text(jours);
		$('#span_heures').text(heures);
		$('#span_minutes').text(minutes);
		$('#span_secondes').text(secondes);
	})	

	// Utilisateurs en moins
	socket.on('disusr', function(user) {
		$('li').attr('id', user).remove();
	});
	



	/*
	*	-------------------------------------------------------- FONCTIONS POUR DESSINER
	*/


	var _souris		= new Object({'x':0, 'y':0});

	/*
	** CHOIX COULEUR
	*/

	var canvas_couleur = $('#canvas_couleur'),
	canvas_couleur_CTX = canvas_couleur[0].getContext('2d');
	var img = new Image();
	img.src = 'img/couleur.png';

	img.onload = function(){
		canvas_couleur_CTX.drawImage(img, 0, 0, 200, 200);
	}

	var _image_data = null;

	canvas_couleur.mouseup( function(evt) {
		_canvas_pos = canvas_couleur.offset();
		_souris.x = evt.pageX - _canvas_pos.left;
		_souris.y = evt.pageY - _canvas_pos.top;
		_image_data = canvas_couleur_CTX.getImageData(_souris.x, _souris.y, 1, 1).data;
	});

	var doc = $(document),
		win = $(window),
		_canvas = $('#canvas'),
		ctx = _canvas[0].getContext('2d'),
		marge = $('#canvas_holder').offset(),
		curSize = 5;

	$('#fin').click(function(){
		curSize = 2;
	});

	$('#moyen').click(function(){
		curSize = 6;
	});

	$('#epais').click(function(){
		curSize = 10;
	});

	socket.on('moving', function (data, trace) {
		
		if(! (data.id in clients)){
			// Creer un curseur pour chaque utilisateur
			cursors[data.id] = $('<div class="cursor">').appendTo('#cursors');
		}
		
		//Bouge le cursor au pointer
		cursors[data.id].css({
			'left' : data.x,
			'top' : data.y
		});
		
		// Est ce que le mec dessine ?
		if(data.drawing && clients[data.id]){
			drawLine(clients[data.id].x, clients[data.id].y, data.x, data.y, clients[data.id].size, data.color);

		}
		
		// Enregistre l'etat actuel
		clients[data.id] = data;
		clients[data.id].updated = $.now();
	});

	var prev = {};
	
	_canvas.mousedown(function(e){
		e.preventDefault();
		drawing = true;
		prev.x = e.pageX - marge.left;
		prev.y = e.pageY - marge.top;
	});

	_canvas.mousemove(function(e){
		if($.now() - lastEmit > 30){
			socket.emit('mousemove',{
				'x': e.pageX - marge.left,
				'y': e.pageY - marge.top,
				'drawing': drawing,
				'id': id,
				'username': username,
				'size': curSize,
				'color' : _image_data
			});
			lastEmit = $.now();
		}
		
		
		if(drawing){
			drawLine(prev.x, prev.y, e.pageX - marge.left, e.pageY - marge.top, curSize, _image_data);
			prev.x = e.pageX - marge.left;
			prev.y = e.pageY - marge.top;
		}
	});
	
	doc.mouseup(function(){
		drawing = false;
		socket.emit('stop', id);
	});

	_canvas.mouseleave(function(){
		drawing = false;
		socket.emit('stop', id);
	});

	var lastEmit = $.now();

	function drawLine(fromx, fromy, tox, toy, size, color){
		ctx.beginPath();
		ctx.moveTo(fromx, fromy);
		ctx.lineTo(tox, toy);
		if (!color) {
			ctx.strokeStyle = "rgba(0,0,0,1)";
		}else{
			ctx.strokeStyle = "rgba("+color[0]+","+color[1]+","+color[2]+",1)";
		};
  		ctx.fillStyle = "solid";
    	ctx.lineCap = "round";
    	ctx.lineWidth = size;
		ctx.stroke();
		ctx.closePath();
	}
});