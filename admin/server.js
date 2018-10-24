var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql = require('mysql');


var con = mysql.createConnection({
  host: "localhost",
  user: "green_team",
  password: "makebank",
  database: "greenrider"
});

function refreshOrders(callback){
  var sql = "SELECT o.id, o.delivery_address, o.status, o.datetime, m.firstname, m.lastname\
    FROM orders o INNER JOIN users m ON (o.customer_id=m.id)";
  
  con.query(sql, function (err, result) {
    if (err) throw err;
    result = JSON.stringify(result);
    callback(result);
  });
}

io.on('connection', function(socket){
  console.log('a user connected');

  socket.on('getOrderData', function(){
    refreshOrders(function(data){
      socket.emit('orderData', data);
    });
  });

	socket.on('disconnect', function(){
		console.log('user disconnected');
	});
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});