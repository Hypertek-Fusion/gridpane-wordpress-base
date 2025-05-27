<?php
/**
 * GridPane Mailer
 *
 * @wordpress-plugin
 * Plugin Name:      GridPane Mailer
 * Description:      Plugin to use SMTP mail services instead of wp_mail
 * Version:          1.0.1
 * Author:           Chad Butler, GridPane
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:      gridpane-mailer
 */

if ( defined( 'WP_ENVIRONMENT_TYPE' ) && constant('WP_ENVIRONMENT_TYPE') === 'staging' ) {
	return;
}
require __DIR__ . '/gridpane-mailer/gridpane-mailer.php';
