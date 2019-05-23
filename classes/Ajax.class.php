<?php
namespace Expectancy\MyPlugin;

defined('ABSPATH') or die(__('You shall not pass!', 'my-plugin-text'));

class Ajax {
    /**
     * Nonce name for AJAX calls.
     */
    const NONCE = 'my_plugin_nonce';

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'send_data']);
        add_action('wp_enqueue_scripts', [$this, 'send_data']);

        // List of AJAX actions
        add_action('wp_ajax_my_plugin_ajax_action', [$this, 'ajax_action']);
        add_action('wp_ajax_nopriv_my_plugin_ajax_action', [$this, 'ajax_action']);
    }

    /**
     * Make the nonce and WP's admin AJAX url available in JavaScript files.
     *
     * @return [type] [description]
     */
    public function send_data() {
        $send_data = [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce(self::NONCE),
        ];

        if (is_admin()) {
            wp_localize_script('my_plugin_admin_scripts', 'myPluginAjax', $send_data);
        } else {
            wp_localize_script('my_plugin_scripts', 'myPluginAjax', $send_data);
        }
    }

    public function ajax_action() {
        $this->verify_nonce();

        // Do something
    }

    public function verify_nonce() {
        if (!check_ajax_referer(self::NONCE, 'nonce')) {
            wp_send_json_error([
                'message' => __('Verification failed. Reload the page and try again.', 'my-plugin-text'),
            ]);
        }
    }
}
