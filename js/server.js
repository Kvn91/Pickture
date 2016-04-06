// Variable globale pour tous 
var http = require('http');

httpServer = http.createServer( function(req, res){
	console.log('Un utilisateur c"est connecter');
});

httpServer.listen(1337);

var io = require('socket.io').listen(httpServer);
var users = {};
var trace = new Array();

var jours = 0;
var heures = 0;
var minutes = 0;
var secondes = 10;
var fin_time = false;

	/*
	** TIMER
	*/
	var Time = setInterval(function() {
    	secondes -= 1;

    	if (secondes < 0) {
    		secondes = 59;
    		minutes -= 1;
    	};

    	if (minutes < 0) {
   			minutes = 59;
   			heures -= 1;
    	};

    	if (heures < 0) {
    		heures = 23;
    		jours -= 1;
		};

		if (secondes <= 0 && minutes <= 0 && heures <= 0 && jours <= 0) {
			clearInterval(Time);
			fin_time = true;
		};

	}, 1000);

io.sockets.on('connection', function(socket){
	// Propre à chaque utilisateurs
	var me = false;

	// On envoie tout les utilisateurs présent dans users (actuel)
	for(var k in users){
		socket.emit('newusr', users[k]);
	}

	socket.on('login', function(user){
		// users --> annuaire des personne présente id:username
		me = user;
		users[me.id] = me.username;

		// Si l'utilisateurs n'a pas déjà une trace sur le mur alors on lui en crée une
		if (!trace[me.username]) {
			trace[me.username] = new Array();
		};

		// On dit a tous le monde qu'il y a un newusr
		socket.broadcast.emit('newusr', users[me.id]);

		// Si une trace éxiste, alors on la transmet a l'user qu vient d'arriver
		for(var l in trace){
			if (l) {
			socket.emit('ancien', trace[l]);
			};
		}
	})

	socket.on('mousemove', function (data) {
		
		// Transmission des données d'un user qui desssine
		socket.broadcast.emit('moving', data);

		// On stocke la trace de l'user dans sa partie
		trace[data.username].push(data);
	});


	socket.on('disconnect', function(){
		// Test si je suis bien là
		if(!me){
			return false;
		}

		// Supprime des users courant et le dis à tous le monde
		delete users[me.id];
		io.sockets.emit('disusr', me);
	})

	var Time_2 = setInterval(function() {
		io.sockets.emit('time', secondes, minutes, heures, jours);

		if (fin_time) {
			clearInterval(Time_2);
		};
	}, 1000);
})	