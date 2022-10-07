<?php
namespace HATFW\Client\Inc;

use HATFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Client Loaders.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class loader {

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
     * Return the loader css class with attributes.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Contains the necessary parameters for rendering loaders.
     * $args = [
     *     'name'      => (string) The name of the loader.
     *     'classname' => (string) The new classname will be named for the loader.
     *     'width'     => (string) The width of the loader.
     *     'height'    => (string) The height of the loader.
     *     'stroke'    => (string) The border width of the loader.
     *     'color_1'   => (string) The primary color of the loader.
     *     'color-2'   => (string) THe secondary color of the loader.
     * ]
     * @return HTMLElement
     */
    public static function get( $args = [] ) {
        if ( ! isset( $args['name'] ) ) {
            return;
        }

        $width     = ( isset( $args['width'] ) ? $args['width'] : '20px' );
        $height    = ( isset( $args['height'] ) ? $args['height'] : '20px' );
        $stroke    = ( isset( $args['stroke'] ) ? $args['stroke'] : '2px' );
        $color_1   = ( isset( $args['color_1'] ) ? $args['color_1'] : '#ffffff' );
        $color_2   = ( isset( $args['color_2'] ) ? $args['color_2'] : '#0071f2' );
        $classname = ( isset( $args['classname'] ) ? $args['classname'] : 'loader' );

        $output = '';
        switch ( $args['name'] ) {
            case 'spinner-1':
                $output = "
                    .{$classname}{width: {$width};height: {$height};border: {$stroke} solid {$color_1};border-bottom-color: transparent;border-radius: 50%;display: block;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;} @-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}} @keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-2':
                $output = "
                    .{$classname}{width: {$width};height: {$height};border-radius: 50%;position: relative;-webkit-animation: {$classname}-rotate 1s linear infinite;animation: {$classname}-rotate 1s linear infinite;}.{$classname}::before {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;position: absolute;inset: 0;border-radius: 50%;border: {$stroke} solid {$color_1};-webkit-animation: {$classname}-prixClipFix 2s linear infinite;animation: {$classname}-prixClipFix 2s linear infinite;}@-webkit-keyframes {$classname}-rotate {100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes hd-spinner-2-rotate {100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@-webkit-keyframes {$classname}-prixClipFix {0% {-webkit-clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);}25% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);}50% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);}75% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%);}100% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0);}}@keyframes {$classname}-prixClipFix {0% {-webkit-clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);}25% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);}50% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);}75% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%);}100% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0);}}
                ";
                break;
            case 'spinner-3':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border-radius: 50%;position: relative;-webkit-animation: {$classname}-rotate 1s linear infinite;animation: {$classname}-rotate 1s linear infinite;}.{$classname}::before, .{$classname}::after {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;position: absolute;inset: 0;border-radius: 50%;border: {$stroke} solid {$color_1};-webkit-animation: {$classname}-prixClipFix 2s linear infinite;animation: {$classname}-prixClipFix 2s linear infinite;}.{$classname}::after {inset: 5px;-webkit-transform: rotate3d(90, 90, 0, 180deg);transform: rotate3d(90, 90, 0, 180deg);border-color: {$color_2};}@-webkit-keyframes {$classname}-rotate {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotate {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@-webkit-keyframes {$classname}-prixClipFix {0% {-webkit-clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);}50% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);}75%, 100% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);}}@keyframes {$classname}-prixClipFix {0% {-webkit-clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0);}50% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0);}75%, 100% {-webkit-clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%);}}
                ";
                break;
            case 'spinner-4':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border: {$stroke} solid {$color_1};border-radius: 50%;display: block;position: relative;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;}.{$classname}::after {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;position: absolute;left: 0;top: 0;background: {$color_2};width: 8px;height: 8px;-webkit-transform: translate(-50%, 50%);-ms-transform: translate(-50%, 50%);transform: translate(-50%, 50%);border-radius: 50%;}@-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-5':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border: {$stroke} solid {$color_1};border-radius: 50%;display: block;position: relative;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;}.{$classname}::after {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;position: absolute;left: 50%;top: 0;background: {$color_2};width: {$stroke};height: 50%;-webkit-transform: translateX(-50%);-ms-transform: translateX(-50%);transform: translateX(-50%);}@-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-6':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border-radius: 50%;display: block;border-top: {$stroke} solid {$color_1};border-right: {$stroke} solid transparent;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;}@-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-7':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border-radius: 50%;display: block;border-top: {$stroke} solid {$color_1};border-right: {$stroke} solid transparent;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;}.{$classname}::after {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;position: absolute;left: 0;top: 0;width: 100%;height: 100%;border-radius: 50%;border-bottom: {$stroke} solid {$color_2};border-left: {$stroke} solid transparent;}@-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-8':
                $output = "
                    .{$classname} {width: {$width};height: {$height};border: {$stroke} solid;border-color: {$color_1} transparent;border-radius: 50%;display: block;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-rotation 1s linear infinite;animation: {$classname}-rotation 1s linear infinite;}@-webkit-keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}@keyframes {$classname}-rotation {0% {-webkit-transform: rotate(0deg);transform: rotate(0deg);}100% {-webkit-transform: rotate(360deg);transform: rotate(360deg);}}
                ";
                break;
            case 'spinner-9':
                $output = "
                    .{$classname} {width: {$width};height: {$height};background: {$color_1};border-radius: 50%;position: relative;-webkit-animation: {$classname}-skLinRotate 1s ease-in-out infinite alternate;animation: {$classname}-skLinRotate 1s ease-in-out infinite alternate;}.{$classname}::after {content: '';position: absolute;inset: 3px;border-radius: 50%;border: {$stroke} solid transparent;border-top-color: {$color_2};}@-webkit-keyframes {$classname}-skLinRotate {95%, 100% {-webkit-transform: rotate(840deg);transform: rotate(840deg);}}@keyframes {$classname}-skLinRotate {95%, 100% {-webkit-transform: rotate(840deg);transform: rotate(840deg);}}
                ";
                break;
            case 'pulse-1':
                $output = "
                    .{$classname} {width: {$width};height: {$height};background: {$color_1};display: block;border-radius: 50%;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-animloader 1s ease-in infinite;animation: {$classname}-animloader 1s ease-in infinite;}@-webkit-keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}@keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}
                ";
                break;
            case 'pulse-2':
                $output = "
                    .{$classname} {width: {$width};height: {$height};display: block;position: relative;}.{$classname}::after, .{$classname}::before {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;width: {$width};height: {$height};border-radius: 50%;background: {$color_1};position: absolute;left: 0;top: 0;-webkit-animation: {$classname}-animloader 2s linear infinite;animation: {$classname}-animloader 2s linear infinite;}.{$classname}::after {-webkit-animation-delay: 1s;animation-delay: 1s;}@-webkit-keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}@keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}
                ";
                break;
            case 'pulse-3':
                $output = "
                    .{$classname} {width: {$width};height: {$height};display: block;position: relative;}.{$classname}::after, .{$classname}::before {content: '';width: {$width};height: {$height};border-radius: 50%;background: {$color_1};position: absolute;left: 0;top: 0;-webkit-box-sizing: border-box;box-sizing: border-box;-webkit-animation: {$classname}-animloader 2s ease-in-out infinite;animation: {$classname}-animloader 2s ease-in-out infinite;}.{$classname}::after {-webkit-animation-delay: 1s;animation-delay: 1s;}@-webkit-keyframes {$classname}-animloader {0%, 100% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}50% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}@keyframes {$classname}-animloader {0%, 100% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}50% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}
                ";
                break;
            case 'pulse-4':
                $output = "
                    .{$classname} {width: {$width};height: {$height};display: block;position: relative;}.{$classname}::after, .{$classname}::before {content: '';-webkit-box-sizing: border-box;box-sizing: border-box;width: {$width};height: {$height};border-radius: 50%;border: {$stroke} solid {$color_1};position: absolute;left: 0;top: 0;-webkit-animation: {$classname}-animloader 2s linear infinite;animation: {$classname}-animloader 2s linear infinite;}.{$classname}::after {-webkit-animation-delay: 1s;animation-delay: 1s;}@-webkit-keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}@keyframes {$classname}-animloader {0% {-webkit-transform: scale(0);transform: scale(0);opacity: 1;}100% {-webkit-transform: scale(1);transform: scale(1);opacity: 0;}}
                ";
                break;
        }
        return $output;
    }
}