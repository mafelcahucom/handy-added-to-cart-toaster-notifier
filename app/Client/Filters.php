<?php
/**
 * App > Client > Filters.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * The `Filters` class contains all the filter hooks that
 * will be loaded in the client side or front-end.
 *
 * @since 1.0.0
 */
final class Filters {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Holds the settings.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $settings;

	/**
     * Execute Filters.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Set the value of settings property.
         */
        $this->settings = get_option( '_hatfw_main_settings' );

        /**
         * Deffer main javascript.
         */
        if ( $this->settings['ad_opt_enable_defer'] ) {
            add_filter( 'script_loader_tag', array( $this, 'deffer_main_js' ), 10, 2 );
        }

        /**
         * Additional fragments.
         */
        if ( ! Plugins::is_active( 'handy-add-to-cart' ) ) {
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'wc_additional_fragments' ) );
        }
    }

    /**
     * Deffer the main javascript in front-end.
     *
     * @since 1.0.0
     *
     * @param  string $tag    Contains the <script> tag for the enqueued script.
     * @param  string $handle Contains the script's registered handle.
     * @return array
     */
    public function deffer_main_js( $tag, $handle ) {
        if ( $handle === 'hatfw-client' ) {
            return str_replace( ' src', ' defer="defer" src', $tag );
        }

        return $tag;
    }

    /**
     * Adding additional cart fragments in to woocommerce fragments.
     *
     * @since 1.0.0
     *
     * @param  array $fragments Contains all the current fragments.
     * @return array
     */
    public function wc_additional_fragments( $fragments ) {
        // Get the recently product added to the cart.
        $product = Helper::get_recently_added_product();
        if ( $product ) {
            $fragments['hatfw_product'] = json_encode( $product );
        }

        return $fragments;
    }
}
