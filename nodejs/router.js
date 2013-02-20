function route(handle, pathname){
	console.log('about to route a request for ' + pathname);
	if(typeof handle[pathname] === 'function'){
		handle[pathname]();
	} else {
		console.log("No request handler found for " + pathname);
		return "404 Not found";
	}
}

exports.route = route;