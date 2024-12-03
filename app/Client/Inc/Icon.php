<?php
/**
 * App > Client > Inc > Icon.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

namespace HATFW\Client\Inc;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Icon` class contains a set of SVG icons that
 * can be used in client side or front-end
 *
 * @since 1.0.0
 */
final class Icon {

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
     * Return the svg icon.
     *
     * @since 1.0.0
     *
     * @param  string $name       Contains the name of icon to be retrieved.
     * @param  string $classnames Contains the additional classnames.
     * @return string
     */
    public static function get( $name, $classnames = '' ) {
        $classnames = esc_attr( $classnames );
        return '';
    }
}
