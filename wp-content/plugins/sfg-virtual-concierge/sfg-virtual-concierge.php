<?php
/**
 * Plugin Name: Virtual Concierge Admin
 * Plugin URI: http://davidhollenbeck.com
 * Description: For Management of SFG Virtual Concierge Application
 * Version: 1.0
 * Author: David Hollenbeck
 * Questions? Call 925-822-7932 or email davidhollenbeck42@gmail.com
 *

 *
 *
 */

defined( 'ABSPATH' ) or die( 'You will have to try harder than that.' );

// SFG Custom Plugin

$plugin_url = WP_PLUGIN_URL . '/sfg-virtual-concierge';

// Enqueue Bootstrap

function sfg_enqueue_bootstrap() {

	wp_enqueue_style( 'sfg-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), 20141119 );
	wp_enqueue_script( 'sfg-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '20120206', true );
}
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_bootstrap' );


// Manage User Permissions

add_action('template_redirect', 'redirect_to_login');

function redirect_to_login(){
	if ( ! is_user_logged_in() && ! is_page(get_page_by_title("Login")) && get_page_by_title("Login") !== NULL) {

		//wp_redirect( get_home_url() . '/login/', 301 );

	}
}

// Admin Area

//add dashboard page to the plugin area
function sfg_add_dashboard()
{
	add_menu_page(
		'Virtual Concierge',
		'Virtual Concierge',
		'manage_options',
		'sfg_dashboard',
		'sfg_dashboard_display',
		'dashicons-layout',
		3
	);
}
add_action( 'admin_menu', 'sfg_add_dashboard' );

//add dashboard display and style
function sfg_dashboard_display()
{
	global $plugin_url;

	if( isset( $_POST['sfg_media_form_submitted'])) {

		$hidden_field = esc_html($_POST['sfg_media_form_submitted']);

		if($hidden_field == 'Y' ) {
			$sfg_media = esc_html( $_POST['sfg_media']);
		}

		echo $sfg_media;
	}

	if( !current_user_can('manage_options')) {

		wp_die('You are not supposed to be here');

	}
	// add display wrapper for tabs and logo
	require( 'inc/options-page-wrapper.php' );
};

function sfg_dashboard_style() {
	wp_enqueue_style('sfg_dashboard_style', plugins_url( '/sfg-virtual-concierge/style.css' ) );
}
add_action('admin_head', 'sfg_dashboard_style');

function sfg_load_scripts_admin() {
	global $plugin_url;

	wp_enqueue_media();
	wp_enqueue_script( 'sfg-admin', $plugin_url . '/js/sfg-admin.js', array( 'jquery' ), '1.0.0', true );
}
add_action('admin_enqueue_scripts', 'sfg_load_scripts_admin');

// Remove some features

add_filter( 'media_library_show_audio_playlist', function() { return false; });
add_filter( 'media_library_show_video_playlist', function() { return false; });
add_filter( 'media_library_show_gallery', function() { return false; });


// Default Options

function sfg_home_button_default_options() {
	$defaults = array(
		'concessions_button_url' => '',
		'concessions_button_img' => ''
	);

	return apply_filters( 'sfg_home_button_default_options', $defaults);
}

function sfg_advert_default_options() {
	$defaults = array(
		'ad1_url' => ''
	);

	return apply_filters( 'sfg_advert_default_options', $defaults);
}


function sfg_dashboard_init() {

	// Home Button Options

	if( false == get_option('sfg_home_button_options')) {
		add_option('sfg_home_button_options', apply_filters( 'sfg_home_button_default_options', sfg_home_button_default_options() ) );
	}

	add_settings_section(
		'sfg_home_button_settings_section',          // ID used to identify this section and with which to register options
		'Home Page Buttons',                   // Title to be displayed on the administration page
		'sfg_home_button_options_callback',  // Callback used to render the description of the section
		'sfg_home_button_options'      // Page on which to add this section of options
	);


	add_settings_field(
		'concessions_img',
		'Food & Beverage Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'concessions_img'
	);

	add_settings_field(
		'tv_guide_img',
		'TV Guide Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'tv_guide_img'
	);

	add_settings_field(
		'maps_img',
		'Maps Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'maps_img'
	);

	add_settings_field(
		'concierge_img',
		'Concierge Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'concierge_img'
	);

	add_settings_field(
		'photog_img',
		'Request Photographer Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'photog_img'
	);

	add_settings_field(
		'giants_az_img',
		'Giants A-Z Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'giants_az_img'
	);

	add_settings_field(
		'stats_img',
		'Stats & Notes Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'stats_img'
	);

	add_settings_field(
		'events_img',
		'Events Schedule Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'events_img'
	);

	add_settings_field(
		'feedback_img',
		'Feedback Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'feedback_img'
	);

	add_settings_field(
		'internet_img',
		'Go To Internet Button Image',
		'sfg_home_button_img_callback',
		'sfg_home_button_options',
		'sfg_home_button_settings_section',
		'internet_img'
	);

	register_setting(
		'sfg_home_button_options',
		'sfg_home_button_options',
		'sfg_sanitize_input'
	);

	// Adverts

	if( false == get_option('sfg_advert_options')) {
		add_option('sfg_advert_options', apply_filters('sfg_advert_default_options', sfg_advert_default_options()));
	}

	add_settings_section(
		'sfg_advert_settings_section',
		'Advertisements',
		'sfg_advert_options_callback',
		'sfg_advert_options'
	);

	add_settings_field(
		'ad1_url',
		'Ad 1 Url',
		'sfg_advert_text_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad1_url'
	);

	add_settings_field(
		'ad1_img',
		'Ad 1 Image',
		'sfg_advert_img_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad1_img'
	);

	add_settings_field(
		'ad1_text',
		'Ad 1 Text',
		'sfg_advert_text_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad1_text'
	);

	/* add_settings_field(
		'ad1_orientation',
		'Ad 1 Orientation',
		'sfg_advert_radio_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad1_orientation'
	); */

	add_settings_field(
		'ad2_url',
		'Ad 2 Url',
		'sfg_advert_text_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad2_url'
	);

	add_settings_field(
		'ad2_img',
		'Ad 2 Image',
		'sfg_advert_img_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad2_img'
	);

	add_settings_field(
		'ad2_text',
		'Ad 2 Text',
		'sfg_advert_text_callback',
		'sfg_advert_options',
		'sfg_advert_settings_section',
		'ad2_text'
	);

	register_setting(
		'sfg_advert_options',
		'sfg_advert_options',
		'sfg_sanitize_input'
	);

	// Concessions

	if( false == get_option('sfg_concessions_options')) {
		add_option('sfg_concessions_options');
	}

	add_settings_section(
		'sfg_concessions_settings_section',
		'Concessions Menus',
		'sfg_concessions_options_callback',
		'sfg_concessions_options'
	);

	add_settings_field(
		'food_pdf',
		'Food Menu',
		'sfg_concessions_pdf_callback',
		'sfg_concessions_options',
		'sfg_concessions_settings_section',
		'food_pdf'
	);

	add_settings_field(
		'beverage_pdf',
		'Beverage Menu',
		'sfg_concessions_pdf_callback',
		'sfg_concessions_options',
		'sfg_concessions_settings_section',
		'beverage_pdf'
	);

	register_setting(
		'sfg_concessions_options',
		'sfg_concessions_options',
		'sfg_validate_input'
	);

	// TV Guide

	if( false == get_option('sfg_tv_guide_options')) {
		add_option('sfg_tv_guide_options');
	}

	add_settings_section(
		'sfg_tv_guide_settings_section',
		'TV Guide',
		'sfg_tv_guide_options_callback',
		'sfg_tv_guide_options'
	);

	add_settings_field(
		'tv_guide_pdf',
		'TV Guide PDF',
		'sfg_tv_guide_pdf_callback',
		'sfg_tv_guide_options',
		'sfg_tv_guide_settings_section',
		'tv_guide_pdf'
	);

	register_setting(
		'sfg_tv_guide_options',
		'sfg_tv_guide_options',
		'sfg_validate_input'
	);

	// Maps

	if( false == get_option('sfg_maps_options')) {
		add_option('sfg_maps_options');
	}

	add_settings_section(
		'sfg_maps_settings_section',
		'Maps',
		'sfg_maps_options_callback',
		'sfg_maps_options'
	);

	add_settings_field(
		'suite_layout_pdf',
		'Suite Layout',
		'sfg_maps_pdf_callback',
		'sfg_maps_options',
		'sfg_maps_settings_section',
		'suite_layout_pdf'
	);

	add_settings_field(
		'suite_level1_pdf',
		'Suite Level Map Suites 1-31 PDF',
		'sfg_maps_pdf_callback',
		'sfg_maps_options',
		'sfg_maps_settings_section',
		'suite_level1_pdf'
	);

	add_settings_field(
		'suite_level2_pdf',
		'Suite Level Map Suites 32-67 PDF',
		'sfg_maps_pdf_callback',
		'sfg_maps_options',
		'sfg_maps_settings_section',
		'suite_level2_pdf'
	);

	add_settings_field(
		'ballpark_pdf',
		'Ballpark Map PDF',
		'sfg_maps_pdf_callback',
		'sfg_maps_options',
		'sfg_maps_settings_section',
		'ballpark_pdf'
	);

	register_setting(
		'sfg_maps_options',
		'sfg_maps_options',
		'sfg_validate_input'
	);


	// Stats & Notes

	if( false == get_option('sfg_stats_options')) {
		add_option('sfg_stats_options');
	}

	add_settings_section(
		'sfg_stats_settings_section',
		'Statistics',
		'sfg_stats_options_callback',
		'sfg_stats_options'
	);

	add_settings_Field(
		'stats_pdf',
		'Statistics & Notes PDF',
		'sfg_stats_pdf_callback',
		'sfg_stats_options',
		'sfg_stats_settings_section',
		'stats_pdf'
	);

	register_setting(
		'sfg_stats_options',
		'sfg_stats_options',
		'sfg_validate_input'
	);

	// Events Schedule

	if( false == get_option('sfg_schedule_options')) {
		add_option('sfg_schedule_options');
	}

	add_settings_section(
		'sfg_schedule_settings_section',
		'Schedule',
		'sfg_schedule_options_callback',
		'sfg_schedule_options'
	);

	add_settings_field(
		'schedule_pdf',
		'Events Schedule PDF',
		'sfg_schedule_pdf_callback',
		'sfg_schedule_options',
		'sfg_schedule_settings_section',
		'schedule_pdf'
	);

	register_setting(
		'sfg_schedule_options',
		'sfg_schedule_options',
		'sfg_validate_input'
	);

	// Logo Image

	if( false == get_option('sfg_logo_options')) {
		add_option('sfg_logo_options');
	}

	add_settings_section(
		'sfg_logo_settings_section',
		'Logo',
		'sfg_logo_options_callback',
		'sfg_logo_options'
	);

	add_settings_field(
		'logo_img',
		'Logo Image',
		'sfg_logo_img_callback',
		'sfg_logo_options',
		'sfg_logo_settings_section',
		'logo_img'
	);

	register_setting(
		'sfg_logo_options',
		'sfg_logo_options',
		'sfg_validate_input'
	);
}
add_action('admin_init', 'sfg_dashboard_init');


// Home Button Callbacks

function sfg_home_button_img_callback( $name ) {
	$options = get_option('sfg_home_button_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_image_src( $options[$name] )[0];
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change Image";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_home_button_options[' . $name . ']" id="sfg_home_button_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
			
	';
}

// Advertisement Callbacks

function sfg_advert_text_callback( $name) {
	$options = get_option('sfg_advert_options');
	$url = '';
	if( isset( $options[$name] ) ) {
		$url = $options[$name];
	}

	echo '<input type="text" id="' . $name . ' " name="sfg_advert_options' . '[' . $name . ']" value="' . $url . '" />';
}

function sfg_advert_radio_callback( $name ) {
	$options = get_option('sfg_advert_options');
	echo $options[$name];
	$options[$name] = !empty( $options[$name]) ? 1 : 0;



	$html = '<input type="radio" id="' . $name . '_1" name="sfg_advert_options[$name]" value="1"' . checked( 0, $options[$name], false ) . '/>';
	$html .= '<label for="' . $name . '_1">Landscape</label>';

	$html .= '<input type="radio" id="' . $name . '_2" name="sfg_advert_options[$name]" value="2"' . checked( 1, $options[$name], false ) . '/>';
	$html .= '<label for="' . $name . '_2">Portrait</label>';

	echo $html;
}

function sfg_advert_img_callback( $name ) {
	$options = get_option('sfg_advert_options');

	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_image_src( $options[$name] )[0];
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change Image";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_advert_options[' . $name . ']" id="sfg_advert_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
			
	';
}

// Concessions Callback

function sfg_concessions_pdf_callback( $name ) {
	$options = get_option('sfg_concessions_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_url( $options[$name] );
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change PDF";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_concessions_options[' . $name . ']" id="sfg_concessions_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
	';
}

// TV Guide Callback


function sfg_tv_guide_pdf_callback( $name ) {
	$options = get_option('sfg_tv_guide_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_url( $options[$name] );
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change PDF";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_tv_guide_options[' . $name . ']" id="sfg_tv_guide_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
			
	';
}

// Maps Callback

function sfg_maps_pdf_callback( $name ) {
	$options = get_option('sfg_maps_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_url( $options[$name] );
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change PDF";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_maps_options[' . $name . ']" id="sfg_maps_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
	';
}

// Stats & Notes Callback

function sfg_stats_pdf_callback( $name ) {
	$options = get_option('sfg_stats_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_url( $options[$name] );
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change PDF";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_stats_options[' . $name . ']" id="sfg_stats_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
	';
}

// Schedule Callback

function sfg_schedule_pdf_callback( $name ) {
	$options = get_option('sfg_schedule_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_url( $options[$name] );
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change PDF";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_schedule_options[' . $name . ']" id="sfg_schedule_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
	';
}

function sfg_logo_img_callback( $name ) {
	$options = get_option('sfg_logo_options');
	$default = plugins_url('img/default.jpg', __FILE__);

	if ( !empty( $options[$name] ) ) {
		$src = wp_get_attachment_image_src( $options[$name] )[0];
		$value = $options[$name];
	} else {
		$src = $default;
		$value = '';
	}

	$text = "Change Image";

	echo '
		<div class="upload">
			<img src="' . $src . '" style="max-width:150px;" />
			<div>
				<input type="hidden" name="sfg_logo_options[' . $name . ']" id="sfg_logo_options[' . $name . ']" value="' . $value . '" />
				<button type="submit" class="upload_image_button button">' . $text . '</button>
			</div>
		</div>
			
	';
}




// Callbacks for options headings (required for register settings default function)

function sfg_home_button_options_callback() {
//
}

function sfg_advert_options_callback() {
//
}

function sfg_concessions_options_callback() {
//
}

function sfg_tv_guide_options_callback() {
//
}

function sfg_maps_options_callback() {
//
}

function sfg_stats_options_callback() {
//
}

function sfg_schedule_options_callback() {
//
}

function sfg_logo_options_callback() {
//
}

// Input Validation


function sfg_sanitize_url_options( $input ) {
	$output = array();

	foreach( $input as $key => $val ) {
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		}
	}

	return apply_filters('sfg_sanitize_url_options', $output, $input);
}

function sfg_validate_input( $input ) {
	$output = array();

	foreach( $input as $key => $val ) {
		if ( isset ( $input[$key] ) ) {
			$output[$key] =  strip_tags( stripslashes( $input[$key] ) );
		}
	}

	return $output;
}

