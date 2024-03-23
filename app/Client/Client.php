<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;
use HATFW\Client\Filters;
use HATFW\Client\Actions;
use HATFW\Client\Style;

defined( 'ABSPATH' ) || exit;

/**
 * Client.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Client {

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
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        if ( Helper::plugin_has_error() ) {
            return;
        }

        $this->settings = get_option( '_hatfw_main_settings' );
        if ( $this->settings['gn_enable'] == false ) {
            return;
        }

        if ( ! is_admin() ) {
            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        }

        self::register_classes();
    }

    /**
     * Returns all the class services.
     *
     * @return array  List of classes
     */
    private static function get_classes() {
        return [
            Filters::class,
            Actions::class,
            Style::class,
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
     * @param  class  $class  Contains the class from self::get_classes().
     * @return class
     */
    private static function instantiate( $class ) {
        $class::get_instance();
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     */
    public function register_scripts() {
        $dependency = [ 'jquery' ];
        $source     = Helper::get_asset_src( 'js/hatfw-client.min.js' );
        $version    = Helper::get_asset_version( 'js/hatfw-client.min.js' );
        wp_register_script( 'hatfw-client', $source, $dependency, $version, true );
        wp_enqueue_script( 'hatfw-client' );

        wp_localize_script( 'hatfw-client', 'hatfwLocal', [
            'api'    => 'HNJOELMAFUCOHACM',
            'url'    => admin_url( 'admin-ajax.php' ),
            'plugin' => [
                'isHAFWActive' => Plugins::is_active( 'handy-add-to-cart' )
            ],
            'setting' => [
                'isAutoHide' => $this->settings['gn_enable_auto_hide'],
                'duration'   => $this->settings['gn_duration'],
                'maxWidth'   => $this->settings['ts_panel_mx_wd']
            ]
        ]);
    }
}
