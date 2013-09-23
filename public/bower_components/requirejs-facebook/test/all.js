'use strict';

var grunt = require('grunt');
var path = require('path');
var fs = require('fs');
var coffee = require('coffee-script');

exports["test some stuff"] = function(test){
    test.expect(1);
    test.ok(true, "this assertion should pass");
    test.done();
};

exports["Test compiled against source"] = function(test){
	test.expect(1);

	// Get the JS commited in the project
	var commited = grunt.file.read('dist/Facebook.js');

	var src = grunt.file.read('src/Facebook.coffee');
	var compiled = coffee.compile(src);

	test.equal(commited, compiled, "Compiled Javascipt up to date with CoffeeScript source");

	test.done();
};