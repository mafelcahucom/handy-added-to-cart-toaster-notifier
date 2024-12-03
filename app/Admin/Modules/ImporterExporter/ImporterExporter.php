<?php
/**
 * App > Admin > Modules > Importer Exporter > Importer Exporter.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

namespace HATFW\Admin\Modules\ImporterExporter;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Traits\Instantiator;
use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Modules\ImporterExporter\Events;

defined( 'ABSPATH' ) || exit;

/**
 * The `ImporterExporter` class modules contains the
 * all services of admin importer exporter page.
 *
 * @since 1.0.0
 */
final class ImporterExporter {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Inherit Instantiator.
     *
     * @since 1.0.0
     */
    use Instantiator;

    /**
     * Instantiate.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Instantiate or load services.
         */
        self::instantiate(array(
            Events::class,
        ));
    }

    /**
     * Render the importer & exporter tab content.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function render_tab_content() {
        echo Helper::render_view( 'tab/importer-exporter' );
    }
}
