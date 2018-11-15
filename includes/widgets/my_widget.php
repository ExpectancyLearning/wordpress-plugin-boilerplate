<?php
/**
 *  WP_Widget Class
 */
class My_Widget extends WP_Widget {

	function __construct() {
		$widget_ops   = array('description' => __('This is what this widget does.', 'my-plugin-text'));
		parent::__construct('My_Widget', __('My Widget', 'my-plugin-text'), $widget_ops);
	}

	function widget($args, $instance) {

		//
		// Do all the fun stuff here.
		//

	}

	// admin form save
	function update($new_instance, $old_instance) {

		$instance = wp_parse_args( (array)$new_instance, self::widget_defaults($old_instance) );

		return $instance;
	}

	// admin form load
	function form($instance) {

		$instance = wp_parse_args( (array)$instance, self::widget_defaults() );

		extract($instance);

		require MY_PLUGIN_PATH . 'views/admin/my-widget-form.php';

	}

	static private function widget_defaults( $old_vals = array() ) {
		return array(
			'title' => (isset($old_vals['title'])) ? strip_tags( $old_vals['title'] ) : __('It is my widget', 'my-plugin-text'),
			'setting1' => (isset($old_vals['setting1'])) ? (int)strip_tags( $old_vals['setting1'] ) : 0,
		);
	}

}

register_widget( 'My_Widget' );
