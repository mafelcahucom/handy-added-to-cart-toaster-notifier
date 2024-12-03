const defaultConfiguration = require( '@wordpress/scripts/config/webpack.config' );
const removeEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const path = require( 'path' );

module.exports = {
	...defaultConfiguration,
	...{
		entry: {
			'admin/scripts/hatfw-admin': path.resolve(
				process.cwd(),
				'resources/admin/scripts',
				'hatfw-admin.js'
			),
			'admin/styles/hatfw-admin': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hatfw-admin.scss'
			),
            'admin/styles/hatfw-home': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hatfw-home.scss'
			),
			'client/scripts/hatfw-client': path.resolve(
				process.cwd(),
				'resources/client/scripts',
				'hatfw-client.js'
			),
		},
		plugins: [
			...defaultConfiguration.plugins,
			new removeEmptyScriptsPlugin( {
				stage: removeEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS,
			} ),
		],
	},
};
