<?php
/**
 * Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\Component;
use HATFW\Admin\Inc\Field;

defined( 'ABSPATH' ) || exit;

$settings = get_option( '_hatfw_main_settings' );

/**
 * Header
 */
echo Component::get_header( $args['page_title'] ); ?>

<div class="hd-container">
</div>

<?php 
    /**
     * Footer.
     */
    echo Component::get_footer(); 
?>