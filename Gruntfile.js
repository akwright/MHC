module.exports = function(grunt) {

    // configurable paths
    var mhcConfig = {
        javascripts: './javascripts',
        coffeescripts: './javascripts/coffeescripts',
        stylesheets: './stylesheets',
        scss: './stylesheets/scss',
        images: './images',
        dist: './dist'
    };

    grunt.initConfig({
        // create mhc and pkg templates
        mhc: mhcConfig,
        pkg: grunt.file.readJSON('package.json'),

        coffee: {
          compile: {
            src:  '<%= mhc.coffeescripts %>/*.coffee',
            dest: '<%= mhc.javascripts %>/mhc.js'
          }
        },

        /**
         * This task requires Sass & Compass to be installed on your machine.
         *
         * - http://compass-style.org/install/
         * - http://sass-lang.com/download.html
         */
        sass: {
          compile: {
            options: {
              compass: true,
              style: 'expanded'
            },
            expand: true,
            flatten: true,
            cwd: '<%= mhc.scss %>',
            src: ['*.scss', '!ie7.scss'],
            dest: '.',
            ext: '.css'
          }
        },

        clean: {
          dist: '<%= mhc.dist %>'
        },

        copy: {
          //svgo doesn't support dest:src optimization, so we copy SVG files over manually
          opt: {
            expand: true,
            flatten: true,
            src: '<%= mhc.images %>/src/*.svg',
            dest: '<%= mhc.images %>'
          },
          dist: {
            expand: true,
            src: [
              './**',
              '!<%= mhc.images %>/src/**',
              '!<%= mhc.stylesheets %>/**',
              '!<%= mhc.coffeescripts %>/**',
              '!./node_modules/**',
              '!./docs/**',
              '!./.git/**',
              '!./Gruntfile.js',
              '!./package.json',
              '!./config.rb',
              '!./*.md'
            ],
            dest: '<%= mhc.dist %>/mhc/'
          }
        },

        compress: {
          dist: {
            options: {
              archive: '<%= mhc.dist %>/mhc-<%= pkg.version %>.zip'
            },
            src: '<%= mhc.dist %>/mhc/**',
            dest: '<%= mhc.dist %>'
          }
        },

        jshint: {
          test: {
            src: '<%= mhc.javascripts %>/mhc.js'
          }
        },

        uglify: {
          opt: {
            src: '<%= mhc.javascripts %>/mhc.js',
            dest: '<%= mhc.javascripts %>/mhc.min.js'
          }
        },

        csso: {
          compress: {
            options: {
              report: 'gzip'
            },
            src: 'style.css',
            dest: 'style.min.css'
          },
          restructure: {
            options: {
              restructure: true,
              report: 'gzip'
            },
            src: 'style.css',
            dest: 'style.min.css'
          }
        },

        csslint: {
          test: {
            src: ['style.css', 'rtl.css', 'ie.css', 'print.css', 'editor-style.css']
          }
        },

        /**
         * Uses CSSCSS to analyse any redundancies in the CSS files.
         * - http://zmoazeni.github.io/csscss/
         * - $ gem install csscss
         */
        csscss: {
          test: {
            options: {
              verbose: true
            },
            src: ['editor-style.css', 'ie.css', 'print.css', 'style.css']
          }
        },

        phpcs: {
          test: {
            options: {
              bin: 'vendor/squizlabs/php_codesniffer/scripts/phpcs',
              standard: 'WordPress'
            },
            dir: './**.php'
          }
        },

        imagemin: {
          opt: {
            options: {
              optimizationLevel: 3
            },
            expand: true,
            cwd: '<%= mhc.images %>/src',
            src: '*.{png,jpg,jpeg}',
            dest: '<%= mhc.images %>'
          }
        },

        svgo: {
          opt: {
            files: '<%= mhc.images %>/*.svg'
          }
        },

        webp: {
          optPNG:{
            src: '<%= mhc.images %>/*.png',
            dest: '<%= mhc.images %>',
            options: {
                verbose: true,
                quality: 80,
                alphaQuality: 80,
                compressionMethod: 6,
                segments: 4,
                psnr: 42,
                sns: 50,
                filterStrength: 40,
                filterSharpness: 3,
                simpleFilter: true,
                partitionLimit: 50,
                analysisPass: 6,
                multiThreading: true,
                lowMemory: false,
                alphaMethod: 0,
                alphaFilter: 'best',
                alphaCleanup: true,
                noAlpha: false,
                lossless: true
              }
          },
          optJPG:{
            src: '<%= mhc.images %>/*.{jpeg,jpg}',
            dest: '<%= mhc.images %>',
            options: {
                preset: 'photo',
                verbose: true,
                quality: 70,
                alphaQuality: 80,
                compressionMethod: 6,
                segments: 4,
                psnr: 42,
                sns: 50,
                filterStrength: 40,
                filterSharpness: 3,
                simpleFilter: true,
                partitionLimit: 50,
                analysisPass: 6,
                multiThreading: true,
                lowMemory: false,
                alphaMethod: 0,
                alphaFilter: 'best',
                alphaCleanup: true,
                noAlpha: true,
                lossless: false
              }
          }
        },

        markdown: {
          docs: {
            options: {
              gfm: true,
              highlight: 'manual',
              codeLines: {
                before: '<span>',
                after: '</span>'
              }
            },
            files: ['*.md'],
            dest: './',
          }
        },

        contributors: {
          docs: {
            path: 'CONTRIBUTORS.md',
            branch: 'master',
            chronologically: true
          }
        },

        watch: {
          sass: {
            files: '<%= mhc.scss %>/*.scss',
            tasks: ['sass']
          },
          coffee: {
            files: '<%= mhc.coffeescripts %>/*.coffee',
            tasks: ['coffee']
          }
        },
    });

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
    grunt.loadNpmTasks('svgo-grunt');

    /**
     * Grunt tasks for development.
     */
    grunt.registerTask('default', ['coffee', 'sass']);

    /*
    * Grunt tasks which build a clean theme for deployment
    */
    grunt.registerTask('dist', ['clean', 'default', 'copy:dist', 'compress']);
    grunt.registerTask('opt', ['copy:opt', 'imagemin', 'svgo', 'webp', 'uglify', 'sass', 'csso:restructure']);

    /**
     * Grunt tasks that help improve code quality.
     */
    grunt.registerTask('test', ['default', 'jshint']);

    /*
    * Grunt tasks for documentation
    */
    grunt.registerTask('docs', ['contributors', 'markdown']);

};