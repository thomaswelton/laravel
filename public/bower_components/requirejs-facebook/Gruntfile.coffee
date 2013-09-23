module.exports = (grunt) =>
	grunt.initConfig
		pkg: grunt.file.readJSON 'package.json'

		bower:
			install:
				options:
					targetDir: 'demo/components'


		## Compile coffeescript
		coffee:
			compile:
				files: [
					{
						expand: true
						cwd: 'src'
						src: ['*.coffee']
						dest: 'demo'
						ext: '.js'
					},
					{
						expand: true
						cwd: 'src'
						src: ['Facebook.coffee']
						dest: 'dist'
						ext: '.js'
					}
				]

		watch:
			coffee:
				files: ['src/**/*.coffee']
				tasks: ['coffee','default']

		connect:
			server:
				options:
					keepalive: true
					port: 9001
					base: 'demo'

		nodeunit:
			all: ['test/all.js']

		exec:
			server:
				command: 'grunt connect &'

			open:
				command: 'open http://localhost:9001/'

		
	grunt.loadNpmTasks 'grunt-contrib-coffee'
	grunt.loadNpmTasks 'grunt-contrib-watch'
	grunt.loadNpmTasks 'grunt-contrib-connect'
	grunt.loadNpmTasks 'grunt-exec'
	grunt.loadNpmTasks 'grunt-bower-task'
	grunt.loadNpmTasks 'grunt-contrib-nodeunit'
	
	grunt.registerTask 'default', ['bower' ,'compile']
	grunt.registerTask 'server', ['exec:server', 'exec:open', 'watch']
	
	grunt.registerTask 'heroku', 'Heroku build tasks', [ 'default' ]

	grunt.registerTask 'tests', 'Travis tests', ['nodeunit']
	
	grunt.registerTask 'compile', 'Compile coffeescript', ['coffee']
