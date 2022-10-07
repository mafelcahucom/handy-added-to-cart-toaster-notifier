<?php
namespace HATFW;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Admin;
use HATFW\Client\Client;

defined( 'ABSPATH' ) || exit;

/**
 * Initialize.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Init {

	/**
	 * Inherit Singleton.
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