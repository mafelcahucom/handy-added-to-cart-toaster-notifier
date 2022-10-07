<?php
namespace HATFW\Admin\Tab\Setting;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Tab\Setting\SettingEvent;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingTab {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Register events.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Instantiate all settings events.
        SettingEvent::get_instance();
    }

    /**
     * Render the setting tab.
     *
     * @since 1.0.0
     */
    public static function render_tab() {
        echo Helper::render_view( 'tab/setting', [
            'page_title' => 'Setting'
        ]);
    }
}