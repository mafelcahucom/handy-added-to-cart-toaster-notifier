<?php
namespace HATFW\Api;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab > Setting API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class SettingApi {

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
     * Return the set of setting fields with each schema or rules. There
     * are 3 types of format to return the raw, schemas and fields.
     * 
     * @since 1.0.0
     *
     * @param  string  $type  Contains the format of data to be returned.
     * @return array
     */
    public static function get_settings( $type = 'raw' ) {
        $settings = [
            'GEN' => [
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
                ]
            ],
            'TOA' => [
                'ts_panel_mx_wd'                => [
                    'type'     => 'size',
                    'default'  => '320px'
                ],
                'ts_panel_br'                   => [
                    'type'     => 'size',
                    'default'  => '2px'
                ],
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
                    'default'  => 'rgba(232,232,235,1)'
                ],
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
                'ts_img_wd'                     => [
                    'type'     => 'size',
                    'default'  => '120px'
                ],
                'ts_img_ht'                     => [
                    'type'     => 'size',
                    'default'  => 'auto'
                ],
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
                    'default'  => 'rgba(17,14,39,1)'
                ],
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
                    'default'  => 'rgba(107,114,128,1)'
                ],
                'ts_close_btn_wd'               => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'ts_close_btn_ht'               => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'ts_close_btn_icon_wd'          => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'ts_close_btn_icon_ht'          => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'ts_close_btn_icon_clr'         => [
                    'type'     => 'color',
                    'default'  => 'rgba(44,51,56,1)'
                ],
                'ts_close_btn_icon_hv_clr'      => [
                    'type'     => 'color',
                    'default'  => 'rgba(20,27,56,1)'
                ],
                'ts_close_btn_bg_clr'           => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,0,0,0)'
                ],
                'ts_close_btn_bg_hv_clr'        => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,0,0,0)'
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
                    'default'  => '2px'
                ]
            ],
            'ADV' => [
                'ad_add_custom_css'             => [
                    'type'     => 'textarea',
                    'default'  => ''
                ],
                'ad_opt_enable_cache'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'ad_opt_enable_minify'          => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'ad_opt_enable_defer'           => [
                    'type'    => 'switch',
                    'default' => 1
                ]
            ]
        ];

        $output = $settings;
        if ( in_array( $type, [ 'schemas', 'fields' ] ) ) {
            $schemas = [];
            foreach ( $settings as $setting ) {
                $schemas = array_merge( $schemas, $setting );
            }

            $output = $schemas;

            if ( $type === 'fields' ) {
                $fields = [];
                foreach ( $schemas as $key => $schema ) {
                    $fields[ $key ] = $schema['default'];
                }

                $output = $fields;
            }
        }

        return $output;
    }

    /**
     * Return the settings from option _hatfw_main_settings but if option is
     * empty it will be get the default settings values.
     * 
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_current_settings() {
        $settings = get_option( '_hatfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = self::get_settings( 'fields' );
        }

        return $settings;
    }
}