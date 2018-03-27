<?php

$advert_options = get_option( 'sfg_advert_options');
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#photog-suite').val('<?php echo $current_user->user_login; ?>');
    });
</script>
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
        <h1>Leave Feedback
            <span class="instructions">Want to capture today’s excitement? Request a professional photographer to visit your suite and take a group photo! You can purchase and take home today.</span>
        </h1>
    </div>
    <div class="sfg-feedback">
		<?php echo do_shortcode('[contact-form-7 id="54" title="Photographer"]'); ?>
    </div>

</div>
<div class="col-sm-3">
    <div class="sfg-interface-buttons">
        <!-- <div class="sfg-interface-button-container">
            <a class="sfg-interface-button sfg-interface-server"  href="#" id="sfg-server">
                <span>Request Server</span>
            </a>
        </div>-->
    </div>
</div>