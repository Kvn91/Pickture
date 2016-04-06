(function($){

	var socket = io.connect('http://localhost:1337');
	var clic = false;
	var canvas_ctx = canvas.getContext("2d");

	socket.emit('login', {
		username : $('#id_user').val()
	});

	$('#canvas').mousedown(function(){
		clic = true;
	});

	$('#canvas').mousemove(function(){
		if (clic) {
			socket.emit('dessin', canvas_ctx);
		};
	});

	$(document).mouseup(function(){
		clic = false;
	})

	socket.on('newusr', function(user) {
		alert(user+' vient de se connecter !');
	});

	socket.on('newctx', function(ctx){
		canvas.getContext("2d") = ctx;
	});

	// socket.on('disusr', function(user){

	// })
})(jQuery);