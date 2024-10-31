<?php

/**
 * Fired during plugin deactivation
 *
 * @link       www.wp-news.de
 * @since      1.0.0
 *
 * @package    rememberall
 * @subpackage rememberall/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    rememberall
 * @subpackage rememberall/includes
 * @author     Rene L <info@wp-news.de>
 */
class rememberall_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 'rememberall_mail' );
	}

}
