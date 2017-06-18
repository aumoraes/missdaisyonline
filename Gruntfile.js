module.exports = function(grunt) {

	grunt.initConfig({
	sass: {
		dist: {
				options: {                       // Target options
						style: 'compressed',
				},
				files: {
					'style.css': '_/sass/main.scss'
				}
		}
	},
	uglify: {
		dist: {
			options: {
				beautify: false
			},
			files: {
				'assets/js/main.min.js': ['_/js/*.js']
			}
		}
	},
	watch: {
			scripts : {
				files: '_/js/*.js',
				tasks: ['uglify']
			},
			css : {
				files: '_/sass/**/*.scss',
				tasks: ['sass'],
        options: {
        spawn: false
       }
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default', ['sass:dist', 'watch']);
};
