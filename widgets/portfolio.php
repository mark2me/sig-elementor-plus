<?php

//namespace Elementor;

//use Elementor\Controls_Manager;
//use Elementor\Scheme_Color;
//use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class SIG_Portfolio extends SIG_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_name() {
        return 'sig-portfolio';
    }

    public function get_title() {
        return 'SIG';
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'sig-category' ];
    }

    public function get_keywords() {
        return [ 'posts', 'cpt', 'item', 'loop', 'portfolio', 'custom post type' ];
    }

    protected function register_controls() {

        // section start
        $this->start_controls_section(
            'section_title',
			[
				'label' => esc_html__( 'Title', 'sig-elementor-plus' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->register_controls_text('text1');
        $this->register_controls_textarea('textarea1');

        $this->end_controls_section(); ///


        ////
        $this->start_controls_section(
            'sig_section_2',
            [
                'label' => __( 'Layout2', 'elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->register_controls_columns();


        $this->register_controls_gallery();


        $this->register_controls_image_size();



        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'sig-ele-wrapper');
        $this->add_render_attribute('row', 'class', 'row');

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div <?php echo $this->get_render_attribute_string('row'); ?>>
                <h3><?php echo $settings['text']?></h3>
                <div class="elementor-grid">
<?php
                foreach ($settings['images'] as $img)
                {
?>
                <div class="column-item portfolio-entries">
                    <div id="img-<?php echo $img['id']?>" <?php post_class('portfolio-image'); ?>><img src="<?php echo $img['url']?>">
                    </div>
                </div>
<?php
                }
                ?>
                </div>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new SIG_Portfolio());