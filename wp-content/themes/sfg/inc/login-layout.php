<?php

$logo_options = get_option( 'sfg_logo_options');

$args = array(
	'redirect' => home_url(),
	'form_id' => 'login-main',
	'id_username' => 'user',
	'id_password' => 'pass',
	'remember' => true
);

?>

<div class="container-fluid">
	<div class="row sfg-login-page" style="background-image:url('<?php echo sfg_background_image(); ?>">
        <div class="sfg-login-container">
            <img src="<?php echo sanitize_text_field( wp_get_attachment_url($logo_options['logo_img']) ? wp_get_attachment_url($logo_options['logo_img']) : ''); ?>" class="login-logo" />
            <div class="login-heading">AT&T Park</div>
            <div class="login-heading login-heading-light">Virtual Concierge</div>
	        <?php sfg_login_form( $args ); ?>
        </div>
	</div>
</div>


