/**
 * Internal Dependencies.
 */
import Components from './components';
import Modules from './modules';

/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
( 'use strict' ); // eslint-disable-line no-unused-expressions

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hatfw = hatfw || {};

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
hatfw.domReady = {
	/**
	 * Execute the code when dom is ready.
	 *
	 * @param {Function} func Contains the callback function.
	 * @return {Function|void} The callback function.
	 */
	execute( func ) {
		if ( 'function' !== typeof func ) {
			return;
		}

		if ( 'interactive' === document.readyState || 'complete' === document.readyState ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hatfw.domReady.execute( () => {
	const Fragments = [ ...Components, ...Modules ];
	Fragments.forEach( ( Fragment ) => {
		if ( 'init' in Fragment ) {
			Fragment.init();
		}
	} );
} );
