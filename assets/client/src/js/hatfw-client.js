/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
'use strict';

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hatfw = hatfw || {};

/**
 * Helper.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hatfw.fn = {

	/**
	 * Global event listener delegation.
	 *
	 * @since 1.0.0
	 *
	 * @param {string}   type     Event type can be multiple seperate with space.
	 * @param {string}   selector Target element.
	 * @param {Function} callback Callback function.
	 */
	async eventListener( type, selector, callback ) {
		const events = type.split( ' ' );
		events.forEach( function( event ) {
			document.addEventListener( event, function( e ) {
				if ( e.target.matches( selector ) ) {
					callback( e );
				}
			} );
		} );
	},

	/**
	 * Fetch handler.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params Containing the parameters.
	 * @return {Object} Fetch response
	 */
	async fetch( params ) {
		let result = {
			success: false,
			data: {
				error: 'NETWORK_ERROR',
			},
		};

		if ( this.isObjectEmpty( params ) ) {
			result.data.error = 'MISSING_DATA_ERROR';
			return result;
		}

		try {
			const response = await fetch( hatfwLocal.url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams( params ),
			} );

			if ( response.ok ) {
				result = await response.json();
			}
		} catch ( e ) {
			console.log( 'error', e );
		}

		return result;
	},

	/**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object The object to be checked.
	 * @return {boolean} Whether has empty key.
	 */
	isObjectEmpty( object ) {
		return Object.keys( object ).length === 0;
	},

	/**
	 * Check if the element animation is done or into end.
	 *
	 * @since 1.0.0
	 *
	 * @param {element} element The element to be watch.
	 * @return {boolean}
	 */
	isAnimationDone( element ) {
		return new Promise( function( resolve, reject ) {
			if ( ! element ) {
				resolve( false );
			}

			element.addEventListener( 'animationend', function() {
				resolve( true );
			} );
		} );
	},

	/**
	 * Sets the attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector  The element selector.
	 * @param {string} attribute The Attribute to be set.
	 * @param {string} value     The value of the attribute.
	 */
	setAttribute( selector, attribute, value ) {
		if ( ! selector || ! attribute ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length === 0 ) {
			return;
		}

		elems.forEach( function( elem ) {
			elem.setAttribute( attribute, value );
		} );
	},

	/**
	 * Remove elements based on the selector.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector The element query selector.
	 */
	removeElements( selector ) {
		if ( ! selector ) {
			return;
		}

		const elements = document.querySelectorAll( selector );
		if ( elements.length === 0 ) {
			return;
		}

		elements.forEach( function( element ) {
			element.remove();
		} );
	}
};

/**
 * Holds all the prompt compnents.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hatfw.prompt = {

	/**
	 * Prompts the toaster aler type - error.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error The error name.
	 */
	errorMessage( error ) {
		const errors = [
			{
				error: 'NETWORK_ERROR',
				title: 'Network Error',
				content: 'The network connection is lost, there might be a problem with your network.',
			},
			{
				error: 'SECURITY_ERROR',
				title: 'Security Error',
				content: 'A security error occur. Please try again later or contact the website administrator for help.',
			},
			{
				error: 'MISSING_DATA_ERROR',
				title: 'Missing Data',
				content: 'There is a missing data that are required. Please check and try again.',
			},
		];

		const errorDetail = errors.find( function( value ) {
			return ( value.error === error );
		} );

		if ( errorDetail ) {
			handyToaster.show( {
				type: 'alert',
				color: 'danger',
				title: errorDetail.title,
				content: errorDetail.content,
				duration: hatfwLocal.toaster.duration,
				allowed: hatfwLocal.toaster.isUseToaster,
			} );
		}
	},
};

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
hatfw.domReady = {

	/**
	 * Execute the code when dom is ready.
	 *
	 * @param {Function} func callback
	 * @return {Function} The callback function.
	 */
	execute( func ) {
		if ( typeof func !== 'function' ) {
			return;
		}
		if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

hatfw.domReady.execute( function() {

} );
