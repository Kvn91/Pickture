// Varialble globale pour tous 
var http = require('http');

httpServer = http.createServer( function(req, res){
	console.log('Un utilisateur c"est connecter');
});

httpServer.listen(1337);

var io = require('socket.io').listen(httpServer);
var users = {};

io.sockets.on('connection', function(socket){
	// Propre à chaque utilisateurs

	var me = false;
	console.log('new user');

	for(var k in users){
		socket.emit('newusr', users[k]);
	}

	socket.on('login', function(user){
		me = user;
		me.id = user.username;
		users[me.id] = me.id;
		socket.broadcast.emit('newusr', me.id);
	})

	socket.on('drawClick', function(data) {
      socket.broadcast.emit('draw', {
        x: data.x,
        y: data.y,
        type: data.type
      });
    });

	socket.on('disconnect', function(){
		if(!me){
			return false;
		}
		delete users[me.id];
		io.sockets.emit('disusr', me);
	})
})