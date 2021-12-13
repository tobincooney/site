var http = require('http');
var fs = require('fs');
var files = fs.readdirSync('.');

http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  res.end(String(files));
}).listen(8080);

