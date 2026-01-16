module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);
	const fs = require('fs'),
		PACK = grunt.file.readJSON('package.json'),
		date = new  Date(),
		year = date.getFullYear(),
		month = String(date.getMonth() + 1).padStart(2, "0"),
		day = String(date.getDate()).padStart(2, "0");
	grunt.initConfig({
		globalConfig : {},
		pkg : {},
		clean: {
			zip: ['*.zip']
		},
		'string-replace': {
			tpl: {
				files: {
					'install/assets/plugins/': 'install/assets/plugins/**',
					'assets/plugins/utilites/notocoloremoji/': 'assets/plugins/utilites/notocoloremoji/**',
				},
				options: {
					replacements: [
						{
							pattern: /[ ]+\*(?:\s+)\@version(\s+)([\d.]+)/gi,
							replacement: ` * @version$1${PACK.version}`,
						},
						{
							pattern: /[ ]+\*(?:\s+)\@lastupdate(\s+)([\d.-]+)/gi,
							replacement: ` * @lastupdate$1${year}-${month}-${day}`,
						},
						{
							pattern: /\@modx_category(\s+).+/gi,
							replacement: `@modx_category Utilites`,
						},
					],
				},
			},
		},
		less: {
			main: {
				options : {
					compress: false,
					ieCompat: false,
					plugins: [],
					modifyVars: {
						fontpath: "/assets/plugins/utilites/notocoloremoji/fonts"
					},
				},
				files : {
					'assets/plugins/utilites/notocoloremoji/noto-color-emoji.css' : [
						'src/less/main.less'
					],
				}
			}
		},
		autoprefixer:{
			options: {
				browsers: [
					"last 4 version"
				],
				cascade: true
			},
			main: {
				files: {
					'assets/plugins/utilites/notocoloremoji/noto-color-emoji.css' : [
						'assets/plugins/utilites/notocoloremoji/noto-color-emoji.css'
					],
				}
			}
		},
		cssmin: {
			options: {
				mergeIntoShorthands: false,
				roundingPrecision: -1
			},
			main: {
				files: {
					'assets/plugins/utilites/notocoloremoji/noto-color-emoji.min.css' : [
						'assets/plugins/utilites/notocoloremoji/noto-color-emoji.css'
					],
				}
			}
		},
		copy: {
			main: {
				files: [
					{
						expand: true,
						cwd: 'node_modules/noto-color-emoji/src/fonts',
						src: ['*.*'],
						dest: 'assets/plugins/utilites/notocoloremoji/fonts/',
					},
				]
			}
		},
		compress: {
			main: {
				options: {
					archive: `NotoColorEmoji.zip`,
				},
				files: [
					{
						src: [
							'assets/**',
							'install/**',
						],
						dest: `NotoColorEmoji/`,
					},
				],
			},
		},
	});
	grunt.registerTask('default',	[
		"clean",
		"string-replace",
		"less",
		"autoprefixer",
		"cssmin",
		"copy",
		"compress"
	]);
};
