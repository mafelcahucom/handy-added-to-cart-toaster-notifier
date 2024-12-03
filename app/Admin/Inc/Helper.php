<?php
/**
 * App > Admin > Inc > Helper.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-added-to-cart-toaster-notifier
 */

namespace HATFW\Admin\Inc;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * The `Helper` class contains all the helper methods
 * solely for admin side or back-end.
 *
 * @since 1.0.0
 */
final class Helper {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Logs data in debug.txt.
     *
     * @since 1.0.0
     *
     * @param  mixed $log Contains the data to be log.
     * @return void
     */
    public static function log( $log ) {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }

    /**
     * Return boolean whether the plugin has a missing
     * options "_hatfw_plugin_version" or "_hatfw_main_settings";
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function plugin_has_error() {
        return ( empty( get_option( '_hatfw_plugin_version' ) ) || empty( get_option( '_hatfw_main_settings' ) ) );
    }

    /**
     * Return the url root of the plugin.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function get_root_url() {
        return admin_url( 'admin.php?page=hatfw' );
    }

    /**
     * Return the base url of admin public asset folder.
     *
     * @since 1.0.0
     *
     * @param  string $file_path Contains the relative path with filename.
     * @return string
     */
    public static function get_public_src( $file_path = '' ) {
        return HATFW_PLUGIN_URL . 'public/admin/' . $file_path;
    }

    /**
     * Return the base url of admin resources asset folder.
     *
     * @since 1.0.0
     *
     * @param  string $file_path Contains the relative path with filename.
     * @return string
     */
    public static function get_resource_src( $file_path = '' ) {
        return HATFW_PLUGIN_URL . 'resources/admin/' . $file_path;
    }

    /**
     * Render admin view.
     *
     * @since 1.0.0
     *
     * @param  string $filename Contains the directory of target filename.
     * @param  array  $args     Contains the additional arguments.
     * @return string
     */
    public static function render_view( $filename, $args = array() ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
        $file = HATFW_PLUGIN_PATH . 'app/Views/admin/' . $filename . '.php';
        if ( ! file_exists( $file ) ) {
            return;
        }

        ob_start();
        require $file;
        return ob_get_clean();
    }

    /**
     * Returns the svg icon.
     *
     * @since 1.0.0
     *
     * @param  string $type      Contains the type of icon.
     * @param  string $classname Contains the additional classname.
     * @return string
     */
    public static function get_icon( $type, $classname = '' ) {
        return Icon::get( $type, $classname );
    }

    /**
     * Checks if the current page is the right parent menu.
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public static function is_correct_menu() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'handy-tools' );
    }

    /**
     * Checks if the current page is the right submenu.
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public static function is_correct_submenu() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'hatfw' );
    }

    /**
     * Checks if a certain admin menu is already exists.
     * Note only call this method inside "admin_menu" action.
     *
     * @since 1.0.0
     *
     * @param  string $menu_slug Contains the slug of the menu.
     * @return boolean
     */
    public static function is_menu_exists( $menu_slug = '' ) {
        global $menu;

        $output = false;
        if ( ! empty( $menu ) ) {
            foreach ( $menu as $value ) {
                if ( $menu_slug === $value[2] ) {
                    $output = true;
                }
            }
        }

        return $output;
    }

    /**
     * Return the formatted attributes.
     *
     * @since 1.0.0
     *
     * @param  array $attrs Contains the attributes to be formated.
     * @return string
     */
    public static function get_attributes( $attrs = array() ) {
        $attribute = '';
        if ( ! empty( $attrs ) ) {
            foreach ( $attrs as $key => $value ) {
                $attribute .= sprintf(
                    ' %s="%s"',
                    esc_attr( $key ),
                    esc_attr( $value )
                );
            }
        }

        return $attribute;
    }

    /**
     * Converts RGBA Color format to Hex.
     *
     * @since 1.0.0
     *
     * @param  string $rgba_color Contains the rgba color string.
     * @return string
     */
    public static function convert_rgba_to_hexa( $rgba_color ) {
        $first_replacement  = str_replace( 'rgba', '', $rgba_color );
        $second_replacement = str_replace( '(', '', $first_replacement );
        $third_replacement  = str_replace( ')', '', $second_replacement );
        $rgba               = explode( ',', $third_replacement );
        $hex_color          = sprintf( '#%02x%02x%02x%02x', $rgba[0], $rgba[1], $rgba[2], $rgba[3] );

        return $hex_color;
    }

    /**
     * Return the encrypted string.
     *
     * @since 1.0.0
     *
     * @param  string $data Contains the string to be encrypted.
     * @return string
     */
    public static function get_encrypted( $data = '' ) {
        if ( empty( $data ) ) {
            return;
        }

        $key = 'OvjwhgJt4JObdSDDanguMwB3Q3oAMt2gjr+JIojUz94=';
        return openssl_encrypt( $data, 'AES-128-ECB', $key );
    }

    /**
     * Return the decrypted string.
     *
     * @since 1.0.0
     *
     * @param  string $encrypted_data Contains the encrypted string to be encrypted.
     * @return string
     */
    public static function get_decrypted( $encrypted_data = '' ) {
        if ( empty( $encrypted_data ) ) {
            return;
        }

        $key = 'OvjwhgJt4JObdSDDanguMwB3Q3oAMt2gjr+JIojUz94=';
        return openssl_decrypt( $encrypted_data, 'AES-128-ECB', $key );
    }

    /**
     * Return the font weight choices.
     *
     * @since 1.0.0
     *
     * @param  string $type Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_font_weight_choices( $type = '' ) {
        $choices = array(
            array(
                'value' => '100',
                'label' => '100',
            ),
            array(
                'value' => '200',
                'label' => '200',
            ),
            array(
                'value' => '300',
                'label' => '300',
            ),
            array(
                'value' => '400',
                'label' => '400',
            ),
            array(
                'value' => '500',
                'label' => '500',
            ),
            array(
                'value' => '600',
                'label' => '600',
            ),
            array(
                'value' => '700',
                'label' => '700',
            ),
            array(
                'value' => '800',
                'label' => '800',
            ),
            array(
                'value' => '900',
                'label' => '900',
            ),
        );

        $output = $choices;
        if ( in_array( $type, array( 'value', 'label' ), true ) ) {
            $output = array_map( function( $choice ) use ( $type ) {
                return $choice[ $type ];
            }, $choices );
        }

        return $output;
    }

    /**
     * Return the border style choices.
     *
     * @since 1.0.0
     *
     * @param  string $type Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_border_style_choices( $type = '' ) {
        $choices = array(
            array(
                'value' => 'dotted',
                'label' => __( 'Dotted', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'dashed',
                'label' => __( 'Dashed', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'solid',
                'label' => __( 'Solid', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'double',
                'label' => __( 'Double', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'groove',
                'label' => __( 'Groove', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'ridge',
                'label' => __( 'Ridge', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'inset',
                'label' => __( 'Inset', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'outset',
                'label' => __( 'Outset', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'none',
                'label' => __( 'None', 'handy-added-to-cart-toaster-notifier' ),
            ),
            array(
                'value' => 'hidden',
                'label' => __( 'Hidden', 'handy-added-to-cart-toaster-notifier' ),
            ),
        );

        $output = $choices;
        if ( in_array( $type, array( 'value', 'label' ), true ) ) {
            $output = array_map( function( $choice ) use ( $type ) {
                return $choice[ $type ];
            }, $choices );
        }

        return $output;
    }
}
