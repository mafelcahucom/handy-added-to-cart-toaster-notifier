<?php
/**
 * App > Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\Component;
use HATFW\Admin\Inc\Field;
use HATFW\Api\SettingApi;

defined( 'ABSPATH' ) || exit;

// Get the setting current value.
$settings = SettingApi::get_current_settings();

/**
 * Header
 */
echo Component::get_header();

/**
 * Tab Navigation.
 */
echo Component::get_tab_navigation(array(
    'class' => 'hd-mb-30',
    'tabs'  => array(
        array(
            'title' => __( 'General', 'handy-added-to-cart-toaster-notifier' ),
            'panel' => '#general',
        ),
        array(
            'title' => __( 'Toaster UI', 'handy-added-to-cart-toaster-notifier' ),
            'panel' => '#toaster-ui',
        ),
        array(
            'title' => __( 'Advanced', 'handy-added-to-cart-toaster-notifier' ),
            'panel' => '#advanced',
        ),
    ),
));

/**
 * General Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'general',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'general_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'General', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Toaster', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable'],
                            'description' => __( 'Enable this option to activate handy added to cart toaster notifier functionalities in the front-end.', 'handy-added-to-cart-toaster-notifier' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-added-to-cart-toaster-notifier' ),
                                'off' => __( 'Disabled', 'handy-added-to-cart-toaster-notifier' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Toaster', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Auto Hide', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_enable_auto_hide',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable_auto_hide'],
                            'description' => __( 'Enable this option to hide the toaster automatically.', 'handy-added-to-cart-toaster-notifier' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-added-to-cart-toaster-notifier' ),
                                'off' => __( 'Disabled', 'handy-added-to-cart-toaster-notifier' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Duration', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_number_field(array(
                            'name'  => 'gn_duration',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_duration'],
                            'placeholder' => __( 'Duration', 'handy-added-to-cart-toaster-notifier' ),
                            'description' => __( 'Set the total milliseconds before the toaster will automatically hide. Note this will only be applied if you enable auto hide.', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Position', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gn_position',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_position'],
                            'description' => __( 'Select your preffered position on the screen where you would like the toast to appear.', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => array(
                                array(
                                    'value' => 'top-left',
                                    'label' => __( 'Top Left', 'handy-added-to-cart-toaster-notifier' ),
                                ),
                                array(
                                    'value' => 'top-right',
                                    'label' => __( 'Top Right', 'handy-added-to-cart-toaster-notifier' ),
                                ),
                                array(
                                    'value' => 'bottom-left',
                                    'label' => __( 'Bottom Left', 'handy-added-to-cart-toaster-notifier' ),
                                ),
                                array(
                                    'value' => 'bottom-right',
                                    'label' => __( 'Bottom Right', 'handy-added-to-cart-toaster-notifier' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Color Status Indicator', 'handy-added-to-cart-toaster-notifier' ),
                    'description' => __( 'Set the appropriate color status for each status indicator.', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'gn_status_success_clr',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_status_success_clr'],
                            'label' => __( 'Success Status', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'gn_status_error_clr',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_status_error_clr'],
                            'label' => __( 'Error Status', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'general_setting_group',
            ),
        )),
    ),
));

/**
 * Toaster UI Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'toaster-ui',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'toaster_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Panel', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Maximum Width', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_panel_mx_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_panel_mx_wd'],
                            'placeholder' => __( 'Maximum Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_panel_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_panel_br'],
                            'placeholder' => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Header Section', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_head_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bg_clr'],
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Padding', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_head_pt',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pt'],
                            'label' => __( 'Top', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Top', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_head_pb',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pb'],
                            'label' => __( 'Bottom', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Bottom', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_head_pl',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pl'],
                            'label' => __( 'Left', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Left', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_head_pr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_pr'],
                            'label' => __( 'Right', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Right', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'ts_head_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bs'],
                            'label' => __( 'Style', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_head_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_bw'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_head_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_head_b_clr'],
                            'label' => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Body Section', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_body_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_bg_clr'],
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Padding', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_body_pt',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pt'],
                            'label' => __( 'Top', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Top', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_body_pb',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pb'],
                            'label' => __( 'Bottom', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Bottom', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_body_pl',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pl'],
                            'label' => __( 'Left', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Left', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_body_pr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_body_pr'],
                            'label' => __( 'Right', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Right', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Status', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_status_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_wd'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_status_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_ht'],
                            'label' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'ts_status_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_bs'],
                            'label' => __( 'Style', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_status_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_bw'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_status_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_b_clr'],
                            'label' => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_status_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_status_br'],
                            'label' => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Image', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_img_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_img_wd'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_img_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_img_ht'],
                            'label' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Title', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Font', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_title_fs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_fs'],
                            'label' => __( 'Font Size', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Font Size', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'ts_title_fw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_fw'],
                            'label' => __( 'Font Weight', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_title_ln',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_ln'],
                            'label' => __( 'Line Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Line Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_title_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_title_clr'],
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Content', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Font', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_content_fs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_fs'],
                            'label' => __( 'Font Size', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Font Size', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'ts_content_fw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_fw'],
                            'label' => __( 'Font Weight', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_content_ln',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_ln'],
                            'label' => __( 'Line Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Line Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_content_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_content_clr'],
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Close Button', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Icon', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_icon_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_wd'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_icon_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_ht'],
                            'label' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_icon_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_clr'],
                            'label' => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_icon_hv_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_icon_hv_clr'],
                            'label' => __( 'Hover & Focus Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_wd',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_wd'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_ht',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_ht'],
                            'label' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Height', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_bg_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bg_clr'],
                            'label' => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_bg_hv_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bg_hv_clr'],
                            'label' => __( 'Hover & Focus Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'ts_close_btn_bs',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bs'],
                            'label' => __( 'Style', 'handy-added-to-cart-toaster-notifier' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_bw',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_bw'],
                            'label' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Width', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_b_clr'],
                            'label' => __( 'Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                         Field::get_color_picker_field(array(
                            'name'  => 'ts_close_btn_hv_b_clr',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_hv_b_clr'],
                            'label' => __( 'Hover & Focus Color', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'ts_close_btn_br',
                            'group' => 'toaster_setting_group',
                            'value' => $settings['ts_close_btn_br'],
                            'label' => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                            'placeholder' => __( 'Border Radius', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'toaster_setting_group',
            ),
        )),
    ),
));

/**
 * Advanced Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'advanced',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'advanced_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Optimization', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-added-to-cart-toaster-notifier' ),
                            'content' => __( 'Note that all settings here are used to enhance the performance of this plugin on the front-end side. This can improve your speed score in services like Pingdom, GTmetrix and PageSpeed.', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Caching', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_cache',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_cache'],
                            'description' => __( 'Enable this option to cache the external style and script files so that they can be accessed more quickly.', 'handy-added-to-cart-toaster-notifier' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-added-to-cart-toaster-notifier' ),
                                'off' => __( 'Disabled', 'handy-added-to-cart-toaster-notifier' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable CSS & JS Minification', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_minify',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_minify'],
                            'description' => __( 'Enable this option to minify the internal and external style and script files to reduce load times and bandwidth.', 'handy-added-to-cart-toaster-notifier' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-added-to-cart-toaster-notifier' ),
                                'off' => __( 'Disabled', 'handy-added-to-cart-toaster-notifier' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Deffered JS', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_defer',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_defer'],
                            'description' => __( 'Enable this option to defer external scripts so they will be downloaded in parallel to the parsing page and executed after page is finished parsing.', 'handy-added-to-cart-toaster-notifier' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-added-to-cart-toaster-notifier' ),
                                'off' => __( 'Disabled', 'handy-added-to-cart-toaster-notifier' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Additional', 'handy-added-to-cart-toaster-notifier' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Custom CSS', 'handy-added-to-cart-toaster-notifier' ),
                    'fields' => array(
                        Field::get_textarea_field(array(
                            'name'  => 'ad_add_custom_css',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_add_custom_css'],
                            'description' => __( 'Add your own CSS code here to customize the appearance of toaster notifier components at the front-end.', 'handy-added-to-cart-toaster-notifier' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-added-to-cart-toaster-notifier' ),
            'attr'  => array(
                'data-group-target' => 'advanced_setting_group',
            ),
        )),
    ),
));

/**
 * Placeholder.
 */
echo Component::get_placeholder();

/**
 * Footer.
 */
echo Component::get_footer();
