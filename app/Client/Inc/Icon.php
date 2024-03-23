<?php
namespace HATFW\Client\Inc;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Client Icons.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
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
     * @param  string  $type   Contains the type of icon.
     * @param  string  $class  Contains the additional class.
     * @return string
     */
    public static function get( $type, $class = '' ) {
        $output = '';
        $class  = esc_attr( $class );
        
        return $output;
    }
}