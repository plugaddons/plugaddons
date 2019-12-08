<?php
/*
Plugin Name: Plugaddons Extension
Plugin URI: http://plugaddons.com/plugaddons
Description: Plugaddons for creating Elementor Extensions
Version: 1.0
Author: Plugaddons
Author URI: http://plugaddons.com/
License: GPLv2 or later
Text Domain: plugaddons
Domain Path: /languages/
*/

final class Elementor_Plugaddons_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'plugaddons', false, dirname(__FILE__). '/languages' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/elements/categories_registered', [$this, 'register_new_category'] );

        add_action('elementor/frontend/after_enqueue_scripts',[$this,'pla_assets_files']);
        add_action('elementor/editor/after_enqueue_scripts',[$this,'testimonials_editor_assets']);
	}
    /**
     * Add Progress Bar JS
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
	public function pla_assets_files(){
	    wp_enqueue_style('slick-css', plugin_dir_url( __FILE__ ). '/assets/public/css/slick.css', null, '1.0.0', 'all');
	    wp_enqueue_style('slick-theme-css', plugin_dir_url( __FILE__ ). '/assets/public/css/slick-theme.css', null, '1.0.0', 'all');
	    wp_enqueue_style('plugaddons-css', plugin_dir_url( __FILE__ ). '/assets/public/css/main.css', null, time(), 'all');
	    wp_enqueue_script('jquery-numerator-js', plugin_dir_url( __FILE__ ).'/assets/public/js/jquery-numerator.js', array('jquery'), time(), true);
	    wp_enqueue_script('slick-js', plugin_dir_url( __FILE__ ).'/assets/public/js/slick.min.js', array('jquery'), '1.0.0', true);
	    wp_enqueue_script('pla-hendale-js', plugin_dir_url( __FILE__ ).'/assets/public/js/pla-main.js', array('jquery','jquery-numerator-js'), time(), true);

	}
    /**
     * Add Testimonials Carousel Editor JS
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function testimonials_editor_assets(){
        wp_enqueue_script('testimonials-editor-js', plugin_dir_url( __FILE__ ).'/assets/admin/js/editor.js', array('jquery'), time(), true);
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'plugaddons' ),
			'<strong>' . esc_html__( 'Elementor Plugaddons Extension', 'plugaddons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'plugaddons' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'plugaddons' ),
			'<strong>' . esc_html__( 'Elementor Plugaddons Extension', 'plugaddons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'plugaddons' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'plugaddons' ),
			'<strong>' . esc_html__( 'Elementor Plugaddons Extension', 'plugaddons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'plugaddons' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once(__DIR__ . '/widgets/progressbar-widget.php');
		require_once(__DIR__ . '/widgets/testimonials-widget.php');
		require_once(__DIR__ . '/widgets/carousel.php');
		require_once(__DIR__ . '/widgets/testimonials-carousel-widget.php');

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plugaddons_Progressbar_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plugaddons_Testimonials_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plugaddons_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plugaddons_Testimonials_carousel_Widget() );

	}

    /**
     * Register Widget Category
     *
     * Add widgets Category
     *
     * @since 1.0.0
     *
     * @access public
     */

    public function register_new_category( $elements_manager ) {
        $elements_manager->add_category(
            'plugaddons-category',
            [
                'title' => __( 'Plugaddons', 'plugaddons' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

}

Elementor_Plugaddons_Extension::instance();