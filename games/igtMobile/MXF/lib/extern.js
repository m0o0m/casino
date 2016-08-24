
var com = com || {};
com.igt = com.igt || {};

com.igt.extern = function(namespace){
	'use strict';
	var o,n,lastname,names;
	
	namespace = (namespace || '').split('.');
	lastname = namespace.pop();

	for(o=this;n=namespace.shift();o=o[n]){
		o[n]=o[n] || {};
	}
	if(o[lastname]){
		console.warn(namespace + ' is already declared');
	}
	o[lastname]=void 0;
}
