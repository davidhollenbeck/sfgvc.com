<?php
$tv_options = get_option( 'sfg_tv_guide_options');
$advert_options = get_option( 'sfg_advert_options');
?>
<div class="col-sm-3">
    <img src="<?php echo sanitize_text_field( wp_get_attachment_url($logo_options['logo_img']) ? wp_get_attachment_url($logo_options['logo_img']) : ''); ?>" class="inner-logo" />
    <a class="inner-ad-container" href="<?php echo sfg_text( $advert_options, 'ad1_url'); ?>" target="_blank">
        <img src="<?php echo sfg_image_url($advert_options, 'ad1_img'); ?>" />
        <span class="inner-ad-text"><?php echo sfg_text( $advert_options, 'ad1_text'); ?></span>
    </a>
    <a class="inner-ad-container" href="<?php echo sfg_text( $advert_options, 'ad2_url'); ?>" target="_blank">
        <img src="<?php echo sfg_image_url($advert_options, 'ad2_img'); ?>" />
        <span class="inner-ad-text"><?php echo sfg_text( $advert_options, 'ad2_text'); ?></span>
    </a>
</div>
<div class="col-sm-6" style="color:#fff;">
    <div class="inner-header">
        <h1>TV Guide</h1>
    </div>
	<?php sfg_pdf($tv_options, 'tv_guide_pdf', true); ?>

</div>
<div class="col-sm-3">
    <div class="sfg-interface-button-container">
        <a class="sfg-interface-button sfg-interface-server"  href="#" id="sfg-server">
            <span>Request Server</span>
        </a>
    </div>
</div>