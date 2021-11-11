module.exports = function (grunt) {
    // Project configuration
    var autoprefixer = require('autoprefixer');

    const sass = require('node-sass');

    var pkgInfo = grunt.file.readJSON('package.json');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        browserify: {
            options: {
                transform: [['babelify', { presets: ['@babel/preset-env'] }]],
                browserifyOptions: {
                    debug: true
                }
            },
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: 'src/widgets',
                        src: ['**.js'],
                        dest: 'assets/js/unminified',
                        ext: '.js'
                    },
                    {
                        src: 'src/controls/query-post.js',
                        dest: 'assets/js/unminified/query-post.js',
                    },
                ]
            }
        },

        // Concat and Minify our js.
        uglify: {
            js: {
                files: [
                    {
                        expand: true,
                        cwd: 'assets/js/unminified',
                        src: ['**.js'],
                        dest: 'assets/js/minified',
                        ext: '.min.js'
                    },
                    {
                        src: 'assets/admin/js/admin.js',
                        dest: 'assets/admin/js/admin.min.js',
                    },
                ]
            }
        },

        // Compile our sass.
        sass: {
            options: {
                implementation: sass,
                sourcemap: 'none',
                outputStyle: 'expanded',
                linefeed: 'lf',
                indentType: 'tab',
                indentWidth: 1
            },
            dist: {
                files: [
                    {
                        'assets/admin/css/style.css': 'sass/admin/style.scss',
                    },
                    {
                        'assets/admin/css/editor.css': 'sass/admin/editor.scss',
                    },
                    {
                        expand: true,
                        cwd: 'sass/',
                        src: ['**.scss'],
                        dest: 'assets/css/unminified',
                        ext: '.css'
                    },
                ]
            }
        },

        postcss: {
            options: {
                map: false,
                processors: [
                    autoprefixer({
                        cascade: false
                    })
                ]
            },
            style: {
                expand: true,
                src: [
                    '*.css',
                ]
            }
        },

        // Minify CSS
        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            css: {
                files: [
                    {
                        expand: true,
                        src: [
                            '**/*.css',
                        ],
                        dest: 'assets/css/minified',
                        cwd: 'assets/css/unminified',
                        ext: '.min.css'
                    },
                    {
                        src: 'assets/admin/css/style.css',
                        dest: 'assets/admin/css/style.min.css',
                    },
                    {
                        src: 'assets/admin/css/editor.css',
                        dest: 'assets/admin/css/editor.min.css',
                    },
                ]
            }
        },

        // Watch for changes.
        watch: {
            options: {
                spawn: false,
            },
            scss: {
                files: ['sass/*.scss'],
                tasks: ['sass'],
            },
            js: {
                files: ['src/**/*.js'],
                tasks: ['browserify:dist', 'uglify:js'],
            },
        },

        // Copy the theme into the build directory
        copy: {
            main: {
                expand: true,
                src: [
                    '**',
                    '!node_modules/**',
                    '!vendor/**',
                    '!build/**',
                    '!.git/**',
                    '!CONTRIBUTING.md',
                    '!README.md',
                    '!Gruntfile.js',
                    '!package.json',
                    '!package-lock.json',
                    '!.csscomb.json',
                    '!.tern-project',
                    '!.gitignore',
                    '!.jshintrc',
                    '!*.map',
                    '!**/*.map',
                    '!**/Gruntfile.js',
                    '!**/package.json',
                    '!composer.phar',
                    '!composer.json',
                    '!composer.lock',
                    '!sass/**',
                    '!src/**',
                    '!.DS_Store',
                    '!phpcs.xml',
                    '!**/*~',
                ],
                dest: '<%= pkg.name %>/',
            },
        },

        // Compress build directory into <name>.zip
        compress: {
            main: {
                options: {
                    archive: '<%= pkg.name %>.zip',
                    mode: 'zip',
                    level: 5
                },
                files: [
                    {
                        src: [
                            './<%= pkg.name %>/**'
                        ]

                    }
                ]
            }
        },

        makepot: {
            target: {
                options: {
                    domainPath: '/languages/', // Where to save the POT file.
                    exclude: [
                        // Exlude folder.
                        'build/.*',
                        'assets/.*',
                        'readme/.*',
                        'sass/.*',
                        'bower_components/.*',
                        'node_modules/.*',
                        'vendor/.*',
                    ],
                    potFilename: '<%= pkg.name %>.pot', // Name of the POT file.
                    type: 'wp-plugin', // Type of project (wp-plugin or wp-theme).
                    updateTimestamp: true, // Whether the POT-Creation-Date should be updated without other changes.
                    processPot: function (pot, options) {
                        pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;';
                        pot.headers['last-translator'] = 'Zeus\n';
                        pot.headers['language-team'] = 'Zeus\n';
                        pot.headers['x-poedit-basepath'] = '..\n';
                        pot.headers['x-poedit-language'] = 'English\n';
                        pot.headers['x-poedit-country'] = 'UNITED STATES\n';
                        pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
                        pot.headers['x-poedit-searchpath-0'] = '.\n';
                        pot.headers['x-poedit-keywordslist'] =
                            '_esc_attr__;esc_attr_x;esc_attr_e;esc_html__;esc_html_e;esc_html_x;__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
                        pot.headers['x-textdomain-support'] = 'yes\n';
                        return pot;
                    },
                },
            },
        },

        clean: {
            main: ['<%= pkg.name %>'],
            zip: ['*.zip']
        },

        wp_readme_to_markdown: {
            your_target: {
                files: {
                    'README.md': 'readme.txt'
                }
            },
        },
    });

    // Load grunt tasks
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-wp-i18n');
    grunt.loadNpmTasks('grunt-wp-readme-to-markdown');

    // SASS compile
    grunt.registerTask('scss', ['sass']);

    // Dev task
    grunt.registerTask('js', ['browserify:dist', 'uglify:js']);

    // Make pot
    grunt.registerTask('lang', ['makepot']);

    // Style
    grunt.registerTask('style', ['scss', 'cssmin:css', 'postcss:style']);

    // Style and min
    grunt.registerTask('build', ['style', 'uglify:js', 'cssmin:css']);

    // Grunt release - Create installable package of the local files
    grunt.registerTask('pack', ['clean:zip', 'copy:main', 'compress:main', 'clean:main']);

    // Generate Read me file
    grunt.registerTask('read', ['wp_readme_to_markdown']);

    grunt.util.linefeed = '\n';
};
