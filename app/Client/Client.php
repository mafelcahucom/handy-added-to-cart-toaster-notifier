<?php
/**
 * App > Client > Client.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Traits\Instantiator;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;
use HATFW\Client\Filters;
use HATFW\Client\Actions;
use HATFW\Client\Style;

defined( 'ABSPATH' ) || exit;

/**
 * The `Client` class contains all the services and
 * settings that needs to be loaded in the client
 * side or front-end.
 *
 * @since 1.0.0
 */
final class Client {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Inherit Instantiator.
     *
     * @since 1.0.0
     */
    use Instantiator;

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
            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        }

        /**
         * Instantiate or load services.
         */
        self::instantiate(array(
            Filters::class,
            Actions::class,
            Style::class,
        ));
    }

    /**
     * Register defined scripts asset.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_scripts() {
        $asset                 = include HATFW_PLUGIN_PATH . 'public/client/scripts/hatfw-client.asset.php';
        $asset['src']          = Helper::get_public_src( 'scripts/hatfw-client.js' );
        $asset['dependencies'] = array( 'jquery' );
        wp_register_script( 'hatfw-client', $asset['src'], $asset['dependencies'], $asset['version'], true );
        wp_enqueue_script( 'hatfw-client' );

        wp_localize_script( 'hatfw-client', 'hatfwLocal', array(
            'api'    => 'HNJOELMAFUCOHACM',
            'url'    => admin_url( 'admin-ajax.php' ),
            'plugin' => array(
                'isHAFWActive' => Plugins::is_active( 'handy-add-to-cart' ),
            ),
            'setting' => array(
                'isAutoHide' => $this->settings['gn_enable_auto_hide'],
                'duration'   => $this->settings['gn_duration'],
                'maxWidth'   => $this->settings['ts_panel_mx_wd'],
            ),
        ));
    }
}
