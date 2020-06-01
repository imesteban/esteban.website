/**
 *  Gulp Config
 */


// Packages
const PATH          = require( 'path' );
const GULP          = require( 'gulp' );
const WATCH         = require( 'gulp-watch' );
const SOURCEMAPS    = require( 'gulp-sourcemaps' );
const SASS          = require( 'gulp-sass' );
const POSTCSS       = require( 'gulp-postcss' );
const AUTOPREFIXER  = require( 'autoprefixer' );
const RENAME        = require( 'gulp-rename' );
const UGLIFY        = require( 'gulp-uglify' );
const GUTIL         = require( 'gulp-util' );


// Paths
const ASSETS = PATH.join( __dirname, 'assets' );
const CSS = PATH.join( ASSETS, 'CSS' );
const JS = PATH.join( ASSETS, 'js' );
const SCSS = PATH.join( ASSETS, 'scss' );

const BROWSERSYNC = require( 'browser-sync' ).create();


// Patterns
const JS_ENTRY = [ PATH.join( JS, '**', '*.js' ), '!' + PATH.join( JS, '**', '*.min.js' ) ];
const SCSS_WATCH_ENTRY = [ PATH.join( SCSS, '**', '*.scss' ) ];
const SCSS_BUILD_ENTRY = [ PATH.join( SCSS, '**', '*.scss' ), '!' + PATH.join( SCSS, '**', '_*.scss' ) ];


/**
 *  Tasks
 */


// Minify JavaScript
GULP.task('js:build:production', function() {
    return GULP.src( JS_ENTRY)
        .pipe(UGLIFY().on('error', GUTIL.log))
        .pipe(RENAME({ suffix: '.min' }))
        .pipe(GULP.dest(JS));
});


// Parse SASS
GULP.task('scss:build:development', function() {
    return GULP.src(SCSS_BUILD_ENTRY)
        .pipe(SOURCEMAPS.init())
        .pipe(SASS().on('error', GUTIL.log))
        .pipe(POSTCSS([ AUTOPREFIXER({ browsers: ['> 5%', 'IE 9'] }) ]))
        .pipe(SOURCEMAPS.write())
        .pipe(GULP.dest(CSS))
        .pipe(BROWSERSYNC.stream())
        .pipe(BROWSERSYNC.reload({stream:true}));
});


// Watch SASS changes
GULP.task('scss:watch', [ 'scss:build:development' ], function() {
    WATCH(SCSS_WATCH_ENTRY, function() {
        GULP.start('scss:build:development');
    });
});


// Minify SASS/CSS
GULP.task('scss:build:production', [ 'scss:build:development' ], function() {
    return GULP.src(SCSS_BUILD_ENTRY)
        .pipe(SASS({ outputStyle: 'compressed' }).on('error', GUTIL.log))
        .pipe(POSTCSS([ AUTOPREFIXER({ browsers: ['> 5%', 'IE 9'] }) ]))
        .pipe(RENAME({ suffix: '.min' }))
        .pipe(GULP.dest(CSS));
});


// Static server
GULP.task('browser-sync', function() {

    // Files to watch.
    var files = [
        //"**/*.html",
        '**/*js'
    ];

    // Kick off BrowserSync.
    BROWSERSYNC.init(files, {
        //the URL of our local project.
        proxy: "http://estebanwebsite.test/",
    });
});




/**
 *  Task Aliases
 */
// GULP.task('default', [ 'scss:watch' ]);


/**
 *  Task Aliases
 */
//GULP.task('default', [ 'scss:watch' ]);

GULP.task('default', ['browser-sync'], function () {
    //watch for sass changes and reload browser
    GULP.watch(SCSS_WATCH_ENTRY, ['scss:watch'], BROWSERSYNC.reload);
});

GULP.task('build', [ 'scss:build:production', 'js:build:production' ]);