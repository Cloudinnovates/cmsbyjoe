module.exports = function(grunt){

	require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		jshint: {
			all: ['Gruntfile.js', 'assets/js/*.js']
		},
		
		less: {
			development: {
				options: {
					paths: ["./assets/css"]
				},
				files: {
					//"./assets/css/styles.css" : "./assets/less/styles.less",
					"./application/assets/css/admin.css" : "./application/assets/less/admin.less"
				}
			}
		},
		
		cssmin: {
			sitecss: {  
				files: {
					'assets/css/styles.min.css': ['assets/css/styles.css']
				}
			}
		},

		watch: {
			less: {
				files: ['assets/less/*.less', 'application/assets/less/*.less'],
				tasks: ['buildCSS']
			}
		}
		
	});
	
	grunt.registerTask('default', []);
	grunt.registerTask('buildAll',  ['uglify', 'less', 'cssmin', 'imagemin']);
	grunt.registerTask('buildJS', ['jshint','uglify']);
	grunt.registerTask('buildCSS',  ['less', 'cssmin']);
	
};



