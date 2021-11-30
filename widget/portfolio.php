<?php

//namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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
        return 'SIG 文章作品集';
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'posts', 'cpt', 'item', 'loop', 'portfolio', 'custom post type' ];
    }

    protected function _register_controls() {

        // section start
        $this->start_controls_section(
            'sig_section_layout',
            [
                'label' => __( 'Layout', 'elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->register_controls_text();

        //$this->register_controls_textarea();

        $this->register_controls_columns();

        //$this->register_controls_media();

        $this->register_controls_gallery();

        $this->register_controls_select(
            'select',
            [
                'options' => [
                    'classic' => __( 'Classic', 'elementor' ),
                    'pro' => __( 'Pro', 'elementor' )
                ]
            ]
        );

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

$widgets_manager->register_widget_type(new SIG_Portfolio());