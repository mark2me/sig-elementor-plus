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
                'label' => __('Max show words', 'sig-elementor-plus'),
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
                'label' => __( 'Icon type', 'sig-elementor-plus' ),
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
                'default' => 'font',
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
                'default' => 'A',
                'condition' => [
                    'icon_type' => 'font',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Icon border', 'sig-elementor-plus' ),
                'selector' => '{{WRAPPER}} .sig-timeline-icon',
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
                    '{{WRAPPER}} .sig-timeline-icon' => 'left: 50%; right: auto; transform: translateX(-50%);border-radius:{{SIZE}}{{UNIT}};',
                    '(mobile) {{WRAPPER}} .sig-timeline-icon' => 'left: 0;transform: initial;'
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
                    '{{WRAPPER}} .sig-timeline-box:before' => 'width:{{SIZE}}{{UNIT}};',
                    '(desktop) {{WRAPPER}} .sig-timeline-box:before' => 'left: 50%; right: auto; transform: translateX(-50%);',
                    '(tablet) {{WRAPPER}} .sig-timeline-box:before' => 'left: 50%; right: auto; transform: translateX(-50%);',
                    '(mobile) {{WRAPPER}} .sig-timeline-box:before' => 'left:calc( {{icon_width_mobile.SIZE}}{{icon_width_mobile.UNIT}} / 2 );transform: initial;',
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
                    '{{WRAPPER}} .sig-timeline-icon' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
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


        // ----- Card style ----- //
        $this->start_controls_section(
            'section_card_style',
            [
                'label' => __( 'Card style', 'sig-elementor-plus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label' => __( 'Arrow size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','em' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 30,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-body:before' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_top',
            [
                'label' => __( 'Arrow top margin', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-body:before' => 'top: {{SIZE}}{{UNIT}}; right: calc( 100% - {{arrow_size.SIZE}}{{arrow_size.UNIT}} );',
                    '(desktop) {{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-body:before' => 'left: calc( 100% - {{arrow_size.SIZE}}{{arrow_size.UNIT}});',
                    '(mobile) {{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-body:before' => 'left: auto;',
                ],
            ]
        );


        $this->add_control(
            'card_bgcolor',
            [
                'label' => esc_html__( 'Card background color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-body' => 'background-color:{{VALUE}}',
                    //'{{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-body:before' => 'border-left-color:{{VALUE}}',
                    '{{WRAPPER}} .sig-timeline-item .sig-timeline-body:before' => 'border-color:{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => __( 'Card padding', 'sig-elementor-plus' ),
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
                    '{{WRAPPER}} .sig-timeline-body' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label' => __( 'Card margin', 'sig-elementor-plus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 5,
                    'right' => 55,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => '%',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-body' => 'width: calc( 100% - {{RIGHT}}{{UNIT}} - {{LEFT}}{{UNIT}} );margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '(desktop) {{WRAPPER}} .sig-timeline-item:nth-child(even) .sig-timeline-body' => 'width: calc( 100% - {{RIGHT}}{{UNIT}} - {{LEFT}}{{UNIT}} );margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    '(mobile) {{WRAPPER}} .sig-timeline-item:nth-child(even) .sig-timeline-body' => 'width: calc( 100% - {{RIGHT}}{{UNIT}} - {{LEFT}}{{UNIT}} );margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label' => __('Card border radius', 'sig-elementor-plus'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-body' => 'border-radius:{{SIZE}}{{UNIT}};',
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

        $this->add_responsive_control(
            'show_title',
            [
                'label' => __( 'Show Title', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sig-elementor-plus' ),
                'label_off' => __( 'No', 'sig-elementor-plus' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Title style', 'sig-elementor-plus' ),
				'name' => 'post_title',
				'selector' => '{{WRAPPER}} .sig-timeline-title',
                'condition' => [
                    'show_title' => 'yes',
                ],
			]
		);

        $this->add_control(
            'post_title_color',
            [
                'label' => __( 'Title color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'condition' => [
                    'show_title' => 'yes',
                ],
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-title' => 'color:{{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'show_content',
            [
                'label' => __( 'Show content', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sig-elementor-plus' ),
                'label_off' => __( 'No', 'sig-elementor-plus' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Content style', 'sig-elementor-plus' ),
				'name' => 'post_content',
				'selector' => '{{WRAPPER}} .sig-timeline-content',
                'condition' => [
                    'show_content' => 'yes',
                ],
			]
		);

        $this->add_control(
            'post_content_color',
            [
                'label' => __( 'Content color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'condition' => [
                    'show_content' => 'yes',
                ],
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-content' => 'color:{{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'show_read_more',
            [
                'label' => __( 'Show read more', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sig-elementor-plus' ),
                'label_off' => __( 'No', 'sig-elementor-plus' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Read more style', 'sig-elementor-plus' ),
				'name' => 'post_more',
				'selector' => '{{WRAPPER}} .sig-timeline-more',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
			]
		);

        $this->add_control(
            'post_more_color',
            [
                'label' => __( 'Read more color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eeeeee',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-more' => 'color:{{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'show_date',
            [
                'label' => __( 'Show day', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sig-elementor-plus' ),
                'label_off' => __( 'No', 'sig-elementor-plus' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'post_date_margin',
            [
                'label' => __( 'Day margin', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'selectors' => [
                    '(desktop) {{WRAPPER}} .sig-timeline-date' => 'position: absolute; width: 100%;top: 18px;',
                    '(mobile) {{WRAPPER}} .sig-timeline-date' => 'position: initial; width: auto;float: right;',
                    '{{WRAPPER}} .sig-timeline-item:nth-child(odd) .sig-timeline-date' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .sig-timeline-item:nth-child(even) .sig-timeline-date' => 'right: calc( 100% + {{SIZE}}{{UNIT}} ); text-align:right;'
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Date style', 'sig-elementor-plus' ),
				'name' => 'post_date',
				'selector' => '{{WRAPPER}} .sig-timeline-date',
                'condition' => [
                    'show_date' => 'yes',
                ],
			]
		);

        $this->add_control(
            'post_date_color',
            [
                'label' => __( 'Date color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#999999',
                'condition' => [
                    'show_date' => 'yes',
                ],
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .sig-timeline-date' => 'color:{{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
        //////

    }

    protected function render() {
        //
        $settings = $this->get_settings_for_display();

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

        $min = false;
        foreach($devices as $index=>$d){
            if( $min === false ){
                $min = $d;
            }else if( isset($min['value']) && $min['value'] > $d['value'] ){
                $min = $d;
            }
        }

        $line_width = $settings['line_width']['size'];
        if( !empty($settings['line_width_'.$min['name']]) ){
            $line_width_s = $settings['line_width_'.$min['name']]['size'];
        }else{
            $line_width_s = $line_width;
        }

        $icon_width = $settings['icon_width']['size'];
        if( !empty($settings['icon_width_'.$min['name']]) ){
            $icon_width_s = $settings['icon_width_'.$min['name']]['size'];
        }else{
            $icon_width_s = $icon_width;
        }

//print_r( $settings );

        // get settings
        $el_id = 'sig_timeline_'.$this->get_id();
        $this->add_render_attribute('timeline-wrapper',
            [
                'id' => $el_id,
                'class' => [ 'sig-timeline-box' ],
            ]
        );


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
            height: 100%;
            top: 0;
            bottom: 0;
        }

        .sig-timeline-icon{
            position: absolute;
            /*box-shadow: 0 0 0 4px #ffffff, inset 0 2px 0 rgb(0 0 0 / 8%), 0 3px 0 4px rgb(0 0 0 / 5%);*/
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sig-timeline-body{
            position: relative;
            width: 100%;
        }

        .sig-timeline-body:before{
            content: "";
            position: absolute;
            top: 24px;
            height: 0;
            width: 0;
            border-style: solid;
            transform: rotate(-45deg);
        }

        .sig-timeline-item:after, .sig-timeline-body:after{
            content: ""; clear: both; display: table;
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
                <div class="sig-timeline-body">
                    <?php if ( 'yes' === $settings['show_title'] ): ?>
                    <div class="sig-timeline-title"><?php the_title(); ?></div>
                    <?php endif; ?>
                    <?php if ( 'yes' === $settings['show_content'] ): ?>
                    <div class="sig-timeline-content"><?php echo wp_trim_words( get_the_content(), $settings['post_word_count'], ' ...' ); ?></div>
                    <?php endif; ?>
                    <?php if ( 'yes' === $settings['show_read_more'] ): ?>
                    <a class="sig-timeline-more" href="<?php the_permalink(); ?>">Read more</a>
                    <?php endif; ?>
                    <?php if ( 'yes' === $settings['show_date'] ): ?>
                    <span class="sig-timeline-date"><?php echo get_the_date();?></span>
                    <?php endif; ?>
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
