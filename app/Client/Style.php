<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Client\Inc\Helper;
use HATFW\Client\Inc\Loader;

defined( 'ABSPATH' ) || exit;

/**
 * Style.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Style {

	/**
	 * Register Shortcodes.
	 */
	use Singleton;

	/**
     * Print inline css in wp_head.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        add_action( 'wp_head', [ $this, 'custom_inline_css' ], 100 );
    }

    /**
     * Return the validated property values.
     *
     * @since 1.0.0
     *
     * @param  array   $settings  Contains all the settings from _hatfw_main_settings.
     * @param  arrray  $rules     Contains the rule of the property key & default value.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_properties( $settings, $rules, $prefix ) {
        if ( empty( $settings ) || empty( $rules ) || empty( $prefix ) ) {
            return;
        }

        $output = '';
        foreach ( $rules as $key => $default ) {
            $index   = $prefix .'_'. $key;
            $output .= ' '. ( isset( $settings[ $index ] ) ? $settings[ $index ] : $default );
        }
        return $output;
    }

    /**
     * Return property values of padding in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hatfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_padding( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'pt' => '0px',
            'pr' => '0px',
            'pb' => '0px',
            'pl' => '0px'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of margin in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hatfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_margin( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'mt' => '0px',
            'mr' => '0px',
            'mb' => '0px',
            'ml' => '0px'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of border in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hatfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_border( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'bw'    => '0px',
            'bs'    => 'none',
            'b_clr' => '#000000'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Minify the internal css.
     *
     * @since 1.0.0
     * 
     * @param  string  $css  The internal css to be minify.
     * @return string
     */
    private function minify_internal_css( $css ) {
        $css = preg_replace( '/\s+/', ' ', $css );
        $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
        $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        return trim( $css );
    }

    /**
     * Custom Inline Css.
     *
     * @since 1.0.0
     * 
     * @return string
     */
    public function custom_inline_css() {
        $settings = get_option( '_hatfw_main_settings' );

        // Keyframes.
        $class = "
            @keyframes hatfw-fade-in-bottom {
                0% {
                    -webkit-transform: translateY(50px);
                    transform: translateY(50px);
                    opacity: 0;
                }
                100% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0);
                    opacity: 1;
                }
            }
            @keyframes hatfw-fade-out-right {
                0% {
                    -webkit-transform: translateX(0);
                    transform: translateX(0);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateX(50px);
                    transform: translateX(50px);
                    opacity: 0;
                }
            }
        ";

        // Toaster.
        $class .= "
            #hatfw-container {
                position: fixed;
                bottom: 5%;
                right: 3%;
                z-index: 999999;
            }
            .hatfw {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 10px;
                width: 300px;
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 5px;
                -webkit-box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
                box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(10px);
                opacity: 0;
                z-index: 999999;
            }
            .hatfw-flex {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex
            }
            .hatfw-flex-ai-c {
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .hatfw-flex-jc-sb {
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
            }
            .hatfw__head {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 10px 12px;
            }
            .hatfw__title {
                display: inline-block;
                color: #6c757d;
                font-size: 14px;
                line-height: 16.8px;
                letter-spacing: 0.5px;
            }
            .hatfw__status {
                width: 20px;
                height: 20px;
                border-radius: 100px;
                margin-right: 10px;
            }
            .hatfw__status--success {
                background-color: #28a745;
            }
            .hatfw__status--danger {
                background-color: #f83939;
            }
            .hatfw__close-btn {
                padding: 0;
                width: 20px;
                height: 20px;
                border: 0;
                fill: #6c757d;
                background: transparent;
                cursor: pointer;
            }
            .hatfw__close-btn:hover,
            .hatfw__close-btn:focus {
                fill: #000000;
                background: transparent;
                -webkit-transition: all 320ms ease-in-out 0s;
                -o-transition: all 320ms ease-in-out 0s;
                transition: all 320ms ease-in-out 0s;
            }
            .hatfw__close-btn__svg {
                width: 20px;
                height: 20px;
            }
            .hatfw__body {
                padding: 0 12px;
            }
            .hatfw__p {
                margin: 0;
                color: #212529;
                font-size: 14px;
                line-height: 20px;
                letter-spacing: 0.5px;
            }
            .hatfw__alert .hatfw__head {
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            .hatfw__alert .hatfw__body {
                padding: 12px;
            }
            .hatfw__product__col-left {
                width: 85px;
                background: #f5f5f5;
            }
            .hatfw__product__col-right {
                width: 100%;
            }
            .hatfw__img {
                width: 100%;
                display: block;
            }
            .hatfw[data-visibility='visible'] {
                -webkit-animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
                animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
            }
            .hatfw[data-visibility='hidden'] {
                -webkit-animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
                animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
            }
        ";

        $style    = '<style id="hatfw-internal-style">'. $class .'</style>';
        echo $this->minify_internal_css( $style );
    }
}