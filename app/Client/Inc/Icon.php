<?php
namespace HATFW\Client\Inc;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Client Icons.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Icon {

    /**
     * Inherit Singleton.
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
     * @param  string  $type   The type of icon.
     * @param  string  $class  Additional class.
     * @return string
     */
    public static function get( $type, $class = '' ) {
        $output  = '';
        $e_class = esc_attr( $class );
        switch ( $type ) {
            case 'bs-close':
               $output = "<svg class='". $e_class ."' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/></svg>";
                break;
        }
        
        return $output;
    }
}