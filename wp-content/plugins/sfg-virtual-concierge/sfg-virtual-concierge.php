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

	sfg_test_data( $wpdb->prefix . 'home_button');
	sfg_test_data( $wpdb->prefix . 'advert');
	sfg_test_data( $wpdb->prefix . 'concessions');
	sfg_test_data($wpdb->prefix . 'tv_guide');
	sfg_test_data($wpdb->prefix . 'maps');
	sfg_test_data($wpdb->prefix . 'stats');
	sfg_test_data($wpdb->prefix . 'schedule');
	sfg_test_data($wpdb->prefix . 'logo');
}

//add_action('template_redirect', 'sfg_activate_test_data');

function sfg_test_data( $table_name )
{
	global $wpdb;

	$welcome_text = $table_name . ' installation complete';
	$name = "name-test";
	$media_url = get_stylesheet_directory_uri() . "/assets/Image_1.png";
	$icon_url = get_stylesheet_directory_uri() . "/assets/Icon_1.png";
	$link = 'localhost:8888/sfgvc.com/wp-content/uploads/2018/test.jpg';
	$target = '_blank';

	$wpdb->insert(
		$table_name,
		array(
			'time' => current_time('mysql'),
			'name' => $name,
			'text' => $welcome_text,
			'media_url' => $media_url,
			'icon_url' => $icon_url,
			'link' => $link,
			'target' => $target
		)
	);
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
	$button->get_db_row('advert','4');

	$html = $html . "<div class='sfg-hp-button'><img src='" . $button->media_url .  "' /><p>" . $button->text . "</p></div>";

	return $html;
}



// Admin Area

add_action( 'admin_menu', 'sfg_add_dashboard' );

function sfg_add_dashboard()
{
	add_menu_page( 'Virtual Concierge', 'Virtual Concierge', 'manage_options', 'sfg_dashboard', 'sfg_dashboard', 'dashicons-layout', 3);
}

function sfg_dashboard()
{
	// add display wrapper for tabs and logo
	echo "<p>henlo</p>";
};

// Manage User Permissions

add_action('template_redirect', 'redirect_to_login');

function redirect_to_login(){
	if ( ! is_user_logged_in() && ! is_page(get_page_by_title("Login")) && get_page_by_title("Login") !== NULL) {

		//wp_redirect( get_home_url() . '/login/', 301 );

	}
}