<?php
/**
 * Plugin Name:   	  Handy Added To Cart Toaster Notifier For WooCommerce
 * Description:   	  Handy Added To Cart Toaster Notifier will let you add a toaster popup notifier in order to inform the customer after the product has been successfully added to the cart.
 * Author:        	  Mafel John Cahucom
 * Author URI:    	  https://www.facebook.com/mafeljohn.cahucom
 * Version:       	  1.0.0
 * Text Domain:   	  handy-added-to-cart-toaster-notifier
 * Domain Path: 	  /languages
 * Requires WP:   	  3.0
 * License: GPLv2 or later
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the autoloader.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define plugin domain.
if ( ! defined( 'HATFW_PLUGIN_DOMAIN' ) ) {
    define( 'HATFW_PLUGIN_DOMAIN', 'handy-added-to-cart-toaster-notifier' );
}

// Define plugin version.
if ( ! defined( 'HATFW_PLUGIN_VERSION' ) ) {
    define( 'HATFW_PLUGIN_VERSION', '1.0.0' );
}

// Define plugin basename.
if ( ! defined( 'HATFW_PLUGIN_BASENAME' ) ) {
    define( 'HATFW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

// Define plugin url.
if ( ! defined( 'HATFW_PLUGIN_URL' ) ) {
    define( 'HATFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Define plugin path.
if ( ! defined( 'HATFW_PLUGIN_PATH' ) ) {
    define( 'HATFW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

// Installer.
if ( class_exists( 'HATFW\\Inc\\Installer' ) ) {
    // Plugin Activation.
    register_activation_hook( __FILE__, [ 'HATFW\\Inc\\Installer', 'activate' ] );

    // Plugin Deactivation.
    register_deactivation_hook( __FILE__, [ 'HATFW\\Inc\\Installer', 'deactivate' ] );
}

// Check if WooCommerce Plugin is installed.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Initialize Plugin.
    if ( class_exists( 'HATFW\\Init' ) ) {
        HATFW\Init::get_instance();
    }
} else {
    add_action( 'admin_notices', function() {
        $output = '';
        $output .= '<div class="notice notice-error is-dismissible">';
        $output .= '<p>Handy Added To Cart Toaster Notifier for WooCommerce requires WooCommerce Plugin to be activated. Please install WooCommerce to continue.</p>';
        $output .= '</div>';
        echo $output;
    });
}