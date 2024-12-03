<?php
/**
 * App > Client > Style.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Style` class contains the dynamic or inline
 * styles or css in the client side or front-end.
 *
 * @since 1.0.0
 */
final class Style {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

	/**
     * Print internal css in wp_head.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Print custom internal css in <head>.
         */
        add_action( 'wp_head', array( $this, 'custom_internal_css' ), 100 );
    }

    /**
     * Return the validated property values.
     *
     * @since 1.0.0
     *
     * @param  array  $settings Contains the all the settings from _hatfw_main_settings.
     * @param  array  $rules    Contains the rule of the property key & default value.
     * @param  string $prefix   Contains the prefix of the class name.
     * @return string
     */
    private function get_properties( $settings, $rules, $prefix ) {
        if ( empty( $settings ) || empty( $rules ) || empty( $prefix ) ) {
            return;
        }

        $output = '';
        foreach ( $rules as $key => $default ) {
            $index   = $prefix . '_' . $key;
            $output .= ' ' . ( isset( $settings[ $index ] ) ? $settings[ $index ] : $default );
        }

        return $output;
    }

    /**
     * Return property values of padding in single line.
     *
     * @since 1.0.0
     *
     * @param  array  $settings Contains the all the settings from _hatfw_main_settings.
     * @param  string $prefix   Contains the prefix of the class name.
     * @return string
     */
    private function get_padding( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = array(
            'pt' => '0px',
            'pr' => '0px',
            'pb' => '0px',
            'pl' => '0px',
        );

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of margin in single line.
     *
     * @since 1.0.0
     *
     * @param  array  $settings Contains the all the settings from _hatfw_main_settings.
     * @param  string $prefix   Contains the prefix of the class name.
     * @return string
     */
    private function get_margin( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = array(
            'mt' => '0px',
            'mr' => '0px',
            'mb' => '0px',
            'ml' => '0px',
        );

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of border in single line.
     *
     * @since 1.0.0
     *
     * @param  array  $settings Contains the all the settings from _hatfw_main_settings.
     * @param  string $prefix   Contains the prefix of the class name.
     * @return string
     */
    private function get_border( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = array(
            'bw'    => '0px',
            'bs'    => 'none',
            'b_clr' => '#000000',
        );

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Minify the internal css.
     *
     * @since 1.0.0
     *
     * @param  string $css Contains the internal css to be minify.
     * @return string
     */
    private function minify_css( $css ) {
        $css = preg_replace( '/\s+/', ' ', $css );
        $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
        $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        return trim( $css );
    }

    /**
     * Custom Internal Css.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function custom_internal_css() {
        $settings = get_option( '_hatfw_main_settings' );

        // Top Left.
        if ( $settings['gn_position'] == 'top-left' ) {
            $class = "
                @keyframes hatfw-fade-in-top {
                    0% {
                        -webkit-transform: translateY(-50px);
                        transform: translateY(-50px);
                        opacity: 0;
                    }
                    100% {
                        -webkit-transform: translateY(0);
                        transform: translateY(0);
                        opacity: 1;
                    }
                }
                @keyframes hatfw-fade-out-left {
                    0% {
                        -webkit-transform: translateX(0);
                        transform: translateX(0);
                        opacity: 1;
                    }
                    100% {
                        -webkit-transform: translateX(-50px);
                        transform: translateX(-50px);
                    opacity: 0;
                    }
                }
                .hatfw[data-visibility='visible'] {
                    -webkit-animation: hatfw-fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                    animation: hatfw-fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                }
                .hatfw[data-visibility='hidden'] {
                    -webkit-animation: hatfw-fade-out-left 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                    animation: hatfw-fade-out-left 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                }
                #hatfw-container {
                    position: fixed;
                    z-index: 99999999;
                    top: 5%;
                    left: 3%;
                }
            ";
        }

        // Top Right.
        if ( $settings['gn_position'] == 'top-right' ) {
            $class = "
                @keyframes hatfw-fade-in-top {
                    0% {
                        -webkit-transform: translateY(-50px);
                        transform: translateY(-50px);
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
                .hatfw[data-visibility='visible'] {
                    -webkit-animation: hatfw-fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                    animation: hatfw-fade-in-top 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                }
                .hatfw[data-visibility='hidden'] {
                    -webkit-animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
                    animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
                }
                #hatfw-container {
                    position: fixed;
                    z-index: 99999999;
                    top: 5%;
                    right: 3%;
                }
            ";
        }

        // Bottom Left.
        if ( $settings['gn_position'] == 'bottom-left' ) {
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
                @keyframes hatfw-fade-out-left {
                    0% {
                        -webkit-transform: translateX(0);
                        transform: translateX(0);
                        opacity: 1;
                    }
                    100% {
                        -webkit-transform: translateX(-50px);
                        transform: translateX(-50px);
                    opacity: 0;
                    }
                }
                .hatfw[data-visibility='visible'] {
                    -webkit-animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
                    animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
                }
                .hatfw[data-visibility='hidden'] {
                    -webkit-animation: hatfw-fade-out-left 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                    animation: hatfw-fade-out-left 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                }
                #hatfw-container {
                    position: fixed;
                    z-index: 99999999;
                    bottom: 5%;
                    left: 3%;
                }
            ";
        }

        // Bottom Right.
        if ( $settings['gn_position'] == 'bottom-right' ) {
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
                .hatfw[data-visibility='visible'] {
                    -webkit-animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
                    animation: hatfw-fade-in-bottom 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both;
                }
                .hatfw[data-visibility='hidden'] {
                    -webkit-animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
                    animation: hatfw-fade-out-right 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
                }
                #hatfw-container {
                    position: fixed;
                    z-index: 99999999;
                    bottom: 5%;
                    right: 3%;
                }
            ";
        }

        // Toaster.
        $class .= "
            .hatfw {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 10px;
                width: {$settings['ts_panel_mx_wd']};
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 5px;
                -webkit-box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
                box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(10px);
                border-radius: {$settings['ts_panel_br']};
                opacity: 0;
                z-index: 99999999;
            }
            .hatfw-flex {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex
            }
            .hatfw-flex-c {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
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
                background-color: {$settings['ts_head_bg_clr']};
                padding: {$this->get_padding( $settings, 'ts_head' )};
                border-bottom: {$this->get_border( $settings, 'ts_head' )};
                border-top-right-radius: {$settings['ts_panel_br']};
            }
            .hatfw__title {
                display: inline-block;
                color: {$settings['ts_title_clr']};
                font-size: {$settings['ts_title_fs']};
                font-weight: {$settings['ts_title_fw']};
                line-height: {$settings['ts_title_ln']};
                letter-spacing: 0.5px;
            }
            .hatfw__status {
                margin-right: 10px;
                width: {$settings['ts_status_wd']};
                height: {$settings['ts_status_ht']};
                border: {$this->get_border( $settings, 'ts_status' )};
                border-radius: {$settings['ts_status_br']};
                
            }
            .hatfw__status--success {
                background-color: {$settings['gn_status_success_clr']};
            }
            .hatfw__status--danger {
                background-color: {$settings['gn_status_error_clr']};
            }
            .hatfw__close-btn {
                cursor: pointer;
                padding: 0;
                width: {$settings['ts_close_btn_wd']};
                height: {$settings['ts_close_btn_ht']};
                fill: {$settings['ts_close_btn_icon_clr']};
                background-color: {$settings['ts_close_btn_bg_clr']};
                border: {$this->get_border( $settings, 'ts_close_btn' )};
                border-radius: {$settings['ts_close_btn_br']};
            }
            .hatfw__close-btn:hover,
            .hatfw__close-btn:focus {
                fill: {$settings['ts_close_btn_icon_hv_clr']};
                background-color: {$settings['ts_close_btn_bg_hv_clr']};
                border-color: {$settings['ts_close_btn_hv_b_clr']};
                -webkit-transition: all 320ms ease-in-out 0s;
                -o-transition: all 320ms ease-in-out 0s;
                transition: all 320ms ease-in-out 0s;
            }
            .hatfw__close-btn__svg {
                width: {$settings['ts_close_btn_icon_wd']};
                height: {$settings['ts_close_btn_icon_ht']};
            }
            .hatfw__body {
                background-color: {$settings['ts_body_bg_clr']};
                padding: {$this->get_padding( $settings, 'ts_body' )};
                border-bottom: {$this->get_border( $settings, 'ts_body' )};
                border-bottom-right-radius: {$settings['ts_panel_br']};
            }
            .hatfw__alert .hatfw__head {
                border-top-left-radius: {$settings['ts_panel_br']};
            }
            .hatfw__alert .hatfw__body {
                border-bottom-left-radius: {$settings['ts_panel_br']};
            }
            .hatfw__p {
                margin: 0;
                color: {$settings['ts_content_clr']};
                font-size: {$settings['ts_content_fs']};
                font-weight: {$settings['ts_content_fw']};
                line-height: {$settings['ts_content_ln']};
                letter-spacing: 0.5px;
            }
            .hatfw__product__col-left {
                position: relative;
                width: {$settings['ts_img_wd']};
                height: {$settings['ts_img_ht']};
                border-top-left-radius: {$settings['ts_panel_br']};
                border-bottom-left-radius: {$settings['ts_panel_br']};
                overflow: hidden;
            }
            .hatfw__product__col-right {
                width: 100%;
            }
            .hatfw__img {
                width: 100%;
                display: block;
                position: absolute;
                min-width: 120px;
                height: auto;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        ";

        // Additional CSS.
        if ( ! empty( $settings['ad_add_custom_css'] ) ) {
            $class .= $settings['ad_add_custom_css'];
        }

        // Print Style.
        $style = sprintf( '<style id="hatfw-internal-style">%s</style>', $class );
        if ( $settings['ad_opt_enable_minify'] ) {
            $style = $this->minify_css( $style );
        }

        echo $style;
    }
}
