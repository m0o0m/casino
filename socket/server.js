var net = require('net');
var fs = require('fs');

var PORT = 1128;

var pingSend = false;




var afterPing = '';

var server = net.createServer(function (socket) {
    socket.setEncoding("utf8");
    socket.on('data', function(data) {        
        if(data == '<policy-file-request/>\0') {
            socket.write('<?xml version="1.0"?><cross-domain-policy><allow-access-from domain="*" to-ports="*" /></cross-domain-policy>' + '\0');
        }
        if(data.indexOf('jServer.gameManager.login') > 0) {
            var json = JSON.parse(data.substr(0, data.length - 1));
            
            fs.readFile('answer/login', 'utf8', function (err,data) {
                socket.write(data + '\0');
            });
        }
        if(data.indexOf('jServer.gameManager.ping') > 0) {
            var json = JSON.parse(data.substr(0, data.length - 1));
            fs.readFile('answer/ping', 'utf8', function (err,data) {
                var j = JSON.parse(data);
                j.messageId = json.messageId;
                j.sessionKey = json.sessionKey;
                data = JSON.stringify(j);
                socket.write(data + '\0');
                
                socket.write(afterPing + '\0');
            });            
        }
        if(data.indexOf('command":"settings') > 0) {
            var json = JSON.parse(data.substr(0, data.length - 1));
            var gameID = json.gameIdentificationNumber;
            socket.gameID = gameID;
            
            fs.readFile('answer/'+gameID+'/afterping', 'utf8', function (err,data) {
                afterPing = data;
            });
            
            fs.readFile('answer/'+gameID+'/settings', 'utf8', function (err,data) {
                var j = JSON.parse(data);
                j.messageId = json.messageId;
                j.sessionKey = json.sessionKey;
                data = JSON.stringify(j);
                socket.write(data + '\0');
            });
        }
        if(data.indexOf('command":"subscribe') > 0) {
            var json = JSON.parse(data.substr(0, data.length - 1));
            var gameID = json.gameIdentificationNumber;
            fs.readFile('answer/'+gameID+'/subscribe', 'utf8', function (err,data) {
                var j = JSON.parse(data);
                j.messageId = json.messageId;
                j.sessionKey = json.sessionKey;
                data = JSON.stringify(j);
                socket.write(data + '\0');
            });
        }
        if(data.indexOf('command":"bet') > 0) {
            var json = JSON.parse(data.substr(0, data.length - 1));
            var gameID = json.gameIdentificationNumber;
            if(json.bet.gameCommand == 'bet') {
                fs.readFile('answer/'+gameID+'/bet', 'utf8', function (err,data) {
                    var j = JSON.parse(data);
                    j.messageId = json.messageId;
                    j.sessionKey = json.sessionKey;
                    data = JSON.stringify(j);
                    socket.write(data + '\0');
                    
                    socket.write(afterPing + '\0');
                });
            }
            if(json.bet.gameCommand == 'collect') {
                var json = JSON.parse(data.substr(0, data.length - 1));
                var gameID = json.gameIdentificationNumber;
                fs.readFile('answer/'+gameID+'/collect', 'utf8', function (err,data) {
                    var j = JSON.parse(data);
                    j.messageId = json.messageId;
                    j.sessionKey = json.sessionKey;
                    data = JSON.stringify(j);
                    socket.write(data + '\0');
                    
                    socket.write(afterPing + '\0');
                });
            }
            
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
