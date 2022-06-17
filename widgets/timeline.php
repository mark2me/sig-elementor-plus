<?php
/*

*/

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class SIG_Timeline extends \Elementor\Widget_Base {

    public function get_name() {
        return 'timeline';
    }

    public function get_title() {
        return esc_html__( 'SIG - Timeline', 'sig-elementor-plus' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'sig-category' ];
    }

    public function get_keywords() {
        return [ 'post', 'image' ];
    }

    protected function register_controls() {

        // ----- post ----- //
        $this->start_controls_section(
            'section_posts',
            [
                'label' => esc_html__( 'Post', 'sig-elementor-plus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Post Types', 'sig-elementor-plus'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => SIG_Elementor_Plus::get_all_post_type_options([''=>'自選文章ID']),

            ]
        );

        $this->add_control(
            'post_in',
            [
                'label' => __('Post In', 'sig-elementor-plus'),
                'description' => __('Provide a comma separated list of Post IDs to display in the grid.', 'sig-elementor-plus'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'post_type' => '',
                ],
            ]
        );

        $this->add_control(
            'post_word_count',
            [
                'label' => __('Max show numbers', 'sig-elementor-plus'),
                'type' => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Max post show', 'sig-elementor-plus'),
                'description' => __( 'Select how many posts you want to display', 'sig-elementor-plus' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'condition' => [
                    'post_type!' => '',
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'sig-elementor-plus'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => __('Ascending', 'sig-elementor-plus'),
                    'DESC' => __('Descending', 'sig-elementor-plus'),
                ),
                'default' => 'ASC',
            ]
        );

        $this->end_controls_section();
        ///

        // ----- icon ----- //
        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon', 'sig-elementor-plus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon type', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'fafont' => [
                        'title' => __( 'Font Icon', 'sig-elementor-plus' ),
                        'icon' => 'fa fa-star',
                    ],
                    'font' => [
                        'title' => __( 'text', 'sig-elementor-plus' ),
                        'icon' => 'fa fa-font',
                    ],
                ],
                'default' => 'font_icon',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'icon_fa',
            [
                'label' => __( 'Select font icon', 'sig-elementor-plus' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'fafont',
                ],

            ]
        );

        $this->add_control(
            'icon_font',
            [
                'label' => __( 'Select text', 'sig-elementor-plus' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Your Text', 'sig-elementor-plus' ),
                'default' => '',
                'condition' => [
                    'icon_type' => 'font',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __('Icon border radius', 'sig-elementor-plus'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-icon' => 'border-radius:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        ///

        // ----- line style ----- //
        $this->start_controls_section(
            'section_line_style',
            [
                'label' => esc_html__( 'Line style', 'sig-elementor-plus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'line_width',
            [
                'label' => esc_html__( 'Line width', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 30,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-box::before' => 'width:{{SIZE}}{{UNIT}};margin-left: calc( {{SIZE}}{{UNIT}} / 2 * (-1) );',
                ],
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => esc_html__( 'Line color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#aaaaaa',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-box::before' => 'background-color:{{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();
        //////


        // ----- icon style ----- //
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon style', 'sig-elementor-plus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Width', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-icon' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; margin-left: calc( {{SIZE}}{{UNIT}} / 2 * (-1) );',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999999',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-icon i, {{WRAPPER}} .sig-timeline-icon span' => 'color:{{VALUE}}',
                ],
                'condition' => [
                    'icon_type' => ['fafont','font'],
                ],
            ]
        );

        $this->add_control(
            'icon_bgcolor',
            [
                'label' => esc_html__( 'Background color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#75ce66',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-icon' => 'background-color:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_fontsize',
            [
                'label' => esc_html__( 'Size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 12,
                'max' => 100,
                'step' => 1,
                'default' => 20,
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-icon i, {{WRAPPER}} .sig-timeline-icon span' => 'font-size:{{VALUE}}px',
                ],
                'condition' => [
                    'icon_type' => ['fafont','font'],
                ],
            ]
        );

        $this->end_controls_section();
        //////


        // ----- post style ----- //
        $this->start_controls_section(
            'section_post_style',
            [
                'label' => __( 'Post style', 'sig-elementor-plus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_title_color',
            [
                'label' => esc_html__( 'Title color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content .title' => 'color:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_arrow_size',
            [
                'label' => __( 'Post arrow size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content:before' => 'border: {{SIZE}}{{UNIT}} solid transparent;',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_arrow_top',
            [
                'label' => __( 'Post arrow top space', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_title_size',
            [
                'label' => esc_html__( 'Title size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 12,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content .title' => 'font-size:{{VALUE}}px',
                ],
            ]
        );

        $this->add_control(
            'post_bgcolor',
            [
                'label' => esc_html__( 'Content Background color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content' => 'background-color:{{VALUE}}',
                    '{{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-content:before' => 'border-left-color:{{VALUE}}',
                    '{{WRAPPER}} .sig-timeline-item:nth-child(even) .sig-timeline-content:before' => 'border-right-color:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_padding',
            [
                'label' => __( 'Content padding', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_space',
            [
                'label' => __( 'Content space', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-item' => 'margin: {{SIZE}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_margin',
            [
                'label' => __( 'Content margin', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content' => 'width: calc( 50% - {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .sig-timeline-date' => 'left: calc( 100% + {{SIZE}}{{UNIT}} * 2 );'
                ],
            ]
        );



        $this->end_controls_section();
        //////

    }

    protected function render() {

        // get devices breakpoints
        $active_breakpoints = Elementor\Plugin::$instance->breakpoints->get_active_breakpoints();
        $devices = [];
        foreach($active_breakpoints as $name=>$info){
            $devices[] = [
                'name' => $name,
                'label' => $info->get_label(),
                'value' => $info->get_value()
            ];
        }

        // get settings
        $el_id = 'sig_timeline_'.$this->get_id();
        $this->add_render_attribute('timeline-wrapper',
            [
                'id' => $el_id,
                'class' => [ 'sig-timeline-box' ],
            ]
        );

        $settings = $this->get_settings_for_display();
        $query_args = SIG_Elementor_Plus::query_args($settings);
        $loop = new \WP_Query($query_args);

        ?>
        <style type="text/css">
        .sig-timeline-box{
            position: relative;
        }
        .sig-timeline-box:before{
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
        }

        .sig-timeline-icon{
            position: absolute;
            left: 50%;
            box-shadow: 0 0 0 4px #ffffff, inset 0 2px 0 rgb(0 0 0 / 8%), 0 3px 0 4px rgb(0 0 0 / 5%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sig-timeline-content{
            position: relative;
            width: 40%;
        }

        .sig-timeline-content:before{
            content: "";
            position: absolute;
            top: 24px;
            left: 100%;
            height: 0;
            width: 0;
        }

        .sig-timeline-item:nth-child(even) .sig-timeline-content{
            float: right;
        }

        .sig-timeline-item:nth-child(even) .sig-timeline-content:before{
            left: auto;
            right: 100%;
        }

        .sig-timeline-item:after, .sig-timeline-content:after{
            content: ""; clear: both; display: table;
        }
        .sig-timeline-date{
            position: absolute;
            width: 100%;
            top: 18px;
        }

        </style>
        <div <?php echo $this->get_render_attribute_string('timeline-wrapper'); ?>>

            <?php
                if ( $loop->have_posts() ):
                    while ($loop->have_posts()) : $loop->the_post();

                        $icon_type = $settings['icon_type'];
                        if( $icon_type == 'fafont' && !empty($settings['icon_fa']['value']) ){
                            $icon = '<i class="'.$settings['icon_fa']['value'].'"></i>';
                        }else if( $icon_type == 'image' && !empty($settings['icon_image']) ){
                            $icon = '<img src="'. wp_get_attachment_image_url($settings['icon_image']['id']) .'">';
                        }else if( $icon_type == 'font' && !empty($settings['icon_font']) ){
                            $icon = '<span>'.$settings['icon_font'].'</span>';
                        }else{
                            $icon = '';
                        }
            ?>
            <div class="sig-timeline-item post-<?php echo get_the_ID();?>">
                <div class="sig-timeline-icon <?php echo $icon_type;?>"><?php echo $icon;?></div>
                <div class="sig-timeline-content">
                    <div class="title"><?php the_title(); ?></div>
                    <div><?php echo wp_trim_words( get_the_content(), $settings['post_word_count'], ' ...' ); ?></div>
                    <a href="<?php the_permalink(); ?>" class="sig-timeline-more">Read more</a>
                    <span class="sig-timeline-date"><?php echo get_the_date();?></span>
                </div>
            </div>
            <?php
                    endwhile;
                endif;
            ?>

        </div>
        <?php

    }

}

$widgets_manager->register( new SIG_Timeline() );
