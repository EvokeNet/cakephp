var socket = io('http://localhost');
  
socket.emit('notification_from_server', { hey: 'it works' });

alert('YAY');