<?php
namespace HATFW\Admin\Inc;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
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
     * @param mixed  $log  Contains the data to be log.
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
     * Returns the base url of admin dist folder.
     *
     * @since 1.0.0
     * 
     * @param  string  $file  Contains the target filename.
     * @return string
     */
    public static function get_asset_src( $file ) {
        return HATFW_PLUGIN_URL . 'assets/admin/dist/' . $file;
    }

    /**
     * Render admin view.
     *
     * @since 1.0.0
     * 
     * @param  string  $file  Contains the directory of target filename.
     * @param  array   $args  Contains the additional arguments.
     * @return HTMLElement
     */
    public static function render_view( $filename, $args = [] ) {
        $file = HATFW_PLUGIN_PATH . 'app/Views/admin/'. $filename .'.php';
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
     * @param  string  $type       Contains the type of icon.
     * @param  string  $classname  Contains the additional classname.
     * @return string
     */
    public static function get_icon( $type, $classname = '' ) {
        return Icon::get( $type, $classname );
    }

    /**
     * Checks if the current page have $_GET['page'] = 'hatfw'.
     *
     * @since 1.0.0
     * 
     * @return boolean
     */
    public static function is_correct_page() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'hatfw' );
    }

    /**
     * Checks if a certain admin menu is already exists.
     * Note only call this method inside "admin_menu" action.
     *
     * @since 1.0.0
     * 
     * @param  string  $menu_name  Contains the slug of the menu.
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
     * Returns the additional attribtutes of a html tag.
     *
     * @since 1.0.0
     * 
     * @param  array  $attributes  Contains the additional attributes.
     * @return string
     */
    public static function get_attributes( $attributes = [] ) {
        if ( empty( $attributes ) ) {
            return;
        }

        $output = '';
        foreach( $attributes as $key => $value ) {
            $output .= esc_attr( $key ) .'="'. esc_attr( $value ) .'" ';
        }

        return $output;
    }

    /**
     * Converts RGBA Color format to Hex.
     *
     * @since 1.0.0
     * 
     * @param  string  $rgba_color  Contains the rgba color string.
     * @return string
     */
    public static function convert_rgba_to_hexa( $rgba_color ) {
        $first_replacement  = str_replace( 'rgba', '', $rgba_color );
        $second_replacement = str_replace( '(', '', $first_replacement );
        $third_replacement  = str_replace( ')', '', $second_replacement );
        $rgba               = explode( ',', $third_replacement );
        $hex_color          = sprintf( "#%02x%02x%02x%02x", $rgba[0], $rgba[1], $rgba[2], $rgba[3] );

        return $hex_color;
    }


    /**
     * Return the encrypted string.
     *
     * @since 1.0.0
     *
     * @param  string  $data  Contains the string to be encrypted.
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
     * @param  string  $encrypted_data  Contains the encrypted string to be encrypted.
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
     * @param  string  $type  Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_font_weight_choices( $type = '' ) {
        $choices = [
            [
                'value' => '100',
                'label' => '100'
            ],
            [
                'value' => '200',
                'label' => '200'
            ],
            [
                'value' => '300',
                'label' => '300'
            ],
            [
                'value' => '400',
                'label' => '400'
            ],
            [
                'value' => '500',
                'label' => '500'
            ],
            [
                'value' => '600',
                'label' => '600'
            ],
            [
                'value' => '700',
                'label' => '700'
            ],
            [
                'value' => '800',
                'label' => '800'
            ],
            [
                'value' => '900',
                'label' => '900'
            ]
        ];

        $output = $choices;
        if ( in_array( $type, [ 'value', 'label' ] ) ) {
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
     * @param  string  $type  Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_border_style_choices( $type = '' ) {
        $choices = [
            [
                'value' => 'dotted',
                'label' => 'Dotted'
            ],
            [
                'value' => 'dashed',
                'label' => 'Dashed'
            ],
            [
                'value' => 'solid',
                'label' => 'Solid'
            ],
            [
                'value' => 'double',
                'label' => 'Double'
            ],
            [
                'value' => 'groove',
                'label' => 'Groove'
            ],
            [
                'value' => 'ridge',
                'label' => 'Ridge'
            ],
            [
                'value' => 'inset',
                'label' => 'Inset'
            ],
            [
                'value' => 'outset',
                'label' => 'Outset'
            ],
            [
                'value' => 'none',
                'label' => 'None'
            ],
            [
                'value' => 'hidden',
                'label' => 'Hidden'
            ]
        ];

        $output = $choices;
        if ( in_array( $type, [ 'value', 'label' ] ) ) {
            $output = array_map( function( $choice ) use ( $type ) {
                return $choice[ $type ];
            }, $choices );
        }

        return $output;
    }

    /**
     * Return the client icon details.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_client_icon_names() {
        return [
            'bs-box-one-outline','bs-box-one-fill','bs-collection-outline',
            'bs-collection-fill','bs-plus','bs-plus-circle-outline','bs-plus-circle-fill',
            'bs-plus-square-outline','bs-plus-square-fill','bs-check','bs-check-all',
            'bs-cart-outline','bs-cart-fill','bs-cart-check-outline','bs-cart-check-fill',
            'bs-cart-plus-outline', 'bs-cart-plus-fill','he-cart-outline','he-cart-fill','bs-bag-outline',
            'bs-bag-fill','bs-bag-check-outline','bs-bag-check-fill','bs-bag-plus-outline',
            'bs-bag-plus-fill','he-bag-outline','he-bag-fill','bs-basket-one-outline',
            'bs-basket-one-fill','bs-basket-two-outline','bs-basket-two-fill','bs-basket-three-outline',
            'bs-basket-three-fill','bs-check-circle-outline','bs-check-circle-fill','bs-check-square-outline',
            'bs-check-square-fill','bs-link-one','bs-link-two','bs-link-three',
        ];
    }
}