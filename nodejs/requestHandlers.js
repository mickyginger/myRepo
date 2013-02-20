function start(){
	console.log("Request handler 'start' was called.");
	return "This is the start page...";
}

function upload(){
	console.log("Request handler 'upload' was called.");
	return "This is the uplaod page...";
}

exports.start = start;
exports.upload = upload;