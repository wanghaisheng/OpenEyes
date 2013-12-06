module.exports = {
	dist: {
		options: {
			sassDir: 'sass',
			cssDir: 'css',
			imagesDir: 'img',
			generatedImagesDir: 'img/sprites',
			outputStyle: 'expanded',
			relativeAssets: true,
			httpPath: '',
			noLineComments: false
		}
	},
	docs: {
		options: {
			sassDir: 'docs/src/assets/sass',
			cssDir: 'docs/src/assets/css',
			outputStyle: 'expanded',
			relativeAssets: true,
			httpPath: '',
			noLineComments: false
		}
	}
};