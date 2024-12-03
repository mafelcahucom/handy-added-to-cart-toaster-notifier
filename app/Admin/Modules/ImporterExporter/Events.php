<?php
/**
 * App > Admin > Modules > Importer Exporter > Events.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-added-to-cart-toaster-notifier
 */

namespace HATFW\Admin\Modules\ImporterExporter;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Traits\Security;
use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\FieldValidation;
use HATFW\Api\SettingApi;

defined( 'ABSPATH' ) || exit;

/**
 * The `Events` class contains all the AJAX events for
 * the importer exporter module.
 *
 * @since 1.0.0
 */
final class Events {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Inherit Security.
     *
     * @since 1.0.0
     */
    use Security;

    /**
     * Register ajax events.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Export setting.
         */
        add_action( 'wp_ajax_hatfw_export_settings', array( $this, 'export_settings' ) );

        /**
         * Import setting.
         */
        add_action( 'wp_ajax_hatfw_import_settings', array( $this, 'import_settings' ) );
    }

    /**
     * Download the encrypted settings.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function export_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error(array(
                'error' => 'SECURITY_ERROR',
            ));
        }

        if ( self::has_post_empty_data( $_POST, array( 'groups' ) ) ) {
            wp_send_json_error(array(
                'error' => 'MISSING_DATA_ERROR',
            ));
        }

        $groups = explode( ',', $_POST['groups'] );
        if ( empty( $groups ) ) {
            wp_send_json_error(array(
                'error' => 'MISSING_DATA_ERROR',
            ));
        }

        // Get the current settings.
        $settings = get_option( '_hatfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = SettingApi::get_settings( 'fields' );
        }

        // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
        if ( ! in_array( 'ALL', $groups ) ) {
            // Get field keys based on group.
            $raw_rules  = SettingApi::get_settings( 'raw' );
            $field_keys = array();
            foreach ( $groups as $group ) {
                if ( array_key_exists( $group, $raw_rules ) ) {
                    $field_keys = array_merge( $field_keys, array_keys( $raw_rules[ $group ] ) );
                }
            }

            // Get the setting field intersected with $field_keys.
            if ( ! empty( $field_keys ) ) {
                $intersected = array_intersect_key( $settings, array_flip( $field_keys ) );
                $settings    = $intersected;
            } else {
                $settings = array();
            }

            if ( empty( $settings ) ) {
                wp_send_json_error(array(
                    'error' => 'MISSING_DATA_ERROR',
                ));
            }
        }

        // Encrypt settings and export.
        $encrypted_settings = Helper::get_encrypted( json_encode( $settings ) );
        wp_send_json_success(array(
            'response' => 'SETTINGS_EXPORTED',
            'settings' => $encrypted_settings,
        ));
    }

    /**
     * Import the encrypted settings.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function import_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error(array(
                'error' => 'SECURITY_ERROR',
            ));
        }

        if ( self::has_post_empty_data( $_POST, array( 'settings' ) ) ) {
            wp_send_json_error(array(
                'error' => 'MISSING_DATA_ERROR',
            ));
        }

        // Decrypt the ecrypted settings.
        $decrypted_settings = Helper::get_decrypted( $_POST['settings'] );
        if ( $decrypted_settings === false ) {
            wp_send_json_error(array(
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => __( 'Failed to decrypt settings.', 'handy-added-to-cart-toaster-notifier' ),
            ));
        }

        // Decode the decrypted settings.
        $decoded_settings = json_decode( stripslashes( sanitize_text_field( $decrypted_settings ) ), true );
        if ( $decrypted_settings === null || json_last_error() !== JSON_ERROR_NONE ) {
            wp_send_json_error(array(
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => __( 'Failed to decode settings.', 'handy-added-to-cart-toaster-notifier' ),
            ));
        }

        // Get the fields that are existed in current settings.
        $field_rules      = SettingApi::get_settings( 'schemas' );
        $updated_settings = array_intersect_key( $decoded_settings, $field_rules );
        if ( count( $field_rules ) !== count( $updated_settings ) || empty( $updated_settings ) ) {
            wp_send_json_error(array(
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => __( 'Failed to decode settings.', 'handy-added-to-cart-toaster-notifier' ),
            ));
        }

        // Validate updated settings.
        $validation = FieldValidation::validate(array(
            'fields'        => $updated_settings,
            'current_value' => $updated_settings,
            'field_rules'   => $field_rules,
        ));

        if ( count( $validation['validation']['invalid'] ) > 0 ) {
            wp_send_json_error(array(
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => __( 'Settings failed in validation.', 'handy-added-to-cart-toaster-notifier' ),
            ));
        }

        // Merge current and updated settings and save in wp_options.
        $merged_settings = array_merge( SettingApi::get_current_settings(), $updated_settings );
        update_option( '_hatfw_main_settings', $merged_settings );
        wp_send_json_success(array(
            'response' => 'SUCCESSFULLY IMPORTED',
        ));
    }
}
