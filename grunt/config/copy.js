module.exports = {
	docs: {
		files: [
			{
				src: ['css/**/*'],
				dest: 'docs/public/assets/'
			},
			{
				src: ['img/**/*'],
				dest: 'docs/public/assets/'
			},
			{
				src: ['js/**/*'],
				dest: 'docs/public/assets/'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['components/**/*'],
				dest: 'docs/public/'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['fragments/**/*'],
				dest: 'docs/public/'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['static-templates/**/*'],
				dest: 'docs/public/'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['assets/js/**/*'],
				dest: 'docs/public'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['assets/css/**/*'],
				dest: 'docs/public'
			},
			{
				cwd: 'docs/src/',
				expand: true,
				src: ['index.php'],
				dest: 'docs/public/'
			}
		]
	}
};