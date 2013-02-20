var http = require("http");
var url = require("url");

function start(route, handle){
	http.createServer(function(request, response){
		var pathname = url.parse(request.url).pathname;
		console.log('request for ' + pathname + ' received.');
		
		response.writeHead(200, {"Content-Type": "text/plain"});
		var content = route(handle, pathname);
		response.write(pathname);
		response.end();
	}).listen(8080);

	console.log('server has started.');
}

exports.start = start;