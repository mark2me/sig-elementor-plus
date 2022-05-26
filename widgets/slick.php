<?php
/*
    Slick
    http://kenwheeler.github.io/slick/
*/

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class SIG_Slick extends \Elementor\Widget_Base {

    public function get_name() {
		return 'slick';
	}

	public function get_title() {
		return esc_html__( 'Slick', 'sig-elementor-plus' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'sig-category' ];
	}

	public function get_keywords() {
		return [ 'slide', 'image' ];
	}

    public function get_script_depends() {
        wp_register_script( 'widget-script-slick', SIG_ELEMENTOR_PLUS_URL.'inc/slick/slick.min.js' , ['jquery'] );

		return [
			'widget-script-slick'
		];
    }

    public function get_style_depends() {
        wp_register_style( 'widget-style-slick', SIG_ELEMENTOR_PLUS_URL.'/inc/slick/slick.css' );
		wp_register_style( 'widget-style-slick-theme', SIG_ELEMENTOR_PLUS_URL.'/inc/slick/slick-theme.css' );

		return [
			'widget-style-slick',
			'widget-style-slick-theme',
		];
    }

    protected function register_controls() {

        $this->start_controls_section(
			'section_images',
			[
				'label' => esc_html__( 'Select images', 'sig-elementor-plus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slide_image',
			[
				'label' => esc_html__( 'Image', 'sig-elementor-plus' ),
				'type' => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'slide_content', [
				'label' => esc_html__( 'Content', 'sig-elementor-plus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
				'show_label' => false,
			]
		);

        $repeater->add_control(
            'slide_content_align',
            [
				'label' => esc_html__( 'Horizontal align', 'sig-elementor-plus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sig-elementor-plus' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sig-elementor-plus' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sig-elementor-plus' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'display:flex; justify-content: {{VALUE}};',
				],
            ]
        );

        $repeater->add_control(
            'slide_content_valign',
            [
				'label' => esc_html__( 'Vertical align', 'sig-elementor-plus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Start', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'End', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-bottom',
					],

				],
				//'prefix_class' => 'elementor-tabs-alignment-',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'display:flex; align-items: {{VALUE}};',
				],

            ]
        );

        $repeater->add_control(
            'slide_content_width',
            [
                'label' => esc_html__( 'Content width (%)', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 35,
                ],
                'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide_content' => 'width: {{SIZE}}{{UNIT}};',
				],

            ]
        );

		$this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Slides', 'sig-elementor-plus' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'show_label' => false
				//'title_field' => '{{{ slide_title }}}',

			]
		);

		$this->end_controls_section();

        // ----- setup ----- //
        $this->start_controls_section(
            'section_setup',
			[
				'label' => esc_html__( 'Setup', 'sig-elementor-plus' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Auto play', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'sig-elementor-plus' ),
				'label_off' => esc_html__( 'Off', 'sig-elementor-plus' ),
				'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplaySpeed',
            [
                'label' => esc_html__( 'Auto play speed (s)', 'sig-elementor-plus' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
                'condition' => [
					'autoplay' => 'yes',
				],

            ]
        );


        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( 'Image size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'cover' => esc_html__( 'Cover', 'sig-elementor-plus' ),
                    'contain' => esc_html__( 'Contain', 'sig-elementor-plus' )
                ] ,
                'default' => 'cover',
                'selectors' => [
					'{{WRAPPER}} .item' => 'background-size: {{VALUE}};',
				],
            ]
        );

        $this->add_responsive_control(
            'aspect_ratio',
            [
                'label' => esc_html__( 'Aspect ratio', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3 / 1' => '3:1',
                    '2 / 1' => '2:1',
                    '4 / 3' => '4:3',
                    '16 / 9' => '16:9',
                    '1 / 1' => '1:1',
                    '3 / 4' => '3:4',
                    '9 / 16' => '9:16',
                    '1 / 2' => '1:2',
                    '1 / 3' => '1:3'
                ] ,
                'default' => '4 / 3',
                'selectors' => [
					'{{WRAPPER}} .item' => 'aspect-ratio: {{VALUE}};',
				],
            ]
        );


        $this->add_responsive_control(
            'arrows',
            [
                'label' => esc_html__( 'Show arrows', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'sig-elementor-plus' ),
				'label_off' => esc_html__( 'Hide', 'sig-elementor-plus' ),
				'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'dots',
            [
                'label' => esc_html__( 'Show dots', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'sig-elementor-plus' ),
				'label_off' => esc_html__( 'Hide', 'sig-elementor-plus' ),
				'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'slidesToShow',
            [
                'label' => esc_html__( '# of slides to show', 'sig-elementor-plus' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_responsive_control(
            'slidesToScroll',
            [
                'label' => esc_html__( '# of slides to scroll', 'sig-elementor-plus' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );

		$this->end_controls_section(); ///


		$this->start_controls_section(
			'section_arrows_style',
			[
				'label' => esc_html__( 'Arrows style', 'sig-elementor-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arrows' => 'yes',
				],
			]
		);

		$this->add_control(
            'arrows_color',
            [
                'label' => esc_html__( 'Arrows color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:before, {{WRAPPER}} .slick-next:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size',
            [
                'label' => esc_html__( 'Arrows size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 15,
                        'max' => 45,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .slick-prev:before, {{WRAPPER}} .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_location',
            [
                'label' => esc_html__( 'Arrows location (%)', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -10,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}%;',
                    '{{WRAPPER}} .slick-next' => 'right: {{SIZE}}%;',
                ],
            ]
        );

		$this->end_controls_section(); ///


        $this->start_controls_section(
			'section_dots_style',
			[
				'label' => esc_html__( 'Dots style', 'sig-elementor-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'dots' => 'yes',
				],
			]
		);

		$this->add_control(
            'dots_color',
            [
                'label' => esc_html__( 'Dots color', 'sig-elementor-plus' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_size',
            [
                'label' => esc_html__( 'Dots size', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin: 0 calc( {{SIZE}}px / 3 + 4px );',
                    '{{WRAPPER}} .slick-dots li button:before' => 'font-size: {{SIZE}}px;',
                ],

            ]
        );


        $this->add_responsive_control(
            'dots_location',
            [
                'label' => esc_html__( 'Dots location', 'sig-elementor-plus' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -35,
                        'max' => 35,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}px;',
                ],
            ]
        );


        $this->end_controls_section(); ///
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
    	$settings = $this->get_settings_for_display();
    	$id = 'slick_'.$this->get_id();


        $this->add_render_attribute('slick-wrapper',
            [
                'id' => $id,
                //'class' => [ 'custom-widget-wrapper-class', settings['custom_class'] ],
            ]
        );

        ?>
        <script>
        jQuery(document).ready(function($) {
            $('#<?php echo $id;?>').slick({
                slidesToShow: 1,
                autoplay: <?php echo ($settings['autoplay']==='yes') ? 'true':'false'; ?>,
                autoplaySpeed: <?php echo (!empty($settings['autoplaySpeed'])) ? $settings['autoplaySpeed'].'000': 3000 ; ?>,
                arrows: <?php echo ($settings['arrows']==='yes') ? 'true':'false'; ?>,
                dots: <?php echo ($settings['dots']==='yes') ? 'true':'false'; ?>,
                slidesToShow: <?php echo (!empty($settings['slidesToShow'])) ? $settings['slidesToShow']:1; ?>,
                slidesToScroll: <?php echo (!empty($settings['slidesToScroll'])) ? $settings['slidesToScroll']: 1; ?>,
                responsive: [
                    <?php foreach( $devices as $d ): ?>
                    {
                        breakpoint: <?php echo $d['value']; ?>,
                        settings: {
                            arrows: <?php echo ($settings['arrows_'.$d['name']]==='yes') ? 'true':'false'; ?>,
                            dots: <?php echo ($settings['dots_'.$d['name']]==='yes') ? 'true':'false'; ?>,
                            slidesToShow: <?php echo (!empty($settings['slidesToShow_'.$d['name']])) ? $settings['slidesToShow_'.$d['name']]:1; ?>,
                            slidesToScroll: <?php echo (!empty($settings['slidesToScroll_'.$d['name']])) ? $settings['slidesToScroll_'.$d['name']]: 1; ?>,
                        }
                    },
                    <?php endforeach; ?>
                ]
            })
        });
        </script>
        <div <?php echo $this->get_render_attribute_string('slick-wrapper'); ?>>
        <?php

		foreach( $settings['slides'] as $slide ){
    		$img_url = $slide['slide_image']['url'];
    		$content =  $slide['slide_content'];
    		echo '<div class="item elementor-repeater-item-'.$slide['_id'].'" style="background-image:url('.$img_url.');background-repeat: no-repeat;background-position: center;">';
    		if( !empty($content) ) echo '<div class="slide_content">'.$content.'</div>';
    		echo '</div>';
		}
		?>
        </div>
        <?php

	}

}

$widgets_manager->register( new SIG_Slick() );