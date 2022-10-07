<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Actions.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Actions {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the settings.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $settings;

	/**
     * Execute Actions.
     *
     * @since 1.0.0
     */
    protected function __construct() {
    }
}