<?php
/**
 * App > Views > Admin > Component > Breadcrumb.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-sliding-cart
 */

use HATFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

$tab   = ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ? $_GET['tab'] : 'setting' );
$tabs  = array(
    'setting'       => __( 'Setting', 'handy-added-to-cart-toaster-notifier' ),
    'import-export' => __( 'Import & Export', 'handy-added-to-cart-toaster-notifier' ),
);
$title = ( isset( $tabs[ $tab ] ) ? $tabs[ $tab ] : __( 'Setting', 'handy-added-to-cart-toaster-notifier' ) );
?>

<ul class="hd-breadcrumb">
    <li class="hd-breadcrumb__item" data-type="home">
        <?php echo Helper::get_icon( 'house', 'hd-house' ); ?>
    </li>
    <li class="hd-breadcrumb__item" data-type="page">
        <?php echo esc_html( $title ); ?>
    </li>
    <?php if ( $title === 'Setting' ) : ?>
        <li class="hd-breadcrumb__item" data-type="tab">
            <?php echo __( 'General', 'handy-added-to-cart-toaster-notifier' ); ?>
        </li>
    <?php endif; ?>
</ul>
