<?php
namespace Expectancy\MyPlugin;

defined('ABSPATH') or die(__('You shall not pass!', 'my-plugin-text'));

class Admin {

	public function __construct() {
		add_action('admin_menu', [$this, 'create_admin_menu']);
		add_action('widgets_init', [$this, 'register_widgets']);

		add_action('admin_enqueue_scripts', [$this, 'register_scripts']);
		add_action('admin_enqueue_scripts', [$this, 'register_styles']);
	}

	/**
	 * Create the admin menu and submenu items.
	 */
	public function create_admin_menu() {
		add_menu_page(
			'My Plugin Page Title',
			'Admin Menu Text',
			'manage_options',
			'my-plugin-parent-slug',
			[$this, 'menu_item_1']
		);

		add_submenu_page(
			'my-plugin-parent-slug',
			'My Plugin Page Title',
			'Admin Menu Text',
			'manage_options',
			'my-plugin-parent-slug',
			[$this, 'menu_item_1']
		);

		add_submenu_page(
			'my-plugin-parent-slug',
			'My Plugin Page Title (2)',
			'Admin Menu Text',
			'manage_options',
			'my-plugin-second-item-slug',
			[$this, 'menu_item_2']
		);
	}

	/**
	 * Display the page for the first menu item.
	 */
	public function menu_item_1() {
		// Conditionally load styles as needed.
		wp_enqueue_style('my_plugin_admin_styles');

		// Conditionally load scripts as needed.
		wp_enqueue_script('my_plugin_admin_scripts');

		require_once MY_PLUGIN_PATH . 'views/admin/page-1.php';
	}

	/**
	 * Display the page for the second menu item.
	 */
	public function menu_item_2() {
		// Conditionally load styles as needed.
		wp_enqueue_style('my_plugin_admin_styles');

		// Conditionally load scripts as needed.
		wp_enqueue_script('my_plugin_admin_scripts');

		require_once MY_PLUGIN_PATH . 'views/admin/page-2.php';
	}

	/**
	 * Create widget admin form.
	 */
	public function register_widgets() {
		require_once( MY_PLUGIN_PATH . 'includes/widgets/my_widget.php' );
	}

	/**
	 * Registers admin/back end JavaScript files for use.
	 */
	public function register_scripts() {
		wp_register_script(
			'my_plugin_admin_scripts',
			MY_PLUGIN_URL . 'js/admin/core.js',
			['jquery' /*  , 'dependency1', 'dependency2', 'etc...'  */ ],
			MY_PLUGIN_VERSION
		);
	}

	/**
	 * Registers admin/back end CSS stylesheets for use.
	 */
	public function register_styles() {
		wp_register_style(
			'my_plugin_admin_styles',
			MY_PLUGIN_URL . 'css/admin/styles.css',
			array(),
			MY_PLUGIN_VERSION
		);
	}
}
