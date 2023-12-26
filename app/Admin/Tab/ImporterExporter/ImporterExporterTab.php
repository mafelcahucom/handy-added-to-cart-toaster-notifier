<?php
namespace HATFW\Admin\Tab\ImporterExporter;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Tab\ImporterExporter\ImporterExporterEvent;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab > Setting.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ImporterExporterTab {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Register events.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Instantiate all importer & exporter events.
        ImporterExporterEvent::get_instance();
    }

    /**
     * Render the setting tab.
     *
     * @since 1.0.0
     */
    public static function render_tab() {
        echo Helper::render_view( 'tab/importer-exporter' );
    }
}