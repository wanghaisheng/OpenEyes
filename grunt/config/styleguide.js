module.exports = {
	dist: {
		options: {
			framework: {
				name: 'kss'
			},
			template: {
				src: 'docs/src/templates/styleguide',
				include: ''
			}
		},
		files: {
			'docs/public/styleguide': 'sass/*.scss'
		}
	}
};