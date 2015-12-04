var net = require('net');
var fs = require('fs');
var http = require('http');

var PORT = 1128;

var pingSend = false;




var afterPing = '';

var server = net.createServer(function (socket) {
    socket.setEncoding("utf8");
    socket.on('data', function(data) {        
        if(data == '<policy-file-request/>\0') {
            socket.write('<?xml version="1.0"?><cross-domain-policy><allow-access-from domain="*" to-ports="*" /></cross-domain-policy>' + '\0');
        }
        else {
            var json = JSON.parse(data.substr(0, data.length - 1));
            var tmp = json.sessionKey.split('|||');
            if(json.command != 'ping') {
                console.log('===================REQUEST===================');
                console.log(json); 
            }    
                  
            var options = {
                host: 'localhost',
                path: '/core/WebEngine.php?sessionID='+tmp[2]+'&game=' + tmp[0] + '|||' + tmp[1] + '&json='+JSON.stringify(json),
            };
            
            var request = http.request(options, function(response) {
                var body = '';
                response.on('data', function(d) {
                    body += d;
                });
                response.on('end', function() {
                    if(json.command != 'ping') {
                        console.log('===================RESPONSE===================');
                        console.log(body);
                    }
                    socket.write(body + '\0');
                });
            });
            request.end();
        }   
     });
 
     socket.on("error", function (exception) {
        console.log('Exception: ' + exception);
        socket.end();
     });
 
     socket.on("timeout", function () {
        console.log('timeout');
        socket.end();
     });
 
     socket.on("close", function (had_error) {
        console.log('socket close');
        socket.end();
     });
});
server.listen(PORT);
