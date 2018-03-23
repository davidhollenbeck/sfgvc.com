<?php
/**
 * Template Name: Dashboard
 */

?>

<?php
$home_button_options = get_option( 'sfg_home_button_options' );
$logo_options = get_option( 'sfg_logo_options');

add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', '_admin_bar_bump_cb');

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
?>

<div class="container-fluid">
    <div class="row dashboard-page-columns" style="background-image:url('<?php echo sfg_background_image(); ?>')">
        <div class="col-sm-1 dashboard-page-left">

        </div>
        <div class="col-sm-10 dashboard-page-center">
            <div class="dashboard-header">
                <img src="<?php echo sanitize_text_field( wp_get_attachment_url($logo_options['logo_img']) ? wp_get_attachment_url($logo_options['logo_img']) : ''); ?>" class="dashboard-logo" />
                <h1>Touch Screen For Service </h1>
            </div>
            <div class="row dashboard-buttons-container">
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['concessions_img']) ? wp_get_attachment_url($home_button_options['concessions_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Food & Beverage</span>
                        <img src="<?php echo sfg_image_directory('hp-food.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['tv_guide_img']) ? wp_get_attachment_url($home_button_options['tv_guide_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Tv Guide</span>
                        <img src="<?php echo sfg_image_directory('hp-tv.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['maps_img']) ? wp_get_attachment_url($home_button_options['maps_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Maps</span>
                        <img src="<?php echo sfg_image_directory('hp-maps.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['concierge_img']) ? wp_get_attachment_url($home_button_options['concierge_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Contact Concierge</span>
                        <img src="<?php echo sfg_image_directory('hp-concierge.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['photog_img']) ? wp_get_attachment_url($home_button_options['photog_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Request Photographer</span>
                        <img src="<?php echo sfg_image_directory('hp-photog.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['giants_az_img']) ? wp_get_attachment_url($home_button_options['giants_az_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Giants A-Z</span>
                        <img src="<?php echo sfg_image_directory('hp-az.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['stats_img']) ? wp_get_attachment_url($home_button_options['stats_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Stats & Notes</span>
                        <img src="<?php echo sfg_image_directory('hp-stats.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
                <a class="col-sm-3 dashboard-button" href="#">
                    <div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['events_img']) ? wp_get_attachment_url($home_button_options['events_img']) : ''); ?>')"></div>
                    <div class="dashboard-button-text">
                        <span>Events Schedule</span>
                        <img src="<?php echo sfg_image_directory('hp-schedule.png'); ?>" class="dashboard-icon" />
                    </div>
                </a>
            </div>
            <div class="dashboard-footer">
                <span class="dashboard-footer-section">
                    <span>Browse the Internet</span>
                    <a href="#"><img src="<?php echo sfg_image_directory('hp-internet.png'); ?>" class="dashboard-footer-icon" /></a>
                </span>
                <br/>
                <span class="dashboard-footer-section">
                    <span>Tell us how we're doing</span>
                    <a href="#"><img src="<?php echo sfg_image_directory('hp-feedback.png'); ?>" class="dashboard-footer-icon" /></a>
                </span>
            </div>
        </div>
        <div class="col-sm-1 dashboard-page-right">

        </div>
    </div>
</div>

<?php
genesis();
?>


<!--
<p><?php echo $advert_options['ad1_url'] ? $advert_options['ad1_url'] : ''; ?></p>
<p><?php echo sanitize_text_field($concessions_options['food_pdf'] ? $concessions_options['food_pdf'] : ''); ?></p>
<p><?php echo wp_get_attachment_url($concessions_options['food_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($tv_guide_options['tv_guide_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($maps_options['suite_layout_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($stats_options['stats_pdf']); ?></p>
<div class="alert alert-primary" role="alert">hecka</div> -->


