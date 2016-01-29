module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    compass: {
      dist: {
        options: {
          sassDir: 'stylesheets',
          cssDir: 'webroot/css'
        }
      }
    },
    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['compass']
      }
    }
  });

  // Load the compass task
  grunt.loadNpmTasks('grunt-contrib-compass');

  // Load grunt watch
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default Tasks
  grunt.registerTask('default', ['compass']);

  // Watch Tasks
  // grunt.registerTask('watch', ['watch']);

};
