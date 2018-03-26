<?php
/**
 * Template Name: Inner
 */

sfg_remove_wp();


if ( ! is_user_logged_in() ) {
	genesis();
	require( 'inc/login-layout.php' );

} else {

	genesis();
	require( 'inc/inner-page-container.php' );

}

?>


