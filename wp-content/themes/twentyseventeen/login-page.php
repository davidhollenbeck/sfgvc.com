<?php
/**
 * Template Name: Login
 */

$args = array(
    'id_username' => 'user',
    'id_password' => 'pass',
);

wp_login_form( $args );

