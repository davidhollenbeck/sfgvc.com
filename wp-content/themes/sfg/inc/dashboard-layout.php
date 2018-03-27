<?php

$home_button_options = get_option( 'sfg_home_button_options' );
$logo_options = get_option( 'sfg_logo_options');

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
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['concessions_img']) ? wp_get_attachment_url($home_button_options['concessions_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Food & Beverage</span>
						<img src="<?php echo sfg_image_directory('hp-food.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#tv-guide">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['tv_guide_img']) ? wp_get_attachment_url($home_button_options['tv_guide_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Tv Guide</span>
						<img src="<?php echo sfg_image_directory('hp-tv.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#maps">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['maps_img']) ? wp_get_attachment_url($home_button_options['maps_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Maps</span>
						<img src="<?php echo sfg_image_directory('hp-maps.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#contact-concierge">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['concierge_img']) ? wp_get_attachment_url($home_button_options['concierge_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Contact Concierge</span>
						<img src="<?php echo sfg_image_directory('hp-concierge.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#request-photog">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['photog_img']) ? wp_get_attachment_url($home_button_options['photog_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Request Photographer</span>
						<img src="<?php echo sfg_image_directory('hp-photog.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#giants-az">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['giants_az_img']) ? wp_get_attachment_url($home_button_options['giants_az_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Giants A-Z</span>
						<img src="<?php echo sfg_image_directory('hp-az.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>#stats">
					<div class="img-responsive dashboard-button-img" style="background-image:url('<?php echo sanitize_text_field( wp_get_attachment_url($home_button_options['stats_img']) ? wp_get_attachment_url($home_button_options['stats_img']) : ''); ?>')"></div>
					<div class="dashboard-button-text">
						<span>Stats & Notes</span>
						<img src="<?php echo sfg_image_directory('hp-stats.png'); ?>" class="dashboard-icon" />
					</div>
				</a>
				<a class="col-sm-3 dashboard-button" href="<?php echo home_url( '/inner/'); ?>"#events>
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
                    <a href="https://www.mlb.com/giants" target="_blank"><img src="<?php echo sfg_image_directory('hp-internet.png'); ?>" class="dashboard-footer-icon" /></a>
                </span>
				<br/>
				<span class="dashboard-footer-section">
                    <span>Tell us how we're doing</span>
                    <a href="<?php echo home_url( '/inner/'); ?>#feedback"><img src="<?php echo sfg_image_directory('hp-feedback.png'); ?>" class="dashboard-footer-icon" /></a>
                </span>
			</div>
		</div>
		<div class="col-sm-1 dashboard-page-right">

		</div>
	</div>
	<?php sfg_footer(); ?>
</div>