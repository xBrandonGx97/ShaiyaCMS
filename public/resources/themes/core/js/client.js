var socket = io.connect('http://localhost:8080');

$('#messageForm').submit(function() {
  var nameVal = $('#nameInput').val();
  var msg = $('#messageInput').val();

  socket.emit('message', { name: nameVal, message: msg });

  // Ajax call for saving datas
  $.ajax({
    url: './ajax/insertNewMessage.php',
    type: 'POST',
    data: { name: nameVal, message: msg },
    success: function(data) {}
  });

  return false;
});

socket.on('message', function(data) {
  var actualContent = $('#messages').html();
  var newMsgContent =
    '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
  var content = newMsgContent + actualContent;

  $('#messages').html(content);
});

socket.emit('reg', '');

socket.on('reg', function(data) {
  console.log('we hella lit');
  $('#loggedIn1').append('test');
});

socket.on('logout', function(data) {
  console.log('logout xd');
});
