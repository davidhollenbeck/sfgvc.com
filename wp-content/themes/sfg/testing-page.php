<?php
/**
 * Template Name: Testing
 */

?>

<?php
$home_button_options = get_option( 'sfg_home_button_options' );
$advert_options = get_option( 'sfg_advert_options' );
$concessions_options = get_option( 'sfg_concessions_options' );
$tv_guide_options = get_option( 'sfg_tv_guide_options' );
$maps_options = get_option( 'sfg_maps_options' );
$stats_options = get_option( 'sfg_stats_options' );
$schedule_options = get_option( 'sfg_schedule_options');
$logo_options = get_option( 'sfg_logo_options');

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_loop', 'genesis_do_loop' );

genesis();
?>

<p>Here is the field:</p>
<br/>

<p><?php echo $advert_options['ad1_url'] ? $advert_options['ad1_url'] : ''; ?></p>
<p><?php echo sanitize_text_field($concessions_options['food_pdf'] ? $concessions_options['food_pdf'] : ''); ?></p>
<p><?php echo wp_get_attachment_url($concessions_options['food_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($tv_guide_options['tv_guide_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($maps_options['suite_layout_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($stats_options['stats_pdf']); ?></p>
<div class="alert alert-primary" role="alert">hecka</div>

<img src="<?php echo wp_get_attachment_url($logo_options['logo_img']); ?>" />
