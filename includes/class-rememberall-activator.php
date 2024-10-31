<?php

/**
 * Fired during plugin activation
 *
 * @link       www.wp-news.de
 * @since      1.0.0
 *
 * @package    rememberall
 * @subpackage rememberall/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    rememberall
 * @subpackage rememberall/includes
 * @author     Rene L <info@wp-news.de>
 */
class rememberall_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( ! wp_next_scheduled( 'rememberall_mail' ) ) {
            wp_schedule_event( time(), 'daily', 'rememberall_mail' );
        }

	}

}
