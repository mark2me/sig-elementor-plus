<?php
/*
Plugin Name: ElementorPlus
Description: Elementor 功能補強工具包
Author: github.com/mark2me
Author URI: https://github.com/mark2me
Version: 1.0
Text Domain: sig-elementor-plus
Domain Path: /languages
*/

define( 'SIG_ELEMENTOR_PLUS_PATH', plugin_dir_path( __FILE__ ) );
define( 'SIG_ELEMENTOR_PLUS_URL', plugin_dir_url( __FILE__ ) );


if ( ! class_exists( 'SIG_Elementor_Plus' ) ) {

	class SIG_Elementor_Plus {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

    	public function __construct() {

            add_action( 'plugins_loaded' , function(){
                load_plugin_textdomain( 'sig-elementor-plus' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
            } );

            if ( ! function_exists( 'is_plugin_active' ) ) {
                require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
            }

            if ( is_plugin_active( 'elementor/elementor.php' )  ) {
                add_action( 'elementor/elements/categories_registered', [ $this, 'register_my_category' ], 9 );
                add_action( 'elementor/widgets/register', [ $this, 'register_my_widgets' ] );
                add_action( 'elementor/controls/register', [ $this, 'register_my_controls' ] );
            }
    	}


        public function register_my_category( $elements_manager ) {

        	$elements_manager->add_category(
        		'sig-category',
        		[
        			'title' => __( 'SIG', 'sig-elementor-plus' ),
        			'icon' => 'fa fa-plug',
        		]
        	);
        }

    	public function register_my_widgets($widgets_manager) {

            require_once SIG_ELEMENTOR_PLUS_PATH . 'inc/base.php';  //base

        	$files = glob( SIG_ELEMENTOR_PLUS_PATH . 'widgets/*.php');

            foreach ($files as $file){
                if(file_exists($file)){
                    require_once  $file;
                }
            }

    	}

        public function register_my_controls( $controls_manager ) {

            /*
            require_once( SIG_ELEMENTOR_PLUS_PATH . 'controls/*.php' );
            $controls_manager->register( new Control_1() );
            */
        }


    	public function query_posts($settings=[]) {
	        $query_args = [
    	        'post_type'           => ( !empty($settings['post_type']) ) ? $settings['post_type']: 'post',
                'orderby'             => ( !empty($settings['orderby']) ) ? $settings['orderby']: 'date',
                'order'               => ( !empty($settings['order']) ) ? $settings['order']: 'desc',
                'ignore_sticky_posts' => 1,
                'post_status'         => 'publish',
                'posts_per_page'      => ( !empty($settings['posts_per_page']) ) ? $settings['posts_per_page']: 5,
            ];

            return new \WP_Query($query_args);
    	}

    }

    new SIG_Elementor_Plus();
}


