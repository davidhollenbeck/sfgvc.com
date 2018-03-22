<?php
/**
 * Template Name: Testing
 */

?>
<?php
    $home_button_options = get_option( 'sfg_home_button_options' );
    $advert_options = get_option( 'sfg_advert_options' );
    $concessions_options = get_option( 'sfg_concessions_options' );
    $tv_guide_options = get_option( 'sfg_tv_guide_options');
?>

<p>Here is the field:</p>
<br/>

<p><?php echo $advert_options['ad1_url'] ? $advert_options['ad1_url'] : ''; ?></p>
<p><?php echo sanitize_text_field($concessions_options['food_pdf'] ? $concessions_options['food_pdf'] : ''); ?></p>
<p><?php echo wp_get_attachment_url($concessions_options['food_pdf']); ?></p>
<p><?php echo wp_get_attachment_url($tv_guide_options['tv_guide_pdf']); ?></p>

