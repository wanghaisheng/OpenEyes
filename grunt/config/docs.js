module.exports = {
	all: {
		options: {
			tasks: [
				'bower',
				'clean:docs',
				'build',
				'compass:docs',
				'copy:docs',
				'styleguide:dist',
				'jsdoc:dist'
			]
		}
	},
	javascript: {
		options: {
			tasks: [
				'clean:docs',
				'build',
				'compass:docs',
				'copy:docs',
				'jsdoc:dist'
			]
		}
	},
	css: {
		options: {
			tasks: [
				'clean:docs',
				'build',
				'compass:docs',
				'copy:docs',
				'styleguide:dist'
			]
		}
	}
};