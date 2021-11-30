<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;

abstract class SIG_Base extends Elementor\Widget_Base {

    protected function register_controls_text($id='text',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Text', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Your Text', 'elementor' ),
                'default' => '',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
    }


    protected function register_controls_textarea($id='textarea',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Content', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'rows' => '5',
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
            ]
        );
    }


    protected function register_controls_media($id='medias',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    }

    protected function register_controls_columns($id='columns',$setting=array()){

        $this->add_responsive_control(
            $id,
            [
                'label' => __( 'Columns', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'prefix_class' => 'elementor-grid%s-',
                'frontend_available' => true,
                'selectors' => (isset($setting['selectors'])) ? $setting['selectors']: array() ,
            ]
        );
    }

    protected function register_controls_gallery($id='images',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => esc_html__( 'Add Images', 'elementor' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
    }



    protected function register_controls_select($id='select',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Select', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => (isset($setting['options'])) ? $setting['options']: array() ,
                'default' => 'classic',

            ]
        );
    }

    protected function register_controls_repeater($id='repeater',$setting=array()){

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'spicy_pro_text',
            [
                'label' => __( 'Text', 'Spicy-extension' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Your Text', 'Spicy-extension' ),
                'default' => __( '', 'Spicy-extension' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'spicy_image_list',
            [
                'label' => __('Images','Spicy-extension'),
                'type' => Controls_Manager::REPEATER,
                'label_block' => true,
                'separator' => 'default',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{spicy_pro_text }}}',
            ]
        );
    }

}