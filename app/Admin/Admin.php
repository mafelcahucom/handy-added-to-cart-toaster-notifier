<?php
namespace HATFW\Admin;

use HATFW\Inc\Traits\Singleton;
use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\Component;
use HATFW\Admin\Tab\Setting\SettingTab;
use HATFW\Admin\Tab\ImporterExporter\ImporterExporterTab;

defined( 'ABSPATH' ) || exit;

/**
 * Admin.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Admin {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds all the tabs.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $tabs = [];

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Load all classes.
        self::register_classes();

        // Load admin dashboard.
        add_action( 'admin_menu', [ $this, 'menu' ] );

        if ( Helper::is_correct_page() ) {
            // Register styles and scripts.
            add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

            // Hide all the notices.
            add_action( 'admin_head', [ $this, 'hide_all_notices' ] );
        }
    }

    /**
     * Admin Dashboard Menu.
     *
     * @since 1.0.0
     */
    public function menu() {
        if ( Helper::is_menu_exists( 'handy' ) === false ) {
            add_menu_page( 
                'Handy', 
                'Handy', 
                'manage_options', 
                'handy', 
                '', 
                Helper::get_asset_src( 'images/icon.svg' ), 
                null 
            );

            add_submenu_page( 
                'handy', 
                'Handy', 
                'Handy', 
                'manage_options', 
                'handy', 
                [ $this, 'render_menu_dashboard' ] 
            );
        }

        add_submenu_page( 
            'handy', 
            'Toaster Notifier', 
            'Toaster Notifier', 
            'manage_options', 
            'hatfw', 
            [ $this, 'render_submenu_dashboard' ] 
        );
    }

    /**
     * Render the main menu dashboard.
     *
     * @since 1.0.0
     */
    public function render_menu_dashboard() {
        echo "<h1>Menu Dashboard</h1>";
    }

    /**
     * Render the submenu dashboard.
     * 
     * @since 1.0.0
     */
    public function render_submenu_dashboard() {
        // Check if the plugin has error.
        if ( Helper::plugin_has_error() ) {
            echo Component::get_plugin_error_message();
            return;
        }

        if ( ! Helper::is_correct_page() ) {
            return;
        }

        if ( isset( $_GET['tab'] ) ) {
            switch ( $_GET['tab'] ) {
                case 'setting':
                    SettingTab::render_tab();
                    break;
                case 'import-export':
                    ImporterExporterTab::render_tab();
                    break;
            }
        } else {
            SettingTab::render_tab();
        }
    }


    /**
     * Returns all the class services.
     *
     * @return array  List of classes
     */
    private static function get_classes() {
        return [
            SettingTab::class,
            ImporterExporterTab::class
        ];
    }

    /**
     * Loop through the services classes and instantiate each class.
     *
     * @since 1.0.0
     */
    public static function register_classes() {
        foreach ( self::get_classes() as $class ) {
            // For instantiating.
            if ( method_exists( $class, 'get_instance' ) ) {
                self::instantiate( $class );
            }
        }
    }

    /**
     * Instantiate the given service class.
     *
     * @since 1.0.0
     *
     * @param  class  $class  Containing a class from self::get_classes().
     * @return class
     */
    private static function instantiate( $class ) {
        $class::get_instance();
    }

    /**
     * Register all styles.
     *
     * @since 1.0.0
     */
    public function register_styles() {
        wp_register_style( 'pickr', Helper::get_asset_src( 'pickr/pickr.min.css' ), [], '1.0.0', 'all' );
        wp_register_style( 'hatfw-admin-css', Helper::get_asset_src( 'css/hatfw-admin.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'pickr' );
        wp_enqueue_style( 'hatfw-admin-css' );
    }

    /**
     * Register all scripts.
     *
     * @since 1..0.0
     */
    public function register_scripts() {
        wp_register_script( 'pickr', Helper::get_asset_src( 'pickr/pickr.min.js' ), [], '1.0.0', true );
        wp_register_script( 'hatfw-admin-js', Helper::get_asset_src( 'js/hatfw-admin.min.js' ), [], '1.0.0', true );

        wp_enqueue_script( 'pickr' );
        wp_enqueue_script( 'hatfw-admin-js' );

        // Localize variables.
        wp_localize_script( 'hatfw-admin-js', 'hatfwLocal', [
            'crafter' => 'Y35qwbAlyt+y60cldwAatUDyxikpRb30wBPT9Y1Xymk=',
            'url'     => admin_url( 'admin-ajax.php' ),
            'tab'     => [
                'setting' => [
                    'nonce' => [
                        'saveSettings' => wp_create_nonce( 'hatfw_save_settings' )
                    ]
                ],
                'importerExporter' => [
                    'nonce' => [
                        'exportSettings' => wp_create_nonce( 'hatfw_export_settings' ),
                        'importSettings' => wp_create_nonce( 'hatfw_import_settings' )
                    ]
                ]
            ]
        ]);
    }

    /**
     * Hides all the admin notices.
     *
     * @since 1.0.0
     */
    public function hide_all_notices() {
        remove_all_actions( 'admin_notices' );
    }
}