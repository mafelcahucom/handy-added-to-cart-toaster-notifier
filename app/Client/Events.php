<?php
namespace HATFW\Client;

use HATFW\Inc\Traits\Singleton;
use HATFW\Inc\Traits\Security;
use HATFW\Inc\Plugins;
use HATFW\Client\Inc\Helper;

/**
 * Events.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Events {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
	 * Inherit Security.
	 */
	use Security;

	/**
	 * Register all ajax action classes.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	protected function __construct() {
	}
}