var http = require('http');
var fs = require('fs');
var files = fs.readdirSync('.');

http.createServer(function (req, res) {
  res.writeHead(200, { 'content-type': 'text/html' });
  fs.createReadStream('form.html').pipe(res);
}).listen(8000);

