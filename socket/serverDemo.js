var net = require('net'),
    fs = require('fs'),
    http = require('http'),
    PORT = 1128;

var server = net.createServer(function (socket) {
    socket.setEncoding("utf8");
    socket.on('data', function(data) {       
        if(data == '<policy-file-request/>\0') {
            socket.write('<?xml version="1.0"?><cross-domain-policy><allow-access-from domain="*" to-ports="*" /></cross-domain-policy>' + '\0');
        }
        else {
            var json = JSON.parse(data.substr(0, data.length - 1));
                      
            var options = {
                host: json.sessionKey,
                path: '/skvCore/WebEngine.php?json='+JSON.stringify(json)
            };
           
            var request = http.request(options, function(response) {
                var body = '';
                response.on('data', function(d) {
                    body += d;
                });
                response.on('end', function() {
                    socket.write(body + '\0');
                });
                response.on('error', function(e) {
                });
            });
            request.on('error', function(e) {
            });
            request.end();
        }   
     });
 
     socket.on("error", function (exception) {
        socket.end();
     });
 
     socket.on("timeout", function () {
        socket.end();
     });
 
     socket.on("close", function (had_error) {
        socket.end();
     });
});
server.listen(PORT);
