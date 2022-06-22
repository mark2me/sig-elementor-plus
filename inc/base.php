<?php
/*
    https://developers.elementor.com/elementor-controls/

*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
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

    protected function register_controls_number($id='number',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Number', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 100,
                'step' => 5,
                'default' => 10,
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

    protected function register_controls_wysiwyg($id='wysiwyg',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'elementor' ),
                'placeholder' => __( 'Type your description here', 'elementor' ),
            ]
        );
    }

    protected function register_controls_code($id='code',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Custom HTML', 'elementor' ),
                'type' => Controls_Manager::CODE,
                'language' => 'html',
                'rows' => 20,
            ]
        );
    }

    protected function register_controls_hidden($id='hidden',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'View', 'elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
    }

    protected function register_controls_switcher($id='switcher',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Show', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'elementor' ),
                'label_off' => __( 'Hide', 'elementor' ),
                'return_value' => 'yes',
                'default' => '',
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

    protected function register_controls_select2($id='select2',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Select', 'elementor' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => (isset($setting['options'])) ? $setting['options']: array() ,
                'default' => [],
            ]
        );
    }

    protected function register_controls_choose($id='choose',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
    }

    protected function register_controls_color($id='color',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => (isset($setting['selectors'])) ? $setting['selectors']: array(),
            ]
        );
    }

    protected function register_controls_icon($id='icon',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Icons', 'elementor' ),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-linkedin',
                    'fa fa-pinterest',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-twitter',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-facebook',
            ]
        );
    }

    protected function register_controls_font($id='font',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Font', 'elementor' ),
                'type' => Controls_Manager::FONT,
                'default' => "'Open Sans', sans-serif",
                'selectors' => (isset($setting['selectors'])) ? $setting['selectors']: array(),
            ]
        );
    }

    protected function register_controls_datetime($id='datetime',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Date', 'elementor' ),
                'type' => Controls_Manager::DATE_TIME,
            ]
        );
    }

    protected function register_controls_animation($id='animation',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Animation', 'elementor' ),
                'type' => Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );
    }

    protected function register_controls_hover_animation($id='hover_animation',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Hover Animation', 'elementor' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
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

    //////////////// Multiple Controls //////////////////////////////
    protected function register_controls_url($id='url',$setting=array()){
        $this->add_control(
            $id,
            [
                'label' => __( 'Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elementor' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
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

    protected function register_controls_image_dimension($id='image_dimension',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Image Dimension', 'elementor' ),
                'type' => Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'elementor' ),
                'default' => [
                    'width' => '',
                    'height' => '',
                ],
            ]
        );
    }

    protected function register_controls_icons($id='icons',$setting=array()){

        $this->add_control(
            $id,
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
    }

    /////////////// Unit Controls ////////////////////
    protected function register_controls_slider($id='slider',$setting=array()){

        $this->add_responsive_control(
            $id,
            [
                'label' => __( 'Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => (isset($setting['selectors'])) ? $setting['selectors']: array(),
            ]
        );
    }

    protected function register_controls_margin($id='margin',$selectors=''){

        $this->add_responsive_control(
            $id,
            [
                'label' => __( 'Margin', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} '.$selectors => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    protected function register_controls_padding($id='padding',$selectors=''){

        $this->add_responsive_control(
            $id,
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} '.$selectors => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    //////////////  Group Controls /////////////////
    protected function register_controls_typography($id='typography',$selectors='{{WRAPPER}} .text'){   //排版樣式

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => $id,
                'label' => __( 'Typography', 'elementor' ),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => $selectors,
            ]
        );
    }

    protected function register_controls_text_shadow($id='text_shadow',$selectors='{{WRAPPER}} .wrapper'){

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => $id,
                'label' => __( 'Text Shadow', 'elementor' ),
                'selector' => $selectors,
            ]
        );
    }

    protected function register_controls_box_shadow($id='box_shadow',$selectors='{{WRAPPER}} .wrapper'){

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => $id,
                'label' => __( 'Box Shadow', 'elementor' ),
                'selector' => $selectors,
            ]
        );
    }

    protected function register_controls_border($id='border',$selectors='{{WRAPPER}} .wrapper'){

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => $id,
                'label' => __( 'Border', 'elementor' ),
                'selector' => $selectors,
            ]
        );
    }

    protected function register_controls_background($id='background',$selectors='{{WRAPPER}} .wrapper'){

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => $id,
                'label' => __( 'Background', 'elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => $selectors,
            ]
        );
    }

    protected function register_controls_image_size($id='image_size',$setting=array()){

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => $id, // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [ 'custom' ],
                'include' => [],
                'default' => 'full',
            ]
        );
    }

    //////////////  custom //////////////
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


}