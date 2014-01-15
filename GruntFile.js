module.exports = function (grunt) {

    // This initializes the configuration object
    grunt.initConfig({

        // Read in project settings from package file
        pkg: grunt.file.readJSON('package.json'),

        // User editable project settings & variables
        options: {
            // Base path to your assets folder
            base: 'app/assets',

            // Theme Base
            themebase: 'public/themes/default',

            // Published assets path
            publish: 'public/build',


            // CSS settings
            css: {
                // base path to the CSS folder
                base: 'app/assets/css',


                // CSS files in order you'd like them concatenated and minified
                files_site: [
                '<%= options.base %>/builds/css/frontend/less.css',
                '<%= options.base %>/builds/css/frontend/scss.css',
                '<%= options.css.base %>/frontend/*.css',
                '<%= options.themebase %>/assets/css/frontend/*.css'],

                // Name of the concatenated CSS file for front End
                concat_site: '<%= options.base %>/builds/css/frontend/compiled.css',

                // Name of the minified CSS file for Front End
                min_site: '<%= options.publish %>/frontend/style.min.css',

                // CSS files in order you'd like them concatenated and minified
                files_dash: [
                '<%= options.base %>/builds/css/backend/less.css',
                '<%= options.base %>/builds/css/backend/scss.css',
                '<%= options.css.base %>/backend/*.css',
                '<%= options.themebase %>/assets/css/backend/*.css'],

                // Name of the concatenated CSS file for Backend
                concat_dash: '<%= options.base %>/builds/css/backend/compiled.css',

                // Name of the minified CSS file
                min_dash: '<%= options.publish %>/backend/style.min.css'
            },

            // JavaScript settings
            js: {
                base: 'app/assets/js/',   // Base path to you JS folder

                //JSHint Checking for JS Files
                check_site: ['<%= options.js.base %>/frontend/*.js'],

                //Files to Compile into one file
                files_site: [
                '<%= options.js.base %>/dependencies/jquery-2.0.3.js',
                './vendor/twbs/bootstrap/js/tooltip.js',
                './vendor/twbs/bootstrap/js/*.js',
                '<%= options.js.base %>/frontend/*.js',
                '<%= options.themebase %>/assets/js/frontend/*.js'
                ],

                //JSHint Checking for JS Files
                check_dash: ['<%= options.js.base %>/backend/*.js'],

                //Files to Compile into one file
                files_dash: [
                '<%= options.js.base %>/dependencies/jquery-2.0.3.js',
                'vendor/twbs/bootstrap/js/*.js',
                '<%= options.js.base %>/backend/*.js',
                '<%= options.themebase %>/assets/js/backend/*.js'
                ],


                concat_site: '<%= options.base %>/builds/js/frontend/compiled.js',        // Name of the concatenated JavaScript file
                concat_dash: '<%= options.base %>/builds/js/backend/compiled.js',        // Name of the concatenated JavaScript file

                min_site: '<%= options.publish %>/frontend/script.min.js',      // Name of the minified JavaScript file
                min_dash: '<%= options.publish %>/backend/script.min.js'      // Name of the minified JavaScript file
            },

            // LESS Settings
            less: {
                base: 'app/assets/less',                            // Base path to you LESS folder
                file_site: 'app/assets/less/backend/main.less',                          // LESS file (ideally, one file which contains imports)
                file_dash: 'app/assets/less/frontend/main.less',                          // LESS file (ideally, one file which contains imports)
                compiled_site: '<%= options.base %>/builds/css/frontend/less.css', // Name of the compiled LESS file
                compiled_dash: '<%= options.base %>/builds/css/backend/less.css' // Name of the compiled LESS file
            },

            // scss Settings
            scss: {
                base: 'app/assets/scss',                            // Base path to you scss folder
                file_site: 'app/assets/scss/frontend/main.scss',                          // scss file (ideally, one file which contains imports)
                file_dash: 'app/assets/scss/backend/main.scss',                          // scss file (ideally, one file which contains imports)
                compiled_site: '<%= options.base %>/builds/css/frontend/scss.css', // Name of the compiled scss file
                compiled_dash: '<%= options.base %>/builds/css/backend/scss.css' // Name of the compiled scss file
            },


            // Notification messages
            notify: {
                watch: {
                    title: 'Live Reloaded!',
                    message: 'Files were modified, recompiled and site reloaded'
                }
            },
            clean: {
                all: [
                '<%= options.css.concat_site %>',
                '<%= options.css.concat_dash %>',
                '<%= options.css.min_site %>',
                '<%= options.css.min_dash %>',
                '<%= options.less.compiled_site %>',
                '<%= options.less.compiled_dash %>',
                '<%= options.js.min_site %>',
                '<%= options.js.min_dash %>',
                '<%= options.js.concat_site %>',
                '<%= options.js.concat_dash %>',
                ],

                concat: [
                '<%= options.css.concat_site %>',
                '<%= options.css.concat_dash %>',
                '<%= options.js.concat_site %>',
                '<%= options.js.concat_dash %>'
                ]
            },
        },

        phpunit: {
            classes: {
                dir: 'app/tests'
            },
            options: {
                bin: 'bin/phpunit',
            }
        },

        shell: {
            unit: {
                options: {
                    stdout: true
                },
                command: 'bin/codecept run unit'
            },
            acceptance:{
                options:{
                    stdout:true
                },
                command:'bin/codecept run acceptance'
            },
            functional:{
                options:{
                    stdout:true
                },
                command:'bin/codecept run functional'
            },
            all:{
                options:{
                    stdout:true
                },
                command:'bin/codecept run'
            }
        },

        // Clean files and folders before replacement
        clean: {
            all: {
                src: '<%= options.clean.all %>'
            },
            concat: {
                src: '<%= options.clean.concat %>'
            }
        },

        // Compile LESS files
        less: {
            main: {
                options: {
                    ieCompat: true
                },
                files: {
                    '<%= options.less.compiled_site %>': '<%= options.less.file_site %>',
                    '<%= options.less.compiled_dash %>': '<%= options.less.file_dash %>'
                }
            }
        },
        // Compile scss files
        sass: {
            main: {
                options:{
                    style:"expanded",
                },
                files: {
                    '<%= options.scss.compiled_site %>': '<%= options.scss.file_site %>',
                    '<%= options.scss.compiled_dash %>': '<%= options.scss.file_dash %>',
                }
            }
        },
        // Concatenate multiple sets of files
        concat: {
            css: {
                files: {
                    '<%= options.css.concat_site %>' : ['<%= options.css.files_site %>'],
                    '<%= options.css.concat_dash %>' : ['<%= options.css.files_dash %>']
                }
            },
            js: {
                options: {
                    block: true,
                    line: true,
                    stripBanners: true
                },
                files: {
                    '<%= options.js.concat_site %>' : '<%= options.js.files_site %>',
                    '<%= options.js.concat_dash %>' : '<%= options.js.files_dash %>',
                }
            }
        },

        // Minify and concatenate CSS files
        cssmin: {
            options:{
                keepSpecialComments:0,
                banner: "/*! Edorchestral v<%= pkg.version %> | " +
                        "(c) 2013-2014 Grans Group.| " +
                        "License   : GNU/GPL v3 or Later */"
            },
            minify_site: {
                src: '<%= options.css.concat_site %>',
                dest: '<%= options.css.min_site %>'
            },
            minify_dash: {
                src: '<%= options.css.concat_dash %>',
                dest: '<%= options.css.min_dash %>'
            }
        },

        // Display notifications
        notify: {
            watch: {
                options: {
                    title: '<%= options.notify.watch.title %>',
                    message: '<%= options.notify.watch.message %>'
                }
            }
        },

        // Javascript minification - uglify
        uglify: {
            options: {
                preserveComments: false,
                report: "min",
                beautify: {
                        ascii_only: true
                },
                banner: "/*! Edorchestral v<%= pkg.version %> | " +
                        "(c) 2013-2014 Grans Group.| " +
                        "License   : GNU/GPL v3 or Later */",
                compress: {
                        hoist_funs: false,
                        loops: false,
                        unused: false
                }

            },
            uglify_site:{
                options:{
                    sourceMap: "<%= options.publish %>/frontend/edorches.min.map",
                    sourceMappingURL: "edorches.min.map",
                },
                files: {
                    '<%= options.js.min_site %>':'<%= options.js.concat_site %>'
                }
            },
            uglify_dash:{
                options:{
                    sourceMap: "<%= options.publish %>/backend/edorches.min.map",
                    sourceMappingURL: "edorches.min.map",
                },
                files: {
                    '<%= options.js.min_dash %>':'<%= options.js.concat_dash %>'
                }
            }
        },

        // Watch for files and folder changes
        watch:{
            views:{
                options:{
                    livereload:true
                },
                files:[
                    'app/**/*.blade.php',
                    'app/views/**/*.php'
                    ],
                tasks:[]
            },
            sass:{
                options:{
                    livereload:true
                },
                files:[
                    'app/**/*.scss',
                    'public/**/*.scss'
                ],
                tasks:['sass','concat:css','cssmin']
            },
            less:{
                options:{
                    livereload:true
                },
                files:[
                    'app/**/*.less',
                    'public/**/*.less'
                ],
                tasks:['less','concat:css','cssmin']
            },
            css:{
                options:{
                    livereload:true
                },
                files:[
                    'app/assets/css/**/*.css',
                    'public/**/*.css'
                ],
                tasks:['concat:css','cssmin']
            },
            js:{
                options:{
                    livereload:true
                },
                files:[
                    'app/**/*.js',
                    'public/**/*.js'
                ],
                tasks:['concat:js','uglify']
            },
            html:{
                options:{
                    livereload:true
                },
                files:['app/**/*.html'],
                tasks:[]
            },
            watchtest:{
                files:['app/**/**.php','!app/views/**/*.php'],
                tasks:['phpunit']
            },
            watchunit:{
                files:['tests/unit/**/**.php'],
                tasks:['shell:unit']
            },
            watchfunctional:{
                files:['tests/functional/**/**.php'],
                tasks:['shell:functional']
            },
            watchacceptance:{
                files:['tests/acceptance/**/**.php'],
                tasks:['shell:acceptance']
            },
        }


    });

    // Load npm tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-contrib-livereload');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-shell');


    // Register tasks
    grunt.registerTask('default', ['clean:all','shell:all','phpunit', 'clean:concat' ,'less', 'sass', 'concat:css', 'concat:js', 'cssmin','uglify']);

}
