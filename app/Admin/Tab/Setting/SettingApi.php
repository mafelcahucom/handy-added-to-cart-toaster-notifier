<?php
namespace HATFW\Admin\Tab\Setting;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingApi {

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
     * Set of rules for setting fields. This can be use
     * for checking settings fields validity.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_field_rules() {
        $rules = [

            // gn.
            'gn_enable'                     => [
                'type'    => 'switch',
                'default' => 1
            ],
            'gn_enable_auto_hide'           => [
                'type'    => 'switch',
                'default' => 1
            ],
            'gn_duration'                   => [
                'type'     => 'number',
                'default'  => 5000
            ],
            'gn_position'                   => [
                'type'     => 'select',
                'default'  => 'bottom-right',
                'choices'  => [
                    'top-left', 'top-right',
                    'bottom-left', 'bottom-right'
                ]
            ],
            'gn_status_success_clr'         => [
                'type'     => 'color',
                'default'  => 'rgba(40,167,69,1)'
            ],
            'gn_status_error_clr'           => [
                'type'     => 'color',
                'default'  => 'rgba(248,57,57,1)'
            ],
            
            // ts_panel.
            'ts_panel_mx_wd'                => [
                'type'     => 'size',
                'default'  => '320px'
            ],
            'ts_panel_br'                   => [
                'type'     => 'size',
                'default'  => '8px'
            ],

            // ts_head.
            'ts_head_bg_clr'                => [
                'type'     => 'color',
                'default'  => 'rgba(255,255,255,1)'
            ],
            'ts_head_pt'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_head_pb'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_head_pl'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_head_pr'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_head_bs'                    => [
                'type'     => 'select',
                'default'  => 'solid',
                'choices'  => Helper::get_border_style_choices( 'value' )
            ],
            'ts_head_bw'                    => [
                'type'     => 'size',
                'default'  => '1px'
            ],
            'ts_head_b_clr'                 => [
                'type'     => 'color',
                'default'  => 'rgba(228,230,236,1)'
            ],

            // ts_body.
            'ts_body_bg_clr'                => [
                'type'     => 'color',
                'default'  => 'rgba(255,255,255,1)'
            ],
            'ts_body_pt'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_body_pb'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_body_pl'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'ts_body_pr'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // ts_status.
            'ts_status_wd'                  => [
                'type'     => 'size',
                'default'  => '20px'
            ],
            'ts_status_ht'                  => [
                'type'     => 'size',
                'default'  => '20px'
            ],
            'ts_status_bs'                  => [
                'type'     => 'select',
                'default'  => 'none',
                'choices'  => Helper::get_border_style_choices( 'value' )
            ],
            'ts_status_bw'                  => [
                'type'     => 'size',
                'default'  => '1px'
            ],
            'ts_status_b_clr'               => [
                'type'     => 'color',
                'default'  => 'rgba(0,0,0,0)'
            ],
            'ts_status_br'                  => [
                'type'     => 'size',
                'default'  => '100px'
            ],

            // ts_img.
            'ts_img_wd'                     => [
                'type'     => 'size',
                'default'  => '120px'
            ],
            'ts_img_ht'                     => [
                'type'     => 'size',
                'default'  => 'auto'
            ],

            // ts_title.
            'ts_title_fs'                   => [
                'type'     => 'size',
                'default'  => '14px'
            ],
            'ts_title_fw'                   => [
                'type'     => 'select',
                'default'  => '600',
                'choices'  => Helper::get_font_weight_choices( 'value' )
            ],
            'ts_title_ln'                   => [
                'type'     => 'size',
                'default'  => '16.8px'
            ],
            'ts_title_clr'                  => [
                'type'     => 'color',
                'default'  => 'rgba(5,5,6,1)'
            ],

            // ts_content.
            'ts_content_fs'                 => [
                'type'     => 'size',
                'default'  => '14px'
            ],
            'ts_content_fw'                 => [
                'type'     => 'select',
                'default'  => '500',
                'choices'  => Helper::get_font_weight_choices( 'value' )
            ],
            'ts_content_ln'                 => [
                'type'     => 'size',
                'default'  => '20px'
            ],
            'ts_content_clr'                => [
                'type'     => 'color',
                'default'  => 'rgba(96,103,113,1)'
            ],

            // ts_close_btn.
            'ts_close_btn_wd'               => [
                'type'     => 'size',
                'default'  => '30px'
            ],
            'ts_close_btn_ht'               => [
                'type'     => 'size',
                'default'  => '30px'
            ],
            'ts_close_btn_icon_wd'          => [
                'type'     => 'size',
                'default'  => '14px'
            ],
            'ts_close_btn_icon_ht'          => [
                'type'     => 'size',
                'default'  => '14px'
            ],
            'ts_close_btn_icon_clr'         => [
                'type'     => 'color',
                'default'  => 'rgba(5,5,6,1)'
            ],
            'ts_close_btn_icon_hv_clr'      => [
                'type'     => 'color',
                'default'  => 'rgba(5,5,6,1)'
            ],
            'ts_close_btn_bg_clr'           => [
                'type'     => 'color',
                'default'  => 'rgba(228,230,236,1)'
            ],
            'ts_close_btn_bg_hv_clr'        => [
                'type'     => 'color',
                'default'  => 'rgba(214,216,220,1)'
            ],
            'ts_close_btn_bs'               => [
                'type'     => 'select',
                'default'  => 'none',
                'choices'  => Helper::get_border_style_choices( 'value' )
            ],
            'ts_close_btn_bw'               => [
                'type'     => 'size',
                'default'  => '0px'
            ],
            'ts_close_btn_b_clr'            => [
                'type'     => 'color',
                'default'  => 'rgba(0,0,0,0)'
            ],
            'ts_close_btn_hv_b_clr'         => [
                'type'     => 'color',
                'default'  => 'rgba(0,0,0,0)'
            ],
            'ts_close_btn_br'               => [
                'type'     => 'size',
                'default'  => '100px'
            ],

            // ad_stg.
            'ad_stg_additional_css'          => [
                'type'     => 'textarea',
                'default'  => ''
            ]
        ];

        return $rules;
    }

    /**
     * Returns the default value of each fields based in get_field_rules().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_fields_default_values() {
        $fields = [];
        foreach ( self::get_field_rules() as $key => $value ) {
            $fields[ $key ] = $value['default'];
        }

        return $fields;
    }

    /**
     * Returns the settings value from _hatfw_main_settings but
     * if _hatfw_main_settings is empty it will get the default value
     * from self::get_fields_default_values().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_settings() {
        $settings = get_option( '_hatfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = self::get_fields_default_values();
        }

        return $settings;
    }

    /**
     * Check if the settings has a missing field.
     *
     * @since 1.0.0
     * 
     * @param  array  $settings  Containing all the settings field.
     * @return boolean
     */
    public static function has_missing_fields( $settings ) {
        if ( empty( $settings ) ) {
            return true;
        }

        $field_rules = self::get_field_rules();
        foreach ( $field_rules as $key => $value ) {
            if ( ! array_key_exists( $key, $settings ) ) {
                return true;
            }
        }
        return false;
    }
}