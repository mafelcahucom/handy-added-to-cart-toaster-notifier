<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;
use HATFW\Client\Actions;
use HATFW\Client\Events;
use HATFW\Client\Style;

defined( 'ABSPATH' ) || exit;

/**
 * Client.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Client {

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
        // Check if plugin has error.
        if ( Helper::plugin_has_error() ) {
            return;
        }

        if ( ! is_admin() ) {
            // Enqueue styles and scripts.
            add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        }

        // Register all classes.
        self::register_classes();
    }


    /**
     * Returns all the class services.
     *
     * @return array  List of classes
     */
    private static function get_classes() {
        return [
            Actions::class,
            Events::class,
            Style::class
        ];
    }

    /**
     * Loop through the services classes and instantiate each class.
     *
     * @since 1.0.0
     */
    private static function register_classes() {
        foreach ( self::get_classes() as $class ) {
            if ( method_exists( $class, 'get_instance' ) ) {
                self::instantiate( $class );
            }
        }
    }

    /**
     * Instantiate the given service class.
     *
     * @since 1.0.0
     *
     * @param  class  $class  Containing a class from self::get_classes().
     * @return class
     */
    private static function instantiate( $class ) {
        $class::get_instance();
    }

     /**
     * Register all styles.
     *
     * @since 1.0.0
     */
    public function register_styles() {
        if ( ! wp_style_is( 'handy-toaster-css' ) ) {
            wp_register_style( 'handy-toaster-css', Helper::get_asset_src( 'css/handy-toaster.min.css' ), [], '1.0.0', 'all' );
            wp_enqueue_style( 'handy-toaster-css' );
        }
    }

    /**
     * Register all scripts.
     *
     * @since 1..0.0
     */
    public function register_scripts() {
        // Settings.
        $settings = get_option( '_hatfw_main_settings' );

        // Toaster.
        if ( ! wp_script_is( 'handy-toaster-js' ) ) {
            wp_register_script( 'handy-toaster-js', Helper::get_asset_src( 'js/handy-toaster.min.js' ), [], '1.0.0', true );
            wp_enqueue_script( 'handy-toaster-js' );
        }

        // Client dependency.
        $client_dependency = [ 'jquery' ];

        // Client js.
        wp_register_script( 'hatfw-client-js', Helper::get_asset_src( 'js/hatfw-client.min.js' ), $client_dependency, '1.0.0', true );
        wp_enqueue_script( 'hatfw-client-js' );

        // Localize variables.
        wp_localize_script( 'hatfw-client-js', 'hatfwLocal', [
            'crafter' => 'Y35qwbAlyt+y60cldwAatUDyxikpRb30wBPT9Y1Xymk=',
            'url'     => admin_url( 'admin-ajax.php' ),
            'toaster' => [
                'isUseToaster' => 1,
                'duration'     => 3000
            ],
            'nonce'   => [
            ]
        ]);
    }
}
