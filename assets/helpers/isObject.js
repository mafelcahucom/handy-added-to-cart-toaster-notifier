/**
 * Object data type checker.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const isObject = {

	/**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param  {Object} object Contains the object object to be checked.
	 * @return {boolean} The flag whether a certain key is empty.
	 */
	empty( object ) {
		return Object.keys( object ).length === 0;
	},

	/**
	 * Checks if the object has a missing key, if has found
	 * a missing key return true.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array}  keys   Contains the list of keys use as referrence.
	 * @param {Object} object Contains the object to be checked.
	 */
	hasMissingKey( keys, object ) {
		if ( keys.length === 0 || this.empty( object ) ) {
			return;
		}

		let hasMissing = false;
		keys.forEach( function( key ) {
			if ( ! object.hasOwnProperty( key ) ) {
				hasMissing = true;
			}
		} );

		return hasMissing;
	},
};

export default isObject;