<?php
/**
 * Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\Component;
use HATFW\Admin\Inc\Field;
use HATFW\Admin\Tab\Setting\SettingApi;

defined( 'ABSPATH' ) || exit;

// Get the setting current value.
$settings = SettingApi::get_settings();

/**
 * Header
 */
echo Component::get_header();

/**
 * Tab Navigation.
 */
echo Component::get_tab_navigation([
    'class' => 'hd-mb-30',
    'tabs'  => [
        [
            'title' => __( 'General', HATFW_PLUGIN_DOMAIN ),
            'panel' => '#general'
        ],
        [
            'title' => __( 'Toaster UI', HATFW_PLUGIN_DOMAIN ),
            'panel' => '#toaster-ui'
        ],
        [
            'title' => __( 'Advanced', HATFW_PLUGIN_DOMAIN ),
            'panel' => '#advanced'
        ]
    ]
]);

/**
 * General Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'general',
    'class'      => 'hd-mb-50',
    'state'      => 'active',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'General', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Toaster', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable'],
                            'description' => __( 'Enable this option to activate handy added to cart toaster notifier functionalities in the front-end.', HATFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HATFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HATFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Toaster', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Auto Hide', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_enable_auto_hide',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable_auto_hide'],
                            'description' => __( 'Enable this option to hide the toaster automatically.', HATFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HATFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HATFW_PLUGIN_DOMAIN )
                            ]
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Duration', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_number_field([
                            'name'  => 'gn_duration',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_duration'],
                            'placeholder' => __( 'Duration', HATFW_PLUGIN_DOMAIN ),
                            'description' => __( 'Set the total milliseconds before the toaster will automatically hide. Note this will only be applied if you enable auto hide.', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Position', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gn_position',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_position'],
                            'description' => __( 'Select your preffered position on the screen where you would like the toast to appear.', HATFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'top-left',
                                    'label' => __( 'Top Left', HATFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'top-right',
                                    'label' => __( 'Top Right', HATFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'bottom-left',
                                    'label' => __( 'Bottom Left', HATFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'bottom-right',
                                    'label' => __( 'Bottom Right', HATFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Color Status Indicator', HATFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the appropriate color status for each status indicator.', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'gn_status_success_clr',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_status_success_clr'],
                            'label' => __( 'Success Status', HATFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'gn_status_error_clr',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_status_error_clr'],
                            'label' => __( 'Error Status', HATFW_PLUGIN_DOMAIN ),
                        ])
                    ]   
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ])
    ]
]);

/**
 * Toaster UI Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'toaster-ui',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'toaster_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Panel', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Maximum Width', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_panel_mx_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_panel_mx_wd'],
                            'placeholder' => __( 'Maximum Width', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border Radius', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_panel_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_panel_br'],
                            'placeholder' => __( 'Border Radius', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Header Section', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'ts_head_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bg_clr'],
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Padding', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_head_pt',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pt'],
                            'label' => __( 'Top', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Top', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_head_pb',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pb'],
                            'label' => __( 'Bottom', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Bottom', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_head_pl',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pl'],
                            'label' => __( 'Left', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Left', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_head_pr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pr'],
                            'label' => __( 'Right', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Right', HATFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'ts_head_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bs'],
                            'label' => __( 'Style', HATFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_head_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bw'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_head_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_b_clr'],
                            'label' => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Body Section', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'ts_body_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_bg_clr'],
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Padding', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_body_pt',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pt'],
                            'label' => __( 'Top', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Top', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_body_pb',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pb'],
                            'label' => __( 'Bottom', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Bottom', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_body_pl',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pl'],
                            'label' => __( 'Left', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Left', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_body_pr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pr'],
                            'label' => __( 'Right', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Right', HATFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Status', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_status_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_wd'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_status_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_ht'],
                            'label' => __( 'Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HATFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'ts_status_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_bs'],
                            'label' => __( 'Style', HATFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_status_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_bw'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_status_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_b_clr'],
                            'label' => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_status_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_br'],
                            'label' => __( 'Radius', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Radius', HATFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Image', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_img_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_img_wd'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_img_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_img_ht'],
                            'label' => __( 'Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Title', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Font', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_title_fs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_fs'],
                            'label' => __( 'Font Size', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'ts_title_fw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_fw'],
                            'label' => __( 'Font Weight', HATFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_title_ln',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_ln'],
                            'label' => __( 'Line Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'ts_title_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_clr'],
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Content', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Font', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_content_fs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_fs'],
                            'label' => __( 'Font Size', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'ts_content_fw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_fw'],
                            'label' => __( 'Font Weight', HATFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_content_ln',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_ln'],
                            'label' => __( 'Line Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'ts_content_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_clr'],
                        ])
                    ]
                ])
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Close Button', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Icon', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_icon_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_wd'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_icon_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_ht'],
                            'label' => __( 'Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_icon_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_clr'],
                            'label' => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_icon_hv_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_hv_clr'],
                            'label' => __( 'Hover & Focus Color', HATFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_wd'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_ht'],
                            'label' => __( 'Height', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bg_clr'],
                            'label' => __( 'Color', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_bg_hv_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bg_hv_clr'],
                            'label' => __( 'Hover & Focus Color', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'ts_close_btn_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bs'],
                            'label' => __( 'Style', HATFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bw'],
                            'label' => __( 'Width', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HATFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_b_clr'],
                            'label' => __( 'Color', HATFW_PLUGIN_DOMAIN ),
                        ]),
                         Field::get_color_picker_field([
                            'name'  => 'ts_close_btn_hv_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_hv_b_clr'],
                            'label' => __( 'Hover & Focus Color', HATFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_text_field([
                            'name'  => 'ts_close_btn_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_br'],
                            'label' => __( 'Radius', HATFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Radius', HATFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ])
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'toaster_setting_group'
            ]
        ])
    ]
]);

/**
 * Advanced Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'advanced',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Optimization', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HATFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note that all settings here are used to enhance the performance of this plugin on the front-end side. This can improve your speed score in services like Pingdom, GTmetrix and PageSpeed.', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Caching', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_cache',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_cache'],
                            'description' => __( 'Enable this to cache the external styles and scripts.', HATFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HATFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HATFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable CSS & JS Minification', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_minify',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_minify'],
                            'description' => __( 'Enable this to minify the internal and external styles and scripts.', HATFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HATFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HATFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Deffered JS', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_defer',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_defer'],
                            'description' => __( 'Enable this to load external scripts in deffered way.', HATFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HATFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HATFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Additional', HATFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Custom CSS', HATFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_textarea_field([
                            'name'  => 'ad_add_custom_css',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_add_custom_css'],
                            'description' => __( 'Add your own CSS code here to customize the appearance of toaster notifier components at the front-end.', HATFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HATFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]),
    ]
]);

/**
 * Footer.
 */
echo Component::get_footer(); 