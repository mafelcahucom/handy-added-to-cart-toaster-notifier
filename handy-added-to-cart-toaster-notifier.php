<?php
/**
 * Plugin Name:          Handy Added To Cart Toaster Notifier For WooCommerce
 * Description:          Handy Added To Cart Toaster Notifier is a WooCommerce plugin that lets store owners display sleek, real-time toaster popups, instantly notifying customers when a product is added to the cart enhancing clarity, engagement, and purchase confidence.
 * Author:               Mafel John Cahucom
 * Author URI:           https://www.facebook.com/mafeljohn.cahucom
 * Version:              1.0.0
 * Text Domain:          handy-added-to-cart-toaster-notifier
 * Domain Path:          /languages
 * Requires at least:    5.8
 * WC requires at least: 5.0.0
 * License:              GPLv2 or later
 */

defined( 'ABSPATH' ) || exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if ( ! defined( 'HATFW_PLUGIN_VERSION' ) ) {
    define( 'HATFW_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'HATFW_PLUGIN_BASENAME' ) ) {
    define( 'HATFW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'HATFW_PLUGIN_URL' ) ) {
    define( 'HATFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'HATFW_PLUGIN_PATH' ) ) {
    define( 'HATFW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( class_exists( 'HATFW\\Inc\\Installer' ) ) {
    register_activation_hook( __FILE__, array( 'HATFW\\Inc\\Installer', 'activate' ) );

    register_deactivation_hook( __FILE__, array( 'HATFW\\Inc\\Installer', 'deactivate' ) );
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
    if ( class_exists( 'HATFW\\Init' ) ) {
        HATFW\Init::get_instance();
    }
} else {
    printf(
        '<div class="notice notice-error is-dismissible"><p>%s</p></div>',
        'Handy Added To Cart Toaster Notifier for WooCommerce requires WooCommerce Plugin to be activated. Please install WooCommerce to continue.'
    );
}
