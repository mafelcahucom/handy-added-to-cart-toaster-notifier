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

defined( 'ABSPATH' ) || exit;

$settings = get_option( '_hatfw_main_settings' );

/**
 * Header
 */
echo Component::get_header( $args['page_title'] ); ?>

<div class="hd-container">

    <?php
        /**
         * Tab Navigation.
         */
        echo Component::get_tab_navigation([
            'class' => 'hd-mb-30',
            'tabs'  => [
                [
                    'title' => 'General',
                    'panel' => '#general'
                ],
                [
                    'title' => 'Toaster',
                    'panel' => '#toaster'
                ],
                [
                    'title' => 'Advanced',
                    'panel' => '#advanced'
                ]
            ]
        ]);
    ?>

    <?php

        /**
         * General - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'general',
            'state' => 'active'
        ]);

        /**
         * Save button settings - general_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]);

        /**
         * General - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'General',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_enable',
            'group' => 'general_setting_group',
            'value' => $settings['gn_enable'],
            'label' => 'Enable Toaster',
            'description' => 'Enable this to use toaster in the front-end.',
        ]);

        /**
         * General - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Toaster - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Toaster',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_enable_auto_hide',
            'group' => 'general_setting_group',
            'value' => $settings['gn_enable_auto_hide'],
            'label' => 'Enable Auto Hide',
            'description' => 'Enable this to hide the toaster automatically.',
        ]);

        echo Field::get_number_field([
            'name'  => 'gn_duration',
            'group' => 'general_setting_group',
            'value' => $settings['gn_duration'],
            'label' => 'Duration',
            'description' => 'Set the total milliseconds before the toaster will automatically hide. Note this will only be applied if you enable auto hide.',
            'placeholder' => 'Duration'
        ]);

        echo Field::get_select_field([
            'name'  => 'gn_position',
            'group' => 'general_setting_group',
            'value' => $settings['gn_position'],
            'label' => 'Position',
            'description' => 'Select the screen position of the toaster.',
            'options' => [
                [
                    'value' => 'top-left',
                    'label' => 'Top Left'
                ],
                [
                    'value' => 'top-right',
                    'label' => 'Top Right'
                ],
                [
                    'value' => 'bottom-left',
                    'label' => 'Bottom Left'
                ],
                [
                    'value' => 'bottom-right',
                    'label' => 'Bottom Right'
                ]
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Color Status Indicator',
            'description' => 'Set the appropriate color status for each status indicator.',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'gn_status_success_clr',
                    'group' => 'general_setting_group',
                    'value' => $settings['gn_status_success_clr'],
                    'label' => 'Success',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'gn_status_error_clr',
                    'group' => 'general_setting_group',
                    'value' => $settings['gn_status_error_clr'],
                    'label' => 'Error',
                ])
            ]
        ]);

        /**
         * Toaster - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - general_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]);

        /**
         * General - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php

        /**
         * Toaster - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'toaster',
            'state' => 'active'
        ]);

        /**
         * Save button settings - toaster_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'toaster_setting_group'
            ]
        ]);

        /**
         * Panel - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Panel',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_text_field([
            'name'  => 'ts_panel_mx_wd',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_panel_mx_wd'],
            'label' => 'Maximum Width',
            'placeholder' => 'Maximum Width'
        ]);

        echo Field::get_text_field([
            'name'  => 'ts_panel_br',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_panel_br'],
            'label' => 'Border Radius',
            'placeholder' => 'Border Radius'
        ]);

        /**
         * Panel - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Header Section - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Header Section',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_color_picker_field([
            'name'  => 'ts_head_bg_clr',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_head_bg_clr'],
            'label' => 'Background Color',
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Padding',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_head_pt',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_pt'],
                    'label' => 'Top',
                    'placeholder' => 'Top'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_head_pb',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_pb'],
                    'label' => 'Bottom',
                    'placeholder' => 'Bottom'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_head_pl',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_pl'],
                    'label' => 'Left',
                    'placeholder' => 'Left'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_head_pr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_pr'],
                    'label' => 'Right',
                    'placeholder' => 'Right'
                ]),
            ]   
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'ts_head_bs',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'ts_head_bw',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'ts_head_b_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_head_b_clr'],
                    'label' => 'Color',
                ])
            ]   
        ]);

        /**
         * Header Section - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Body Section - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Body Section',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_color_picker_field([
            'name'  => 'ts_body_bg_clr',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_body_bg_clr'],
            'label' => 'Background Color',
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Padding',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_body_pt',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_body_pt'],
                    'label' => 'Top',
                    'placeholder' => 'Top'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_body_pb',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_body_pb'],
                    'label' => 'Bottom',
                    'placeholder' => 'Bottom'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_body_pl',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_body_pl'],
                    'label' => 'Left',
                    'placeholder' => 'Left'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_body_pr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_body_pr'],
                    'label' => 'Right',
                    'placeholder' => 'Right'
                ]),
            ]   
        ]);

        /**
         * Body Section - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Status - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Status',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_status_wd',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_status_ht',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'ts_status_bs',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'ts_status_bw',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'ts_status_b_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_b_clr'],
                    'label' => 'Color',
                ]),
                Field::get_text_field([
                    'name'  => 'ts_status_br',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_status_br'],
                    'label' => 'Radius',
                    'placeholder' => 'Radius'
                ]),
            ]   
        ]);

        /**
         * Status - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Image - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Image',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_text_field([
            'name'  => 'ts_img_wd',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_img_wd'],
            'label' => 'Width',
            'placeholder' => 'Width'
        ]);

        echo Field::get_text_field([
            'name'  => 'ts_img_ht',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_img_ht'],
            'label' => 'Height',
            'placeholder' => 'Height'
        ]);

        /**
         * Image - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Title - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Title',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Font',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_title_fs',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_title_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'ts_title_fw',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_title_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'ts_title_ln',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_title_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
            ]
        ]);

        echo Field::get_color_picker_field([
            'name'  => 'ts_title_clr',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_title_clr'],
            'label' => 'Color',
        ]);

        /**
         * Title - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Content - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Content',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Font',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_content_fs',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_content_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'ts_content_fw',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_content_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'ts_content_ln',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_content_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
            ]
        ]);

        echo Field::get_color_picker_field([
            'name'  => 'ts_content_clr',
            'group' => 'toaster_setting_group',
            'value' => $settings['ts_content_clr'],
            'label' => 'Color',
        ]);

        /**
         * Content - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Close Button - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Close Button',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Icon Size',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_close_btn_icon_wd',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_icon_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_close_btn_icon_ht',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_icon_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Icon Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_icon_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_icon_clr'],
                    'label' => 'Color',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_icon_hv_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_icon_hv_clr'],
                    'label' => 'Hover & Focus Color',
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'ts_close_btn_wd',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'ts_close_btn_ht',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Background Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_bg_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_bg_clr'],
                    'label' => 'Color'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_bg_hv_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_bg_hv_clr'],
                    'label' => 'Hover & Focus Color'
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'ts_close_btn_bs',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'ts_close_btn_bw',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_b_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_b_clr'],
                    'label' => 'Color',
                ]),
                 Field::get_color_picker_field([
                    'name'  => 'ts_close_btn_hv_b_clr',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_hv_b_clr'],
                    'label' => 'Hover & Focus Color',
                ]),
                Field::get_text_field([
                    'name'  => 'ts_close_btn_br',
                    'group' => 'toaster_setting_group',
                    'value' => $settings['ts_close_btn_br'],
                    'label' => 'Radius',
                    'placeholder' => 'Radius'
                ]),
            ]   
        ]);

        /**
         * Close Button - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - toaster_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'toaster_setting_group'
            ]
        ]);

        /**
         * Toaster - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php

        /**
         * Advanced - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'advanced',
            'state' => 'default'
        ]);

        /**
         * Save button settings - advanced_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]);

        /**
         * Advance - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Advanced Settings',
            'class' => 'hd-mb-50'
        ]);

        echo Field::get_textarea_field([
            'name'  => 'ad_stg_additional_css',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_stg_additional_css'],
            'label' => 'Addtional CSS',
            'description' => 'Add your own CSS code here to customize the appearance of toaster components at the front-end.'
        ]);

        /**
         * Advance - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - advanced_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hatfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]);

        /**
         * Advance - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

</div>

<?php 
    /**
     * Footer.
     */
    echo Component::get_footer(); 
?>