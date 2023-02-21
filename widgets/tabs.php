<?php
/*

*/

use Elementor\Plugin;
use Elementor\Controls_Manager;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


class SIG_Tabs extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        add_action( 'elementor/editor/after_enqueue_scripts', function(){
            //wp_enqueue_script( 'sig-tabs-script' );
        } );
    }

    public function get_name() {
		return 'sig-tabs';
	}

	public function get_title() {
		return esc_html__( 'SIG - Tabs', 'sig-elementor-plus' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'sig-category' ];
	}

	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}

    public function get_script_depends() {
		return [ 'sig-tabs-script'];
    }

    public function get_style_depends() {
		return [ 'sig-tabs-style' ];
    }


    //
    protected function register_controls() {

		$this->start_controls_section(
			'section_sig_tabs',
			[
				'label' => esc_html__( 'Tabs', 'sig-elementor-plus' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_responsive_control(
			'tab_type',
			[
				'label' => esc_html__( 'Tab type', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text' => esc_html__( 'Text', 'sig-elementor-plus' ),
					'image' => esc_html__( 'Image', 'sig-elementor-plus' ),
				],
			]
		);

		$repeater->add_control(
			'tab_title',
			[
				'label' => esc_html__( 'Tab title', 'sig-elementor-plus' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab title', 'sig-elementor-plus' ),
				'label_block' => true,
				'separator' => 'before',
				'condition' => [
					'tab_type' => 'text',
				],

			]
		);

		$repeater->add_control(
			'tab_image',
			[
				'label' => esc_html__( 'Tab image', 'sig-elementor-plus' ),
				'type' => Controls_Manager::MEDIA,
				'separator' => 'before',
				'condition' => [
					'tab_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => esc_html__( 'Tab content', 'sig-elementor-plus' ),
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sig-elementor-plus' ),
				'type' => Controls_Manager::WYSIWYG,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Tabs items', 'sig-elementor-plus' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => esc_html__( 'Tab title', 'sig-elementor-plus' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sig-elementor-plus' ),
					],
					[
						'tab_title' => esc_html__( 'Tab title', 'sig-elementor-plus' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sig-elementor-plus' ),
					]
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

        //
		$this->add_responsive_control(
			'tabs_max_width',
			[
				'label' => esc_html__( 'Tabs max width', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
                    '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        //標籤類型（上方、側邊）
		$this->add_control(
			'tab_position',
			[
				'label' => esc_html__( 'Tab position', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'sig-elementor-plus' ),
					'vertical' => esc_html__( 'Vertical', 'sig-elementor-plus' ),
				],
				'prefix_class' => 'sig-tabs-view-',
				'separator' => 'before',

			]
		);

		$this->add_control(
			'tabs_align_horizontal',
			[
				'label' => esc_html__( 'Tab alignment', 'sig-elementor-plus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'' => [
						'title' => esc_html__( 'Start', 'sig-elementor-plus' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sig-elementor-plus' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'sig-elementor-plus' ),
						'icon' => 'eicon-h-align-right',
					],
					'stretch' => [
						'title' => esc_html__( 'Justified', 'sig-elementor-plus' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
				'prefix_class' => 'sig-tabs-alignment-',
				'condition' => [
					'tab_position' => 'horizontal',
				],

			]
		);

		$this->add_control(
			'tabs_align_vertical',
			[
				'label' => esc_html__( 'Tab alignment', 'sig-elementor-plus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'' => [
						'title' => esc_html__( 'Start', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'End', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'stretch' => [
						'title' => esc_html__( 'Justified', 'sig-elementor-plus' ),
						'icon' => 'eicon-v-align-stretch',
					],
				],
				'prefix_class' => 'sig-tabs-alignment-',
				'condition' => [
					'tab_position' => 'vertical',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sig_tabs_style',
			[
				'label' => esc_html__( 'Tabs', 'sig-elementor-plus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label' => esc_html__( 'Navigation width', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sig-tabs-title' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'type' => 'vertical',
				],
			]
		);



		$this->add_control(
			'border_width',
			[
				'label' => esc_html__( 'Border width', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title,
					 {{WRAPPER}} .sig-tab-title:before,
					 {{WRAPPER}} .sig-tab-title:after,
					 {{WRAPPER}} .sig-tabs-content' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border color', 'sig-elementor-plus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title.active,
					 {{WRAPPER}} .sig-tab-title.active:before,
					 {{WRAPPER}} .sig-tab-title.active:after,
					 {{WRAPPER}} .sig-tabs-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background color', 'sig-elementor-plus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .sig-tabs-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		//
		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Tab title', 'sig-elementor-plus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => esc_html__( 'Color', 'sig-elementor-plus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title,
					 {{WRAPPER}} .sig-tab-title a' => 'color: {{VALUE}}',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => esc_html__( 'Active Color', 'sig-elementor-plus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title.active,
					 {{WRAPPER}} .sig-tab-title.active a' => 'color: {{VALUE}}',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .sig-tab-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sig-tab-title',
			]
		);

        $this->add_responsive_control(
			'tab_padding',
			[
				'label' => esc_html__( 'Padding', 'sig-elementor-plus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//
		$this->add_control(
			'heading_image',
			[
				'label' => esc_html__( 'Tab image', 'sig-elementor-plus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_image_width',
			[
				'label' => esc_html__( 'Width', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_image_space',
			[
				'label' => esc_html__( 'Max width', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_image_height',
			[
				'label' => esc_html__( 'Height', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
            'tab_image_object_fit',
			[
				'label' => esc_html__( 'Object Fit', 'sig-elementor-plus' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'tab_image_height[size]!' => '',
				],
				'options' => [
					''      => esc_html__( 'Default', 'sig-elementor-plus' ),
					'fill'  => esc_html__( 'Fill', 'sig-elementor-plus' ),
					'cover' => esc_html__( 'Cover', 'sig-elementor-plus' ),
					'contain' => esc_html__( 'Contain', 'sig-elementor-plus' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sig-tab-title img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .sig-tab-title:not(.active) img',
			]
		);


		$this->add_control(
			'heading_content',
			[
				'label' => esc_html__( 'Tab content', 'sig-elementor-plus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'sig-elementor-plus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sig-tab-content' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .sig-tab-content',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'selector' => '{{WRAPPER}} .sig-tab-content',
			]
		);

        $this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sig-elementor-plus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
    				'$isLinked ' => true
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sig-tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 */
	protected function render() {

		$tabs = $this->get_settings_for_display( 'tabs' );
		$el_id = $this->get_id();
		$id_int = substr( $this->get_id_int(), 0, 3 );

        $this->add_render_attribute( 'sig-tabs',
            [
                'id' => 'sig-tabs-'.$el_id,
                'class' => 'sig-tabs-wrapper'
            ]
        );

		?>
		<div <?php $this->print_render_attribute_string( 'sig-tabs' ); ?>>
			<ul class="sig-tabs-title">
            <?php
				foreach ( $tabs as $index => $item ) {

				    $tab_count = $index + 1;
				    $tab_type = $item['tab_type'];
				    $tab_title = $item['tab_title'];
				    $tab_image = $item['tab_image'];

				    $tab_title_class = ['sig-tab-title'];
				    if( $tab_count === 1 )  $tab_title_class[] = 'active';

				    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				    $this->add_render_attribute( $tab_title_setting_key, [
						//'id' => 'sig-tab-title-' . $id_int . $tab_count,
						'class' => $tab_title_class,
						'data-tab' => $tab_count,
						'role' => 'tab',
					] );

            ?>
				    <li <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>><?php

						if( $tab_type === 'image' ){
    						echo '<img src="'.$tab_image['url'].'">';
						}else{
    						echo esc_html( $tab_title );
    				    }

					?></li>
		    <?php
				}
            ?>
			</ul>
			<div class="sig-tabs-content">
				<?php
				foreach ( $tabs as $index => $item ) {

					$tab_count = $index + 1;

					$tab_content_class = ['sig-tab-content'];
				    if( $tab_count === 1 )  $tab_content_class[] = 'active';

					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
					$this->add_render_attribute( $tab_content_setting_key, [
						//'id' => 'elementor-tab-content-' . $id_int . $tab_count,
						'class' => $tab_content_class,
						'data-tab' => $tab_count,
					] );

					$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );

					?>
					<div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>><?php
						$this->print_text_editor( $item['tab_content'] );
					?></div>
				<?php
				} ?>
			</div>
		</div>
		<?php
	}
}

$widgets_manager->register( new SIG_Tabs() );