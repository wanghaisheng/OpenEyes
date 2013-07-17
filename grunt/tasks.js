module.exports = function (grunt) {

  /* Load the viewdocs task */
  require('./tasks/viewdocs')(grunt);  
  require('./tasks/bower')(grunt);  

  /* Generates the documentation. */
  grunt.registerTask('docs', 
    ['clean:docs', 'styleguide:dist']
  );

  /* Checks code for syntax errors. */
  grunt.registerTask('lint', 
    ['jshint']
  );

  /* The development build task. */
  grunt.registerTask('build', 
    ['bower','lint','compass:newstyle']
  );

  /* The default task for running `grunt`. */
  grunt.registerTask('default', 
    ['build']
  );
};