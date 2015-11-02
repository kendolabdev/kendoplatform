module.exports = function (grunt) {
    'use strict';
    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: 'js/.jshintrc'
            },
            src: ['Gruntfile.js', 'app/module/**/*.js']
        },
        requirejs: {
            core: {
                options: {
                    baseUrl: "./jscript",
                    name: "jsmain",
                    out: "./jscript/dist/core.bundle.js",
                    paths: {
                        base: "./base",
                        primary: './primary',
                    },
                    //optimize: "none",
                    //mainConfigFile: "./jscript/main.js"
                }
            }
        }
    });

    // grunt.loadNpmTasks('grunt-contrib-jshint');
    //grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-requirejs');

    // grunt.registerTask('build', ['jshint', 'requirejs']);
    grunt.registerTask('build', ['requirejs:core']);
};
