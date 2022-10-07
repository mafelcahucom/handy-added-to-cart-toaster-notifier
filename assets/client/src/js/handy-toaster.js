/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const handy = handy || {};

/**
 * Toaster Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
handy.toaster = {

	/**
	 * Show the toast.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object}  params          Contains the necessary parameters.
	 * @param {string}  params.title    The title of the toast.
	 * @param {string}  params.message  The message of the toast.
	 * @param {integer} params.duration The duration of the toaster before hiding.
	 * @param {boolean} params.allowed  Check if the plugin is allowed to use toaster.
	 */
	show( params ) {
		if ( ! params.allowed ) {
			return;
		}

		// Initialize class
		const parent = this;

		let toastComponent = this.alertToast( params );
		if ( params.type === 'product' ) {
			toastComponent = this.productToast( params );
		}

		// showing and appending to container
		toastComponent.setAttribute( 'data-visibility', 'visible' );
		this.container().appendChild( toastComponent );

		// hiding and removing element
		setTimeout( function() {
			if ( toastComponent ) {
				parent.hide( toastComponent );
				parent.hideContainer();
			}
		}, params.duration );

		const closeToastEvent = toastComponent.querySelector( '.handy-toast__close-btn' );
		if ( closeToastEvent ) {
			closeToastEvent.addEventListener( 'click', function() {
				if ( toastComponent ) {
					parent.hide( toastComponent );
					parent.hideContainer();
				}
			} );
		}
	},

	/**
	 * Hide the toast component.
	 *
	 * @since 1.0.0
	 *
	 * @param {HTMLElement} toastComponent The current showed toast component.
	 */
	hide( toastComponent ) {
		toastComponent.setAttribute( 'data-visibility', 'hidden' );
		toastComponent.addEventListener( 'animationend', function() {
			toastComponent.remove();
		}, false );
	},

	/**
	 * Hide the toast container.
	 *
	 * @since 1.0.0
	 */
	hideContainer() {
		setTimeout( function() {
			if ( handy.toaster.container().hasChildNodes() === false ) {
				handy.toaster.container().remove();
			}
		}, 1000 );
	},

	/**
	 * Returns the new created toast component element.
	 *
	 * @param {Object} params         Contains the necessary parameters in rendering toast component.
	 * @param {string} params.title   The title of the toast.
	 * @param {string} params.message The message of the toast.
	 * @return {HTMLElement}  Alert toast component.
	 */
	alertToast( params ) {
		const messageToast = document.createElement( 'div' );
		messageToast.className = 'handy-toast';
		messageToast.innerHTML = `
        <div class="handy-toast__alert">
            <div class="handy-toast__detail">
                <div class="handy-toast__head">
                    <div class="handy-toast__info">
                        <div class="handy-toast__status handy-toast__status--${ params.color }"></div>
                        <strong class="handy-toast__title">${ params.title }</strong>
                    </div>
                    <button class="handy-toast__close-btn" title="close">
                        <svg class="handy-toast__close-btn__svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z'/></svg>
                    </button>
                </div>
                <div class="handy-toast__body">
                    <p class="handy-toast__p">${ params.content }</p>
                </div>
            </div>
        </div>
        `;
		return messageToast;
	},

	/**
	 * Returns the new created product version toast component element.
	 *
	 * @param {Object} params         Contains the necessary parameters in rendering toast component.
	 * @param {string} params.title   The title of the toast.
	 * @param {string} params.message The message of the toast.
	 * @param {string} params.image   The url of the product thumbnail.
	 * @return {HTMLElement}  Product toast component.
	 */
	productToast( params ) {
		const productToast = document.createElement( 'div' );
		productToast.className = 'handy-toast';
		productToast.innerHTML = `
        <div class="handy-toast__product">
            <div class="handy-toast__two-col">
                <div class="handy-toast__two-col--left">
                    <img class="handy-toast__img" src="${ params.image }">
                </div>
                <div class="handy-toast__two-col--right">
                    <div class="handy-toast__detail">
                        <div class="handy-toast__head">
                            <strong class="handy-toast__title">${ params.title }</strong>
                            <button class="handy-toast__close-btn" title="close">
                                <svg class="handy-toast__close-btn__svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z'/></svg>
                            </button>
                        </div>
                        <div class="handy-toast__body">
                            <p class="handy-toast__p">${ params.content }</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
		return productToast;
	},

	/**
	 * Render and append toast container in the main body element.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement}  Toast main container.
	 */
	container() {
		let toastContainer = document.getElementById( 'handy-toast-container' );
		if ( ! toastContainer ) {
			const container = document.createElement( 'div' );
			container.setAttribute( 'id', 'handy-toast-container' );
			document.body.appendChild( container );
			toastContainer = container;
		}
		return toastContainer;
	},
};

window.handyToaster = handy.toaster;
