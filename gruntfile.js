module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		watch: {
			styles: {
				files: ['resources/assets/sass/*.sass', 'resources/assets/sass/**/*.sass', 'resources/assets/sass/modules/*.sass'],
				tasks: ['sass']
			}
		},

		sass: {
			dev: {
				files: {
					'public/assets/css/main.css': 'resources/assets/sass/main.sass'
				}
			}
		},

		// Convert node-style requires in React to to browser-compatible JS.
		// Requires that JS be run through babel transform first.
		browserify: {
			options: {
				transform: [
					[
						'babelify', {
							'presets': ['react', 'es2015']
						}
					]
				],
				watch: true,
				keepAlive: true,
				watchifyOptions: {
					'ignore-watch': 'node_modules/**'
				}
			},
			dev: {
				files: {
					'public/assets/js/bundle.js': 'resources/assets/js/main.js'
				}
			}
		}
	});


	// load all NPM tasks http://chrisawren.com/posts/Advanced-Grunt-tooling
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.registerTask('default', ['watch']);

};