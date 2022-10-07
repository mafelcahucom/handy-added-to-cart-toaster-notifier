<?php
namespace HATFW\Inc;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Installer.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Installer {

    /**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Plugin Activation.
     *
     * @since 1.0.0
     */
	public static function activate() {
        flush_rewrite_rules();
        self::set_option_main_settings();

        // Set plugin version.
        update_option( '_hatfw_plugin_version', HQFW_PLUGIN_VERSION );
    }

    /**
     * Plugin Deactivation.
     *
     * @since 1.0.0
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Sets the default value of option _hatfw_main_settings.
     *
     * @since 1.0.0
     */
    private static function set_option_main_settings() {
        if ( get_option( '_hatfw_main_settings' ) ) {
            return;
        }

        $settings = [
        ];

        // Insert settings in wp_options table.
        update_option( '_hatfw_main_settings', $settings );
    }
}