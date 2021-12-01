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

    	public function __construct() {

            add_action( 'plugins_loaded' , function(){
                load_plugin_textdomain( 'sig-elementor-plus' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
            } );

            if ( ! function_exists( 'is_plugin_active' ) ) {
                require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
            }

            if ( is_plugin_active( 'elementor/elementor.php' )  ) {

                //新增自訂 widget
                add_action( 'elementor/widgets/widgets_registered', array( $this, 'include_widgets' ) );

                /*
                    對已存在的 widget 新增新的 control
                    https://code.elementor.com/php-hooks/#elementorelementsection_namesection_idbefore_section_end
                    https://github.com/elementor/elementor/issues/6499
                */
                add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', array($this,'ele_add_control') , 10, 2 );

            }
    	}

    	public function include_widgets(){

            $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

            require_once SIG_ELEMENTOR_PLUS_PATH.'inc/base.php';  //base

        	$files = glob( SIG_ELEMENTOR_PLUS_PATH . 'widget/*.php');

            foreach ($files as $file){
                if(file_exists($file)){
                    require_once  $file;
                }
            }

    	}

        public function ele_add_control($element, $args)
        {

            $element->add_responsive_control(
                'icon_box_margin',
                [
                    'label'      => __( 'Margin', 'elementor' ),
                    'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .elementor-icon-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    //'separator' => 'after',
                ]
            );


        }

        public function get_public_post_types( $args = [] ) {
    		$post_type_args = [
    			'show_in_nav_menus' => true, // Default is the value $public.
    		];

    		// Keep for backwards compatibility
    		if ( ! empty( $args['post_type'] ) ) {
    			$post_type_args['name'] = $args['post_type'];
    			unset( $args['post_type'] );
    		}

    		$post_type_args = wp_parse_args( $post_type_args, $args );

    		$_post_types = get_post_types( $post_type_args, 'objects' );

    		$post_types = [];

    		foreach ( $_post_types as $post_type => $object ) {
    			$post_types[ $post_type ] = $object->label;
    		}

    		return $post_types;
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

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'first-category',
		[
			'title' => __( 'First Category', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories',9 );