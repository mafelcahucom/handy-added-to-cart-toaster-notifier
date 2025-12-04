/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/*!**************************************************!*\
  !*** ./resources/client/scripts/hatfw-client.js ***!
  \**************************************************/
/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */


/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var hatfw = hatfw || {};

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
  init: function init() {
    this.screenResize();
  },
  /**
   * Set the toaster cotainer width.
   *
   * @since 1.0.0
   */
  setContainerWidth: function setContainerWidth() {
    var toasterElems = document.querySelectorAll('.hatfw');
    if (0 < toasterElems.length) {
      var screenWidth = window.innerWidth;
      var offsetScreenWidth = 3 / 100 * screenWidth * 2;
      toasterElems.forEach(function (toasterElem) {
        var toasterWidth = toasterElem.clientWidth;
        var toasterClientWidth = toasterWidth + offsetScreenWidth + 5;
        if (toasterClientWidth > screenWidth) {
          toasterElem.style.width = "".concat(screenWidth - offsetScreenWidth, "px");
        } else {
          // eslint-disable-next-line no-undef
          toasterElem.style.width = hatfwLocal.setting.maxWidth;
        }
      });
    }
  },
  /**
   * Set the image width & height.
   *
   * @since 1.0.0
   */
  setImageSize: function setImageSize() {
    var containerElems = document.querySelectorAll('.hatfw__product__col-left');
    if (0 < containerElems.length) {
      containerElems.forEach(function (containerElem) {
        var width = containerElem.clientWidth;
        var height = containerElem.clientHeight;
        var imageElem = containerElem.querySelector('img');
        if (imageElem) {
          var minWidth = width >= height ? width : height;
          imageElem.style.minWidth = "".concat(minWidth + 5, "px");
        }
      });
    }
  },
  /**
   * Update the width of the toaster on window resize event.
   *
   * @since 1.0.0
   */
  screenResize: function screenResize() {
    window.addEventListener('resize', function () {
      hatfw.toaster.setContainerWidth();
      hatfw.toaster.setImageSize();
    });
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
  show: function show(params) {
    var parent = this;
    var toastComponent = this.alertToast(params);
    if ('product' === params.type) {
      toastComponent = this.productToast(params);
    }

    // showing and appending to container
    toastComponent.setAttribute('data-visibility', 'visible');
    this.container().appendChild(toastComponent);

    // set toaster container.
    this.setContainerWidth();

    // set the image size.
    this.setImageSize();

    /* eslint-disable no-undef */
    setTimeout(function () {
      if (hatfwLocal.setting.isAutoHide) {
        if (toastComponent) {
          parent.hide(toastComponent);
          parent.hideContainer();
        }
      }
    }, hatfwLocal.setting.duration);
    /* eslint-enable */

    var closeToastEvent = toastComponent.querySelector('.hatfw__close-btn');
    if (closeToastEvent) {
      closeToastEvent.addEventListener('click', function () {
        if (toastComponent) {
          parent.hide(toastComponent);
          parent.hideContainer();
        }
      });
    }
  },
  /**
   * Hide the toast component.
   *
   * @since 1.0.0
   *
   * @param {HTMLElement} toastComponent Contains the current showed toast component.
   */
  hide: function hide(toastComponent) {
    toastComponent.setAttribute('data-visibility', 'hidden');
    toastComponent.addEventListener('animationend', function () {
      toastComponent.remove();
    }, false);
  },
  /**
   * Hide the toast container.
   *
   * @since 1.0.0
   */
  hideContainer: function hideContainer() {
    setTimeout(function () {
      if (false === hatfw.toaster.container().hasChildNodes()) {
        hatfw.toaster.container().remove();
      }
    }, 1000);
  },
  /**
   * Return the close button compnent element.
   *
   * @since 1.0.0
   *
   * @return {HTMLElement} The close button element.
   */
  closeButton: function closeButton() {
    return "\n\t\t\t<button class=\"hatfw__close-btn hatfw-flex-c\" title=\"Close\" aria-label=\"Close\">\n\t\t\t\t<svg class=\"hatfw__close-btn__svg\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"></line><line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"></line></svg>\n\t\t\t</button>\n\t\t";
  },
  /**
   * Returns the new created toast component element.
   *
   * @param {Object} params         Contains the necessary parameters in rendering toast component.
   * @param {string} params.title   Contains the title of the toast.
   * @param {string} params.message Contains the message of the toast.
   * @return {HTMLElement}  The alert toaster component.
   */
  alertToast: function alertToast(params) {
    var messageToast = document.createElement('div');
    messageToast.className = 'hatfw';
    messageToast.innerHTML = "\n        <div class=\"hatfw__alert\">\n            <div class=\"hatfw__detail\">\n                <div class=\"hatfw__head\">\n                    <div class=\"hatfw-flex hatfw-flex-ai-c\">\n                        <div class=\"hatfw__status hatfw__status--".concat(params.color, "\"></div>\n                        <strong class=\"hatfw__title\">").concat(params.title, "</strong>\n                    </div>\n                    ").concat(this.closeButton(), "\n                </div>\n                <div class=\"hatfw__body\">\n                    <p class=\"hatfw__p\">").concat(params.content, "</p>\n                </div>\n            </div>\n        </div>");
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
  productToast: function productToast(params) {
    var productToast = document.createElement('div');
    productToast.className = 'hatfw';
    productToast.innerHTML = "\n        <div class=\"hatfw__product\">\n            <div class=\"hatfw-flex\">\n                <div class=\"hatfw__product__col-left\">\n                    <img class=\"hatfw__img\" src=\"".concat(params.image, "\">\n                </div>\n                <div class=\"hatfw__product__col-right\">\n                    <div class=\"hatfw__detail\">\n                        <div class=\"hatfw__head\">\n                            <strong class=\"hatfw__title\">").concat(params.title, "</strong>\n                            ").concat(this.closeButton(), "\n                        </div>\n                        <div class=\"hatfw__body\">\n                            <p class=\"hatfw__p\">").concat(params.content, "</p>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>");
    return productToast;
  },
  /**
   * Render and append toast container in the main body element.
   *
   * @since 1.0.0
   *
   * @return {HTMLElement}  The toaster main container.
   */
  container: function container() {
    var toastContainer = document.getElementById('hatfw-container');
    if (!toastContainer) {
      var container = document.createElement('div');
      container.setAttribute('id', 'hatfw-container');
      document.body.appendChild(container);
      toastContainer = container;
    }
    return toastContainer;
  }
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
  init: function init() {
    this.promptProductToaster();
  },
  /**
   * Show the product toaster after has been successfully added to the cart.
   *
   * @since 1.0.0
   */
  promptProductToaster: function promptProductToaster() {
    // eslint-disable-next-line no-undef
    if (!hatfwLocal.plugin.isHAFWActive) {
      jQuery('body').on('added_to_cart', function (event, fragments) {
        if (Object.keys(fragments).includes('hatfw_product')) {
          var product = JSON.parse(fragments.hatfw_product);
          // eslint-disable-next-line no-undef
          handyToasterNotifier.show({
            type: 'product',
            title: 'Added To Cart',
            image: product.image,
            content: product.name
          });
        }
      });
    }
  }
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
   * @return {Function|void} The callback function.
   */
  execute: function execute(func) {
    if ('function' !== typeof func) {
      return;
    }
    if ('interactive' === document.readyState || 'complete' === document.readyState) {
      return func();
    }
    document.addEventListener('DOMContentLoaded', func, false);
  }
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hatfw.domReady.execute(function () {
  // Localize Toaster Notifier Events.
  window.handyToasterNotifier = hatfw.toaster;

  // Initialize Components.
  Object.entries(hatfw).forEach(function (fragment) {
    if ('init' in fragment[1]) {
      fragment[1].init();
    }
  });
});
/******/ })()
;
//# sourceMappingURL=hatfw-client.js.map