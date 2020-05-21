<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */



// One value

if(isset($_GET['device_tokan'])){

	if ( ! session_id() ) {
		    session_start();
		}
	$_SESSION['device_tokan'] = $_GET['device_tokan'];
	$_SESSION['device_type'] = $_GET['device_type'];

}


//echo'hello';exit;
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
