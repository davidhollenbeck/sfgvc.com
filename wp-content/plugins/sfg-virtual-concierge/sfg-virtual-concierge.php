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



/*
 * TO DO:
 *  1. Add media upload to admin dashboard and trigger update_db_row when a media item is uploaded.
 *      a. build out front end for admin dashboard area
 *      b. integrate wordpress media uploader and add id to each section https://mycyberuniverse.com/integration-wordpress-media-uploader-plugin-options-page.html
 *  2. Create functions to render HTML for each table
 *  3. Move to front end
 *  4. Build out back end dashboard area for notifications
 */
class SFG_Media {
	public $table_name;
	public $id;
	public $time;
	public $name;
	public $text;
	public $media_url;
	public $link;
	public $target;
	public $icon_url;

	public function get_db_row( $table, $id)
	{
		$db_row = $this->get_row_by_id( $table, $id );
		$this->id = $db_row->id;
		$this->time = $db_row->time;
		$this->name = $db_row->name;
		$this->text = $db_row->text;
		$this->media_url = $db_row->media_url;
		$this->link = $db_row->link;
		$this->target = $db_row->target;
		$this->icon_url = $db_row->icon_url;
	}

	public function update_db_row($Table, $Id, $Text = null, $Media_Url = null, $Link = null, $Target = null, $Icon_Url = null)
	{
		global $wpdb;

		$this->table_name = $table_name = $wpdb->prefix . $Table;

		if ($Text !== null)
		{
			$wpdb->update(
				$this->table_name,
				array(
					'text' => $Text
				),
				array( 'id' => $Id)

			);
		}

		if ($Media_Url !== null)
		{
			$wpdb->update(
				$this->table_name,
				array(
					'media_url' => $Media_Url
				),
				array( 'id' => $Id)

			);
		}

		if ($Link !== null)
		{
			$wpdb->update(
				$this->table_name,
				array(
					'link' => $Link
				),
				array( 'id' => $Id)

			);
		}

		if ($Target !== null)
		{
			$wpdb->update(
				$this->table_name,
				array(
					'target' => $Target
				),
				array( 'id' => $Id)

			);
		}

		if ($Icon_Url !== null)
		{
			$wpdb->update(
				$this->table_name,
				array(
					'icon_url' => $Icon_Url
				),
				array( 'id' => $Id)

			);
		}
	}

	private function get_row_by_id($table, $id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . $table;
		$sql = $wpdb->prepare("
			SELECT *
			FROM {$table_name}
			WHERE id = %d
			LIMIT 1
		", $id);

		$row = $wpdb->get_row($sql);

		return $row;
	}

	public function create_db_row($Table, $Name, $Text, $Media_Url, $Link = '', $Target='', $Icon_Url = '')
	{
		global $wpdb;
		$this->table_name = $wpdb->prefix . $Table;
		$this->time = current_time('mysql');
		$this->name = $Name;
		$this->text = $Text;
		$this->media_url = $Media_Url;
		$this->icon_url = $Icon_Url;
		$this->link = $Link;
		$this->target = $Target;

		$wpdb->insert(
			$this->table_name,
			array(
				'time' => $this->time,
				'name' => $this->name,
				'text' => $this->text,
				'media_url' => $this->media_url,
				'icon_url' => $this->icon_url,
				'link' => $this->link,
				'target' => $this->target
			)
		);
	}

}

// Initialize Database

// check if table exists
// create rows and add default values


register_activation_hook( __FILE__, 'sfg_db' );

function sfg_db()
{
	sfg_db_install( 'sfg_home_button', 8);
	sfg_db_install( 'sfg_advert', 2);
	sfg_db_install( 'sfg_concessions', 2);
	sfg_db_install('sfg_tv_guide', 1);
	sfg_db_install('sfg_maps', 4);
	sfg_db_install('sfg_stats', 1);
	sfg_db_install('sfg_schedule', 1);
	sfg_db_install('sfg_logo', 1);
	sfg_db_install('sfg_dash_button',10);

}

function sfg_db_install( $table, $rows)
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . $table;

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {

        $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        media_url varchar(255) DEFAULT '' NOT NULL,
        link varchar(255) DEFAULT '' NOT NULL,
        target varchar(12) DEFAULT '' NOT NULL,
        icon_url varchar(255) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

	    sfg_db_install_data($table, $rows);

    }

}

function sfg_db_install_data( $table, $rows) {
    global $wpdb;

    for ($x = 0; $x < $rows; $x++)
    {
    	$name = $table . '_' . ($x + 1);
    	$row = new SFG_Media();
    	$row->create_db_row( $table, $name, '', '', '', '', '' );
    }
}

function sfg_activate_test_data() {
	global $wpdb;

	sfg_test_data( 'sfg_home_button');
	sfg_test_data( 'sfg_advert');
	sfg_test_data( 'sfg_concessions');
	sfg_test_data('sfg_tv_guide');
	sfg_test_data('sfg_maps');
	sfg_test_data('sfg_stats');
	sfg_test_data('sfg_schedule');
	sfg_test_data('sfg_logo');
}

add_action('template_redirect', 'sfg_activate_test_data');

function sfg_test_data($table)
{

	$media = new SFG_Media();
	$media->update_db_row($table, 1, 'yoop', get_stylesheet_directory_uri() . "/assets/Image_1.png", '#', '_blank', '#');
}

// Customize Login Page

// PDF Upload

// Render PDFs

// HTML Rendering



function sfg_homepage()
{
	$html = "";
	// create button object type
	// create array of 8 buttons
	// dynamically load images into html via foreach loop

	/*

	$db_buttons = array(
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_1.png", "one", get_template_directory() . "/assets/Icon_1.png", "#", 'one'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_2.png", "two", get_template_directory() . "/assets/Icon_2.png", "#", 'two'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_3.png", "three", get_template_directory() . "/assets/Icon_3.png", "#", 'three'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_4.png", "four", get_template_directory() . "/assets/Icon_4.png", "#", 'four'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_5.png", "five", get_template_directory() . "/assets/Icon_5.png", "#", 'five'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_6.png", "six", get_template_directory() . "/assets/Icon_6.png", "#", 'six'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_7.png", "seven", get_template_directory() . "/assets/Icon_7.png", "#", 'seven'),
		new SFG_HomeButton(get_stylesheet_directory_uri() . "/assets/Image_8.png", "eight", get_template_directory() . "/assets/Icon_8.png", "#", 'eight')
	);




	foreach ($db_buttons as $button)
	{
		$html = $html . "<div class='sfg-hp-button'><img src='" . $button->image_url .  "' /><p>" . $button->text . "</p></div>";
	}
	*/

	$button = new SFG_Media;
	$button->get_db_row('sfg_advert','4');

	$html = $html . "<div class='sfg-hp-button'><img src='" . $button->media_url .  "' /><p>" . $button->text . "</p></div>";

	return $html;
}


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
		0
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

	// Maps sfg_maps_pdf_callback
	
	if( false == get_option('sfg_maps_options')) {
		add_option('sfg_maps_options');
	}

	// Contact Concierge
	// Request Photographer
	// Giants A-Z
	// Stats & Notes
	// Events Schedule
	// Go To Internet
	// Feedback Form

	if( false == get_option('sfg_stats_options')) {
		add_option('sfg_stats_options');
	}

	if( false == get_option('sfg_schedule_options')) {
		add_option('sfg_schedule_options');
	}

	if( false == get_option('sfg_logo_options')) {
		add_option('sfg_logo_options');
	}



	add_settings_section(
		'sfg_maps_settings_section',
		'Maps',
		'sfg_maps_options_callback',
		'sfg_maps_options'
	);

	add_settings_section(
		'sfg_stats_settings_section',
		'Statistics',
		'sfg_stats_options_callback',
		'sfg_stats_options'
	);

	add_settings_section(
		'sfg_schedule_settings_section',
		'Schedule',
		'sfg_schedule_options_callback',
		'sfg_schedule_options'
	);

	add_settings_section(
		'sfg_logo_settings_section',
		'Logo',
		'sfg_logo_options_callback',
		'sfg_logo_options'
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
		if( isset ( $input[$key] ) ) {
			$output[$key] =  strip_tags( stripslashes( $input[$key] ) );
		}
	}

	return $output;
}

