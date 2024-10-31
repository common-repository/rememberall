<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.wp-news.de
 * @since      1.0.0
 *
 * @package    rememberall
 * @subpackage rememberall/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    rememberall
 * @subpackage rememberall/admin
 * @author     Rene L <info@wp-news.de>
 */
class rememberall_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Send notification when there is an update
     *
     * @use rememberall_get_available_updates
     * @since    1.0.0
     */
    public function rememberall_available_update_report()
    {

        $available_updates = $this->rememberall_get_available_updates();

        $plugins = $available_updates['plugins'];
        $themes = $available_updates['themes'];

        $message = __( 'There are updates available: <br><br>', 'rememberall' );

        if ($plugins != 0 || $themes != 0) {

            $message .= $plugins . '<br>';
            $message .= $themes . '<br><br>';
            $message .= __( 'On your site: ', 'rememberall' ) . home_url();

            $to = get_option('admin_email');
            $subject = __( 'There are updates available on your site: ', 'rememberall' ).  home_url();  
            $headers = 'Content-type: text/html; charset=UTF-8';

            $sent = wp_mail($to, $subject, $message, $headers);
        }

    }

    /**
     * checks if there are available theme or plugin updates.
     *
     * @return    array
     * @since    1.0.0
     */
    private function rememberall_get_available_updates()
    {
        $counts = array(
            'plugins' => 0,
            'themes' => 0,
        );

        $update_plugins = get_site_transient('update_plugins');

        if (!empty($update_plugins->response)) {
            $counts['plugins'] = count($update_plugins->response);
        }

        $update_themes = get_site_transient('update_themes');

        if (!empty($update_themes->response)) {
            $counts['themes'] = count($update_themes->response);
        }

        $titles = array();

        if ($counts['plugins']) {
            /* translators: %d: Number of available plugin updates. */
            $titles['plugins'] = sprintf(_n('%d Plugin Update', '%d Plugin Updates', $counts['plugins']), $counts['plugins']);
        }

        if ($counts['themes']) {
            /* translators: %d: Number of available theme updates. */
            $titles['themes'] = sprintf(_n('%d Theme Update', '%d Theme Updates', $counts['themes']), $counts['themes']);
        }

        return $titles;
    }
}
