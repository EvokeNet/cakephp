<script src="/socket.io/socket.io.js"></script>
<script>

	var socket = io('http://localhost');
  
	socket.emit('notification_from_server', { hey: 'it works' });

	alert('YAY');

	// var app = require('http').createServer(handler)
	// var io = require('socket.io').listen(app);
	// var fs = require('fs');

	// app.listen(4000);

	// function handler (req, res) {
	//   fs.readFile('index.html',
	//   function (err, data) {
	//     if (err) {
	//       res.writeHead(500);
	//       return res.end('Error loading index.html');
	//     }

	//     res.writeHead(200);
	//     res.end(data);
	//   });
	// }

	// io.on('connection', function (socket) {
	//   socket.emit('notification_from_server', { hello: 'world' });
	// });

</script>