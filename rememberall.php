<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.wp-news.de
 * @since             1.0.0
 * @package           rememberall
 *
 * @wordpress-plugin
 * Plugin Name:       rememberall
 * Description:       Daily email report if updates are available.
 * Version:           1.0.2
 * Author:            Rene L
 * Author URI:        www.wp-news.de
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rememberall
 * Domain Path:       /languages
 * Requires at least: 5.7
 * Tested up to: 6.1.1
 * Requires PHP: 5.2.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REMEMBERALL_VERSION', '1.0.2' );
define( 'REMEMBERALL_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'REMEMBERALL_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rememberall-activator.php
 */
function activate_rememberall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rememberall-activator.php';
	rememberall_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rememberall-deactivator.php
 */
function deactivate_rememberall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rememberall-deactivator.php';
	rememberall_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rememberall' );
register_deactivation_hook( __FILE__, 'deactivate_rememberall' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rememberall.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rememberall() {

	$plugin = new rememberall();
	$plugin->run();

}
run_rememberall();
