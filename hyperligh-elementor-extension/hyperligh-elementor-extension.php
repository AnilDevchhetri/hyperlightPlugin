<?php
/**
 * Plugin Name: HyperLight Elementor Extension
 * Plugin URI: https://hyperlightcorp.com/
 * Description: A custom elementor widget
 * Version: 1.0.0
 * Author: SitaChhetri
 * Author URI: http://sitachhetri.com.np/
 * Text Domain: hyperlight-elementor-elements
 */
if( ! defined( 'ABSPATH' ) ) exit();
final class Hyperlight_Elementor_Widget {

    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    // Minimum PHP Version
    const MINIMUM_PHP_VERSION = '7.0';

    // Instance
    private static $_instance = null;

        /**
    * SIngletone Instance Method
    * @since 1.0.0
    */
    public static function instance() {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
      /**
    * Define Plugin Constants
    * @since 1.0.0
    */
    public function define_constants() {
        define( 'MYEW_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
        define( 'MYEW_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
    }

    public function __construct(){
        // Call Constants Method
        $this->define_constants();
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts_styles' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

    }


    public function scripts_styles() {
    
        // wp_register_style( 'myew-style', MYEW_PLUGIN_URL . 'assets/css/public.min.css', [], rand(), 'all' );
        // wp_register_script( 'myew-script', MYEW_PLUGIN_URL . 'assets/js/public.min.js', [ 'jquery' ], rand(), true );

        // wp_enqueue_style( 'myew-style' );
        // wp_enqueue_script( 'myew-script' );
    }


      /**
    * Load Text Domain
    * @since 1.0.0
    */
    public function i18n() {
        load_plugin_textdomain( 'hyperlight-elementor-elements', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
     }


         /**
    * Initialize the plugin
    * @since 1.0.0
    */
    public function init() {
        // Check if the ELementor installed and activated
        if( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        if( ! version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        add_action( 'elementor/init', [ $this, 'init_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }
  

     /**
    * Init Widgets
    * @since 1.0.0
    */
    public function init_widgets() {
        require_once MYEW_PLUGIN_PATH . '/widgets/our_solution.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/video_hero_section.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/card_impact.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/product_list.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/careers.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/breadcrumbs_img_background.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/news.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/events.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/image_paragraph.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/jobs_list.php';
        require_once MYEW_PLUGIN_PATH . '/widgets/article.php';

    }
   
     /**
    * Init Category Section
    * @since 1.0.0
    */
    public function init_category() {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'hyperlight-for-elementor',
            [
                'title' => 'HyperLight Elements'
            ],
            
        );
    }


      /**
    * Admin Notice
    * Warning when the site doesn't have Elementor installed or activated
    * @since 1.0.0
    */
    public function admin_notice_missing_main_plugin() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated', 'raysittech-elementor-elements' ),
            '<strong>'.esc_html__( 'HyperLight Elementor Widget', 'https://hyperlightcorp.com/' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'raysittech-elementor-elements' ).'</strong>'
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }


    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required Elementor version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_elementor_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'raysittech-elementor-elements' ),
            '<strong>'.esc_html__( 'HyperLight Elementor Widget', 'hyperlight-elementor-elements' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'hyperlight-elementor-elements' ).'</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }


    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required PHP version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_php_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'raysittech-elementor-elements' ),
            '<strong>'.esc_html__( 'My Elementor Widget', 'raysittech-elementor-elements' ).'</strong>',
            '<strong>'.esc_html__( 'PHP', 'raysittech-elementor-elements' ).'</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }
    
    
}


Hyperlight_Elementor_Widget::instance();