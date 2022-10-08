<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Actions.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Actions {

	/**
	 * Inherit Singleton.
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
     * Execute Actions.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Adding timestamp in cart item.
        if ( ! Plugins::is_active( 'handy-add-to-cart' ) ) {
            add_action( 'woocommerce_add_to_cart', [ $this, 'add_cart_item_timestamp' ], 10 );
        }
    }


    /**
     * Adding timestamp in each cart during adding to cart. Note
     * the timestamp will be use to determine the latest added
     * product in the cart.
     *
     * @since 1.0.0
     * 
     * @param string  $cart_id  ID of the item in the cart.
     */
    public function add_cart_item_timestamp( $cart_id ) {
        WC()->cart->cart_contents[ $cart_id ]['hatfw_timestamp'] = time();
    }
}