/**
 * Set the text of an element based on selector.
 *
 * @since 1.0.0
 *
 * @param {string} selector Contains the selector of the target element.
 * @param {string} text     Contains the text to be inserted in the element.
 */
const setText = function( selector, text ) {
    if ( selector && text ) {
        const elems = document.querySelectorAll( selector );
        if ( elems.length > 0 ) {
            elems.forEach( function( elem ) {
                elem.textContent = text;
            } );
        }
    }
};

export default setText;