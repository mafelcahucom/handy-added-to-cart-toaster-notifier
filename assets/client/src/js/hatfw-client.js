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
		if ( toasterElems.length > 0 ) {
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
		}
	},

	/**
	 * Set the image width & height.
	 *
	 * @since 1.0.0
	 */
	setImageSize() {
		const containerElems = document.querySelectorAll( '.hatfw__product__col-left' );
		if ( containerElems.length > 0 ) {
			containerElems.forEach( function( containerElem ) {
				const width = containerElem.clientWidth;
				const height = containerElem.clientHeight;
				const imageElem = containerElem.querySelector( 'img' );
				if ( imageElem ) {
					const minWidth = ( width >= height ? ( width ) : ( height ) );
					imageElem.style.minWidth = `${ minWidth + 5 }px`;
				}
			} );
		}
	},

	/**
	 * Update the width of the toaster on window resize event.
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
	 * @param {string} params.title   Contains the title of the toast message.
	 * @param {string} params.image   Contains the image source of the product.
	 * @param {string} params.content Contains the content of the toast.
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
	 * @param {HTMLElement} toastComponent Contains the current showed toast component.
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
	 * Return the close button compnent element.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement} The close button element.
	 */
	closeButton() {
		return `
			<button class="hatfw__close-btn hatfw-flex-c" title="Close" aria-label="Close">
				<svg class="hatfw__close-btn__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		`;
	},

	/**
	 * Returns the new created toast component element.
	 *
	 * @param {Object} params         Contains the necessary parameters in rendering toast component.
	 * @param {string} params.title   Contains the title of the toast.
	 * @param {string} params.message Contains the message of the toast.
	 * @return {HTMLElement}  The alert toaster component.
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
                    ${ this.closeButton() }
                </div>
                <div class="hatfw__body">
                    <p class="hatfw__p">${ params.content }</p>
                </div>
            </div>
        </div>`;

		return messageToast;
	},

	/**
	 * Returns the new created product version toast component element.
	 *
	 * @param {Object} params         Contains the necessary parameters in rendering toast component.
	 * @param {string} params.title   Contains the title of the toast.
	 * @param {string} params.message Contains the message of the toast.
	 * @param {string} params.image   Contains the url of the product thumbnail.
	 * @return {HTMLElement}  The product toaster component.
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
                            ${ this.closeButton() }
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
	 * @return {HTMLElement}  The toaster main container.
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
 * Add To Cart Watcher Event.
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
	 * Show the product toaster after has been successfully added to the cart.
	 *
	 * @since 1.0.0
	 */
	promptProductToaster() {
		if ( ! hatfwLocal.plugin.isHAFWActive ) {
			jQuery( 'body' ).on( 'added_to_cart', function( event, fragments ) {
				if ( Object.keys( fragments ).includes( 'hatfw_product' ) ) {
					const product = JSON.parse( fragments.hatfw_product );
					handyToasterNotifier.show( {
						type: 'product',
						title: 'Added To Cart',
						image: product.image,
						content: product.name,
					} );
				}
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
	 * @param {Function} func Contains the callback function.
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

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hatfw.domReady.execute( function() {
	// Localize Toaster Notifier Events.
	window.handyToasterNotifier = hatfw.toaster;

	// Initialize Components.
	Object.entries( hatfw ).forEach( function( fragment ) {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );
