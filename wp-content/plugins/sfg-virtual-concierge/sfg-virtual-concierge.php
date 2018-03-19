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

// Manage User Permissions

add_action('template_redirect', 'redirect_to_login');

function redirect_to_login(){
    if ( ! is_user_logged_in() && ! is_page(get_page_by_title("Login")) && get_page_by_title("Login") !== NULL) {

        //wp_redirect( get_home_url() . '/login/', 301 );

    }
}

// Initialize Database

// check if table exists
// create rows and add default values


register_activation_hook( __FILE__, 'sfg_db_install' );

function sfg_db_install()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . "homebutton";

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {

        $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        icon varchar(55) DEFAULT '' NOT NULL,
        link varchar(55) DEFAULT '' NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        sfg_db_install_data('homebutton');

    }

}

function sfg_db_install_data( $table_name) {
    global $wpdb;

    $welcome_name = $table_name;
    $welcome_text = $table_name . ' installation complete';

    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time('mysql'),
            'name' => $welcome_name,
            'text' => $welcome_text,
        )
    );

}


// Customize Login Page

// PDF Upload

// Render PDFs
