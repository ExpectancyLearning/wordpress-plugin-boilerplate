<?php
namespace Expectancy\MyPlugin;

defined('ABSPATH') or die(__('You shall not pass!', 'my-plugin-text'));

class Widget {

	public function __construct() {
		add_action( 'widgets_init',array( $this, 'register_widgets' ) );
	}

	/**
	 * Load front side widget
	 */
	public function register_widgets() {
		require_once( MY_PLUGIN_PATH . 'includes/widgets/my_widget.php' );
	}

}
