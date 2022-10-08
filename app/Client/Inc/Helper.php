<?php
namespace HATFW\Client\Inc;

use HATFW\Inc\Traits\Singleton;
use HATFW\Client\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * Client Helper.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */

final class Helper {

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
     * Return boolean whether the plugin has a missing
     * options "_hatfw_plugin_version" or "_hatfw_main_settings";
     *
     * @since 1.0.0
     * 
     * @return 1.0.0
     */
    public static function plugin_has_error() {
        return ( empty( get_option( '_hatfw_plugin_version' ) ) || empty( get_option( '_hatfw_main_settings' ) ) );
    }

    /**
     * Returns the base url of client dist folder.
     *
     * @since 1.0.0
     * 
     * @param string  $file  Target filename.
     * @return string
     */
    public static function get_asset_src( $file ) {
        return HATFW_PLUGIN_URL . 'assets/client/dist/' . $file;
    }

    /**
     * Render client view.
     *
     * @since 1.0.0
     * 
     * @param  string  $file  Target filename.
     * @param  array   $args  Additional arguments.
     * @return HTMLElement
     */
    public static function render_view( $filename, $args = [] ) {
        $file = HATFW_PLUGIN_PATH . 'app/Views/client/'. $filename .'.php';
        if ( ! file_exists( $file ) ) {
            return;
        }

        ob_start();
        require $file;
        return ob_get_clean();
    }

    /**
     * Returns the svg icon.
     *
     * @since 1.0.0
     * 
     * @param  string  $type       The type of icon.
     * @param  string  $classname  Additional classname.
     * @return string
     */
    public static function get_icon( $type, $classname = '' ) {
        return Icon::get( $type, $classname );
    }

    /**
     * Returns the attachment image with title tag & lazyload attribute.
     *
     * @since 1.0.0
     * 
     * @param  number  $attachment_id          The target attachment id.
     * @param  string  $size                   The specific image size from add_image_size().
     * @param  array   $additional_attributes  Contains the additional attributes.
     * @return HTMLElement
     */
    public static function get_attachment_image( $attachment_id, $size = 'full', $additional_attributes = [] ) {
        $output = '';
        if ( ! empty( $attachment_id ) ) {
            $default_attributes = [
                'title'   => get_the_title( $attachment_id ),
                'loading' => 'lazy'
            ];
            $attributes = array_merge( $additional_attributes, $default_attributes );
            $output     = wp_get_attachment_image( $attachment_id, $size, false, $attributes );
        }
        return $output;
    }

    /**
     * Return the product placeholder image source.
     *
     * @since 1.0.0
     * 
     * @param  string  $size  Registered image sizes.
     * @return string
     */
    public static function get_product_thumbnail_placeholer_src( $size = 'full' ) {
        $source = wc_placeholder_img_src( $size );
        if ( empty( $source ) ) {
            $source = self::get_asset_src( 'images/thumbnail-placeholder.webp' );
        }

        return $source;
    }

    /**
     * Return the product placeholder image.
     *
     * @since 1.0.0
     * 
     * @param  string  $alt    Will be used in alt attribute.
     * @param  string  $title  Will be used in title attribute. 
     * @param  string  $class  Additional class.
     * @return HTMLElement
     */
    public static function get_product_thumbnail_placeholer( $alt = '', $title = '', $class = '' ) {
        $source = get_product_thumbnail_placeholer_src( 'woocommerce_thumbnail' );

        return '<img src="'. $source .'" class="'. esc_attr( $class ) .'" alt="'. esc_attr( $alt ) .'" title="'. esc_attr( $title ) .'">';
    }

    /**
     * Return the product thumbnail image.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contaings all the parameters need to render product thumbnail.
     * $args = [
     *     'product_id'   => (integer) The target product id.
     *     'variation_id' => (integer) The target variation id.
     *     'class'        => (string)  Additional class.
     * ]
     * @return HTMLElement
     */
    public static function get_product_thumbnail( $args = [] ) {
        if ( ! isset( $args['product_id'] ) && ! isset( $args['variation_id'] ) ) {
            return;
        }

        $output = '';
        $title  = '';
        $class  = ( isset( $args['class'] ) ? $args['class'] : '' );
        if ( ! empty( $args['variation_id'] ) ) {
            $title = get_the_title( $args['variation_id'] );
            if ( has_post_thumbnail( $args['variation_id'] ) ) {
                $output = self::get_attachment_image( get_post_thumbnail_id( $args['variation_id'] ), 'woocommerce_thumbnail',  [
                    'class' => $class
                ]);
            }
        }

        if ( empty( $output ) ) {
            $title = get_the_title( $args['product_id'] );
            if ( has_post_thumbnail( $args['product_id'] ) ) {
                $output = self::get_attachment_image( get_post_thumbnail_id( $args['product_id'] ), 'woocommerce_thumbnail',  [
                    'class' => $class
                ]);
            }
        }

        if ( empty( $output ) ) {
            $output = self::get_product_thumbnail_placeholer( $title, $title, $class );
        }

        return $output;
    }

    /**
     * Return the product thumnail image source.
     *
     * @since 1.0.0
     * 
     * @param  integer  $product_id  The target product id.
     * @return string
     */
    public static function get_product_thumbnail_src( $product_id ) {
        if ( empty( $product_id ) ) {
            return;
        }

        $source = '';
        if ( has_post_thumbnail( $product_id ) ) {
            $source = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'woocommerce_thumbnail' )[0];
        }

        if ( empty( $source ) ) {
            $source = self::get_product_thumbnail_placeholer_src( 'woocommerce_thumbnail' );
        }

        return $source;
    }

    /**
     * Return the attachment image source with product image placeholder.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attachment_id  The target attachment id.
     * @return string
     */
    public static function get_attachment_image_src( $attachment_id ) {
        if ( empty( $attachment_id ) ) {
            return;
        }

        $source = wp_get_attachment_image_src( $attachment_id, 'full' );
        if ( empty( $source ) ) {
            $source = self::get_product_thumbnail_placeholer_src( 'full' );
        }

        return $source;
    }

    /**
     * Return the data of recently added product in the cart.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_recently_added_product() {
        $items = WC()->cart->get_cart();
        if ( empty( $items ) ) {
            return;
        }

        $filtered_items = array_filter( $items, function( $item ) {
            return isset( $item['hatfw_timestamp'] ) === true;
        });

        if ( empty( $filtered_items ) ) {
            return;
        }

        // Sort filtered_items in ascending based on timestamp.
        array_multisort( array_column( $filtered_items, 'hatfw_timestamp' ), SORT_ASC, $filtered_items );
        $product = end( $filtered_items );

        return [
            'name'  => $product['data']->get_name(),
            'image' => self::get_product_thumbnail_src( $product['product_id'] )
        ];
    }
}