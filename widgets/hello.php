<?php

class Hello_World_Widget_1 extends \Elementor\Widget_Base {

    public function get_name() {
		return 'hello_sig_widget_1';
	}

	public function get_title() {
		return esc_html__( 'Hello World 1', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'sig-category' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function render() {
		?>

		<p> Hello World </p>

		<?php
	}

}

$widgets_manager->register(new Hello_World_Widget_1());