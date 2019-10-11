var gulp           = require('gulp'),
		gutil          = require('gulp-util' ),
		sass           = require('gulp-sass'),
		browserSync    = require('browser-sync'),
		cleanCSS       = require('gulp-clean-css'),
		autoprefixer   = require('gulp-autoprefixer'),
		bourbon        = require('node-bourbon'),
		ftp            = require('vinyl-ftp');
		plumber 			 = require('gulp-plumber');

var paths = {
	twig: {
		watch: 'catalog/view/theme/apple/template/**/*.twig'
	},
	phpLang: {
		watch: 'catalog/language/**/*.php'
	},
	sass: {
		src: 'catalog/view/theme/apple/stylesheet/stylesheet.sass',
		dest: 'catalog/view/theme/apple/stylesheet',
		watch: 'catalog/view/theme/apple/stylesheet/*.sass'
	},
	js: {
		watch: 'catalog/view/theme/apple/js/**/*.js',
	},
	libs: {
		watch: 'catalog/view/theme/apple/libs/**/*'
	}
};

gulp.task('twig', function () {
	return gulp.src(paths.twig.watch)
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('phpLang', function () {
	return gulp.src(paths.phpLang.watch)
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('js', function () {
	return gulp.src(paths.js.watch)
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('libs', function () {
	return gulp.src(paths.libs.watch)
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('sass', function() {
	return gulp.src(paths.sass.src)
		.pipe(plumber())
		.pipe(sass({
			includePaths: bourbon.includePaths
		}).on('error', sass.logError))
		.pipe(autoprefixer(['last 4 versions']))
		.pipe(cleanCSS())
		.pipe(gulp.dest(paths.sass.dest))
		.pipe(browserSync.reload({stream: true}))
});

gulp.task('server', function() {
	browserSync.init({
		proxy: 'opencart.loc',
		reloadOnRestart: true,
		notify: false,
	});
	gulp.watch(paths.sass.watch, gulp.parallel('sass'));
	gulp.watch(paths.twig.watch, gulp.parallel('twig'));
	gulp.watch(paths.phpLang.watch, gulp.parallel('phpLang'));
	gulp.watch(paths.js.watch, gulp.parallel('js'));
	gulp.watch(paths.libs.watch, gulp.parallel('libs'));
});

gulp.task('build', gulp.series(
	'sass'
));

gulp.task('dev', gulp.series(
	'build', 'server'
));
