<?php
/**
 * Template Name: Dashboard
 */

sfg_remove_wp();


if ( ! is_user_logged_in() ) {
	genesis();
	require( 'inc/login-layout.php' );

} else {

	genesis();
	require( 'inc/dashboard-layout.php' );

}

?>


<!--
<p><?php echo $advert_options['ad1_url'] ? $advert_options['ad1_url'] : ''; ?></p>
<p><?php echo sanitize_text_field($concessions_options['food_pdf'] ? $concessions_options['food_pdf'] : ''); ?></p>
<p><?php echo wp_get_attachment_url($concessions_options['food_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($tv_guide_options['tv_guide_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($maps_options['suite_layout_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($stats_options['stats_pdf']); ?></p>
<div class="alert alert-primary" role="alert">hecka</div> -->


