<?php

/**
 * Uninstall.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */

/**
 * Delete all the data in database associated with added to cart toaster notifier.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hatfw_uninstall' ) ) {
    function hatfw_uninstall() {
        /**
         * Delete option _hatfw_main_settings.
         *
         * @since 1.0.0
         */
        delete_option( '_hatfw_main_settings' );

        /**
         * Delete option _hatfw_plugin_version.
         *
         * @since 1.0.0
         */
        delete_option( '_hatfw_plugin_version' );
    }
    hatfw_uninstall();
}