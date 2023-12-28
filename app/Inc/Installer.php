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
     * Plugin Activation.
     *
     * @since 1.0.0
     */
	public static function activate() {
        flush_rewrite_rules();
        self::set_option_main_settings();

        // Set plugin version.
        update_option( '_hatfw_plugin_version', HATFW_PLUGIN_VERSION );
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
    public static function set_option_main_settings() {
        if ( get_option( '_hatfw_main_settings' ) ) {
            return;
        }

        $settings = [

            // gn.
            'gn_enable'                     => 1,
            'gn_enable_auto_hide'           => 1,
            'gn_duration'                   => 5000,
            'gn_position'                   => 'bottom-right',
            'gn_status_success_clr'         => 'rgba(40,167,69,1)',
            'gn_status_error_clr'           => 'rgba(248,57,57,1)',

            // ts_panel.
            'ts_panel_mx_wd'                => '320px',
            'ts_panel_br'                   => '8px',

            // ts_head.
            'ts_head_bg_clr'                => 'rgba(255,255,255,1)',
            'ts_head_pt'                    => '10px',
            'ts_head_pb'                    => '10px',
            'ts_head_pl'                    => '10px',
            'ts_head_pr'                    => '10px',
            'ts_head_bs'                    => 'solid',
            'ts_head_bw'                    => '1px',
            'ts_head_b_clr'                 => 'rgba(228,230,236,1)',

            // ts_body.
            'ts_body_bg_clr'                => 'rgba(255,255,255,1)',
            'ts_body_pt'                    => '10px',
            'ts_body_pb'                    => '10px',
            'ts_body_pl'                    => '10px',
            'ts_body_pr'                    => '10px',

            // ts_status.
            'ts_status_wd'                  => '20px',
            'ts_status_ht'                  => '20px',
            'ts_status_bs'                  => 'none',
            'ts_status_bw'                  => '1px',
            'ts_status_b_clr'               => 'rgba(0,0,0,0)',
            'ts_status_br'                  => '100px',

            // ts_img.
            'ts_img_wd'                     => '120px',
            'ts_img_ht'                     => 'auto',

            // ts_title.
            'ts_title_fs'                   => '14px',
            'ts_title_fw'                   => '600',
            'ts_title_ln'                   => '16.8px',
            'ts_title_clr'                  => 'rgba(5,5,6,1)',

            // ts_content.
            'ts_content_fs'                 => '14px',
            'ts_content_fw'                 => '500',
            'ts_content_ln'                 => '20px',
            'ts_content_clr'                => 'rgba(96,103,113,1)',

            // ts_close_btn.
            'ts_close_btn_wd'               => '30px', 
            'ts_close_btn_ht'               => '30px',
            'ts_close_btn_icon_wd'          => '14px',
            'ts_close_btn_icon_ht'          => '14px',
            'ts_close_btn_icon_clr'         => 'rgba(5,5,6,1)',
            'ts_close_btn_icon_hv_clr'      => 'rgba(5,5,6,1)',
            'ts_close_btn_bg_clr'           => 'rgba(228,230,236,1)',
            'ts_close_btn_bg_hv_clr'        => 'rgba(214,216,220,1)',
            'ts_close_btn_bs'               => 'none',
            'ts_close_btn_bw'               => '0px',
            'ts_close_btn_b_clr'            => 'rgba(0,0,0,0)',
            'ts_close_btn_hv_b_clr'         => 'rgba(0,0,0,0)',
            'ts_close_btn_br'               => '100px',

            // ad_add.
            'ad_add_custom_css'             => '',

            // ad_opt.
            'ad_opt_enable_cache'           => 1,
            'ad_opt_enable_minify'          => 1,
            'ad_opt_enable_defer'           => 1,
        ];

        // Insert settings in wp_options table.
        update_option( '_hatfw_main_settings', $settings );
    }
}