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
 * Holds the toaster component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hatfw.toaster = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.screenResize();
	},

	/**
	 * Set the toaster cotainer width.
	 *
	 * @since 1.0.0
	 */
	setContainerWidth() {
		const toasterElems = document.querySelectorAll( '.hatfw' );
		if ( toasterElems.length === 0 ) {
			return;
		}

		const screenWidth = window.innerWidth;
		const offsetScreenWidth = ( ( ( 3 / 100 ) * screenWidth ) * 2 );
		toasterElems.forEach( function( toasterElem ) {
			const toasterWidth = toasterElem.clientWidth;
			const toasterClientWidth = ( toasterWidth + offsetScreenWidth ) + 5;
			if ( toasterClientWidth > screenWidth ) {
				toasterElem.style.width = `${ screenWidth - offsetScreenWidth }px`;
			} else {
				toasterElem.style.width = hatfwLocal.setting.maxWidth;
			}
		} );
	},

	/**
	 * Set the image width & height.
	 *
	 * @since 1.0.0
	 */
	setImageSize() {
		const containerElems = document.querySelectorAll( '.hatfw__product__col-left' );
		if ( containerElems.length === 0 ) {
			return;
		}

		containerElems.forEach( function( containerElem ) {
			const width = containerElem.clientWidth;
			const height = containerElem.clientHeight;
			const imageElem = containerElem.querySelector( 'img' );
			if ( ! imageElem ) {
				return;
			}

			const minWidth = ( width >= height ? ( width ) : ( height ) );
			imageElem.style.minWidth = `${ minWidth + 5 }px`;
		} );
	},

	/**
	 * Update the width of the toaster on
	 * window resize event.
	 *
	 * @since 1.0.0
	 */
	screenResize() {
		window.addEventListener( 'resize', function() {
			hatfw.toaster.setContainerWidth();
			hatfw.toaster.setImageSize();
		} );
	},

	/**
	 * Show the toast.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params         Contains the necessary parameters.
	 * @param {string} params.title   The title of the toast message.
	 * @param {string} params.image   The image source of the product.
	 * @param {string} params.content The content of the toast.
	 */
	show( params ) {
		const parent = this;

		let toastComponent = this.alertToast( params );
		if ( params.type === 'product' ) {
			toastComponent = this.productToast( params );
		}

		// showing and appending to container
		toastComponent.setAttribute( 'data-visibility', 'visible' );
		this.container().appendChild( toastComponent );

		// set toaster container.
		this.setContainerWidth();

		// set the image size.
		this.setImageSize();

		// hiding and removing element
		setTimeout( function() {
			if ( hatfwLocal.setting.isAutoHide ) {
				if ( toastComponent ) {
					parent.hide( toastComponent );
					parent.hideContainer();
				}
			}
		}, hatfwLocal.setting.duration );

		const closeToastEvent = toastComponent.querySelector( '.hatfw__close-btn' );
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
			if ( hatfw.toaster.container().hasChildNodes() === false ) {
				hatfw.toaster.container().remove();
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
		messageToast.className = 'hatfw';
		messageToast.innerHTML = `
        <div class="hatfw__alert">
            <div class="hatfw__detail">
                <div class="hatfw__head">
                    <div class="hatfw-flex hatfw-flex-ai-c">
                        <div class="hatfw__status hatfw__status--${ params.color }"></div>
                        <strong class="hatfw__title">${ params.title }</strong>
                    </div>
                    <button class="hatfw__close-btn hatfw-flex-c" title="Close" aria-label="Close">
                        <svg class="hatfw__close-btn__svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z'/></svg>
                    </button>
                </div>
                <div class="hatfw__body">
                    <p class="hatfw__p">${ params.content }</p>
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
		productToast.className = 'hatfw';
		productToast.innerHTML = `
        <div class="hatfw__product">
            <div class="hatfw-flex">
                <div class="hatfw__product__col-left">
                    <img class="hatfw__img" src="${ params.image }">
                </div>
                <div class="hatfw__product__col-right">
                    <div class="hatfw__detail">
                        <div class="hatfw__head">
                            <strong class="hatfw__title">${ params.title }</strong>
                            <button class="hatfw__close-btn hatfw-flex-c" title="Close" aria-label="Close">
                                <svg class="hatfw__close-btn__svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z'/></svg>
                            </button>
                        </div>
                        <div class="hatfw__body">
                            <p class="hatfw__p">${ params.content }</p>
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
		let toastContainer = document.getElementById( 'hatfw-container' );
		if ( ! toastContainer ) {
			const container = document.createElement( 'div' );
			container.setAttribute( 'id', 'hatfw-container' );
			document.body.appendChild( container );
			toastContainer = container;
		}
		return toastContainer;
	},
};

/**
 * Holds the add to cart watcher.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hatfw.addToCartWatcher = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.promptProductToaster();
	},

	/**
	 * Show the product toaster after has been successfully
	 * added to the cart.
	 *
	 * @since 1.0.0
	 */
	promptProductToaster() {
		// Return if handy add to cart plugin is active.
		if ( hatfwLocal.plugin.isHAFWActive ) {
			return;
		}

		jQuery( 'body' ).on( 'added_to_cart', function( event, fragments ) {
			if ( ! Object.keys( fragments ).includes( 'hatfw_product' ) ) {
				return;
			}

			const product = JSON.parse( fragments.hatfw_product );
			handyToasterNotifier.show( {
				type: 'product',
				title: 'Added To Cart',
				image: product.image,
				content: product.name,
			} );
		} );
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
	window.handyToasterNotifier = hatfw.toaster; // Include toaster event in window.
	hatfw.toaster.init(); // Holds the toaster component event.
	hatfw.addToCartWatcher.init(); // Holds the add to cart watcher.
} );
