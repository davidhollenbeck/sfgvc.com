<?php
/**
 * Template Name: Login
 */

if ( ! is_user_logged_in() ) {
	$args = array(
		'redirect' => home_url(),
		'form_id' => 'login-main',
		'id_username' => 'user',
		'id_password' => 'pass',
		'remember' => true,
	);

	wp_login_form( $args );
} else {
	echo sfg_homepage();
}


