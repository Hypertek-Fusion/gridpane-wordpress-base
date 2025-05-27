<?php
if ( ! defined( 'SMTP_DEBUG_OUTPUT' ) ) {
	define( "SMTP_DEBUG_OUTPUT", "error_log" );
}

add_action( 'phpmailer_init', 'use_smtp_email' );
function use_smtp_email( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host        = SMTP_HOST;
	$phpmailer->SMTPAuth    = SMTP_AUTH;
	$phpmailer->Port        = SMTP_PORT;
	$phpmailer->Username    = SMTP_USER;
	$phpmailer->Password    = SMTP_PASS;
	$phpmailer->SMTPSecure  = SMTP_SECURE;
	$phpmailer->From        = SMTP_FROM;
	$phpmailer->FromName    = SMTP_NAME;
	$phpmailer->SMTPDebug   = SMTP_DEBUG;
	$phpmailer->Debugoutput = SMTP_DEBUG_OUTPUT;
}

add_action('wp_mail_failed', 'hook_wp_mail_failed', 10, 1);
function hook_wp_mail_failed($wp_error) {
	return error_log(print_r($wp_error, true));
}
