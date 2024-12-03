<?php
/**
 * App > Init.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-added-to-cart-toaster-notifier
 */

namespace HATFW;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Admin;
use HATFW\Client\Client;

defined( 'ABSPATH' ) || exit;

/**
 * The `Init` class will register or instantiate all available
 * services or classes of the plugin.
 *
 * @since 1.0.0
 */
final class Init {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {

        /**
         * Instantiate Admin.
         */
        if ( is_admin() ) {
            Admin::get_instance();
        }

        /**
         * Instantiate Client.
         */
        Client::get_instance();
    }
}
