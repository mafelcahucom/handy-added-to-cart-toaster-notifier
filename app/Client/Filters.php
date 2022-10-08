<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Filters.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Filters {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Execute Filters.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Additional fragments.
        if ( ! Plugins::is_active( 'handy-add-to-cart' ) ) {
            add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'wc_additional_fragments' ] );
        }
    }

    /**
     * Adding additional cart fragments in to woocommerce fragments.
     *
     * @since 1.0.0
     * 
     * @param  array  $fragments  Contains all the current fragments.
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