module.exports = (grunt) =>
	grunt.initConfig
		pkg: grunt.file.readJSON 'package.json'

		## Compile coffeescript
		coffee:
			compile:
				files: [
					expand: true
					cwd: 'src'
					src: ['EventEmitter.coffee']
					dest: 'dist'
					ext: '.js'
				]

		
	grunt.loadNpmTasks 'grunt-contrib-coffee'
	
	grunt.registerTask 'default', ['coffee']
	grunt.registerTask 'travis', ['default']
