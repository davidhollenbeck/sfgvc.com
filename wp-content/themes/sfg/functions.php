<?php
/**
 * SFG Virtual Concierge
 *
 * Functionality for SFG Virtual Concierge
 *
 * @package Genesis Sample
 * @author  uCoast
 * @license GPL-2.0+
 * @link    http://davidhollenbeck.com
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'sfg_localization_setup' );
function sfg_localization_setup(){
	load_child_theme_textdomain( 'sfg', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'AT&T Park Virtual Concierge' );
define( 'CHILD_THEME_URL', 'http://www.davidhollenbeck.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'sfg_enqueue_scripts_styles' );
function sfg_enqueue_scripts_styles() {

	wp_enqueue_style( 'sfg-fonts', '//fonts.googleapis.com/css?family=Ubuntu:300,500,700"', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'sfg-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'sfg-responsive-menu',
		'genesis_responsive_menu',
		sfg_responsive_menu_settings()
	);

	wp_enqueue_script( 'sfg', get_stylesheet_directory_uri() . "/js/sfg.js", array( 'jquery' ), CHILD_THEME_VERSION, true );

}

// Define our responsive menu settings.
function sfg_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'sfg_secondary_menu_args' );
function sfg_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'sfg_author_box_gravatar' );
function sfg_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'sfg_comments_gravatar' );
function sfg_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// SFG Code


//login and logout

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
	wp_redirect( home_url() );
	exit();
}

function sfg_login_form( $args = array() ) {
	/**
	 * taken from wp_login_form in includes/general-template.php
	 */

	$defaults = array(
		'echo' => true,
		// Default 'redirect' value takes the user back to the request URI.
		'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
		'form_id' => 'loginform',
		'label_username' => __( 'Username or Email Address' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in' => __( 'Log In' ),
		'id_username' => 'user_login',
		'id_password' => 'user_pass',
		'id_remember' => 'rememberme',
		'id_submit' => 'wp-submit',
		'remember' => true,
		'value_username' => '',
		// Set 'value_remember' to true to default the "Remember me" checkbox to checked.
		'value_remember' => false,
	);

	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
	$login_form_top = apply_filters( 'login_form_top', '', $args );
	$login_form_middle = apply_filters( 'login_form_middle', '', $args );
	$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );

	$sfg_icon_usn = sfg_image_directory( 'usn-login.png' );
	$sfg_icon_pw = sfg_image_directory( 'pw-login.png');
	$sfg_icon_dd = sfg_image_directory('caret-login.png');

	$sfg_select_options = '<div class="form-group" id="sfg-dropdown-open"><img class="sfg-login-icon" src="' . $sfg_icon_dd . '" /><p class="sfg-dropdown-label">Suite Number</p><select name="log" id="' . esc_attr( $args['id_username'] ) . '" class="form-control" placeholder="Suite Number" value="' . esc_attr( $args['value_username'] ) . '" size="5" style="display:none;">';

	for ($i = 1; $i < 68; $i++)
	{
		$sfg_select_options .= '<option value="' . $i . '">' . $i .'</option>';
	}

	$sfg_select_options .= '</select></div>';


	$form = '
	<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
		' . $login_form_top . '
		<div class="form-group">
			<img class="sfg-login-icon" src="' . $sfg_icon_usn . '" />
			<input type="text" name="log" id="placeholder_user" class="form-control" placeholder="Username" value="" size="20" aria-label="Username" />
		</div>
		<div class="form-group">
			<img class="sfg-login-icon" src="' . $sfg_icon_pw . '" />
			<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="form-control" placeholder="Password" value="" size="20" aria-label="Password" />
		</div>
		
		' . $login_form_middle . $sfg_select_options . '
		' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever" checked' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
		<p class="login-submit">
			<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="btn btn-primary" value="' . esc_attr( $args['label_log_in'] ) . '" />
			<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
		</p>	
		<p>' . $login_form_bottom . '
	</form>';

	if ( $args['echo'] )
		echo $form;
	else
		return $form;
}

add_action( 'genesis_footer', 'genesis_do_footer' );
/**
 * Echo the contents of the footer.
 *
 * Execute any shortcodes that might be present.
 *
 * Applies `genesis_footer_backtotop_text`, `genesis_footer_creds_text` and `genesis_footer_output` filters.
 *
 * For HTML5 themes, only the credits text is used (back-to-top link is dropped).
 *
 * @since 1.0.1
 */

remove_action('genesis_footer', 'genesis_do_footer');

function sfg_footer() {

	// Build the text strings. Includes shortcodes.
	$backtotop_text = '[footer_backtotop]';
	$creds_text     = '[footer_loginout]';
	// Filter the text strings.
	$backtotop_text = apply_filters( 'genesis_footer_backtotop_text', $backtotop_text );
	$creds_text     = apply_filters( 'genesis_footer_creds_text', $creds_text );

	$backtotop = $backtotop_text ? sprintf( '<div class="gototop"><p>%s</p></div>', $backtotop_text ) : '';
	$creds     = $creds_text ? sprintf( '<div class="creds"><p>%s</p></div>', $creds_text ) : '';

	$output = $backtotop . $creds;

	// Only use credits if HTML5.
	if ( genesis_html5() ) {
		$output = '<footer class="site-footer">' . genesis_strip_p_tags( $creds_text ) . '</footer>';
	}

	echo apply_filters( 'genesis_footer_output', $output, $backtotop_text, $creds_text );

}

// get background image

function sfg_background_image()
{
	$image = get_stylesheet_directory_uri() . '/images/background.jpg';
	return $image;
}

function sfg_image_directory( $filename ) {
	$image = get_stylesheet_directory_uri() . '/images/' . $filename;
	return $image;
}

function sfg_sanitize( $media ) {
	$html = sanitize_text_field( wp_get_attachment_url($media) ? wp_get_attachment_url($media) : '');
	echo $html;
}

function sfg_image_url ($options, $id) {
	return sanitize_text_field( wp_get_attachment_url($options[$id]) ? wp_get_attachment_url($options[$id]) : '');
}

function sfg_pdf( $options, $id, $active )  {
	$url = sanitize_text_field( wp_get_attachment_url($options[$id]) ? wp_get_attachment_url($options[$id]) : '');
	$active_class = ($active === true) ? 'sfg-inner-pdf-active' : '';

	$html = '
		<div class="embed-responsive embed-responsive-16by9 sfg-inner-pdf ' . $active_class . '" id="' . $id . '">
	        <object data="' . $url . '#toolbar=0&navpanes=0&scrollbar=0&statusbar=0&messages=0&scrollbar=0&zoom=100,0,0," type="application/pdf" class="embed-responsive-item" >
	            hecka
	        </object>
	    </div>
	   ';

	echo $html;
}

function sfg_text( $options, $id) {
	$url = $options[$id] ? sanitize_text_field($options[$id]) : '';

	return $url;
}

function sfg_remove_wp() {
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
}