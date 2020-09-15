<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', '/home/stylecabbie/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'u377484994_stylecabbie' );

/** MySQL database username */
define( 'DB_USER', 'u377484994_stylecabbie' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Stylecabbie@123#' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ');Tod/5]4=t[Pd8y8!:6)=+$[j?}P%2!v=MFbqd NDWi+pg|4/r%I@~--+k_8oa2' );
define( 'SECURE_AUTH_KEY',  'MU{T(J/0?F:7`_oP`Dzg%;d/j0>]hG+]Hxg2o_$>ufNT vRp;.nBEx]e1742vF)=' );
define( 'LOGGED_IN_KEY',    ')MqcG8vDTgm^3yZjX<KBqfDqmhiS{:>L8Mw/;)2JFRKc:~]|5hs.f0GqAC+mt@53' );
define( 'NONCE_KEY',        'WL8cJS:wcs{ ,})yt/d6$G7TwSzCOY1rIW.#Ql9M/!Yw3^|>%mEI>mw-]6jSKkb2' );
define( 'AUTH_SALT',        'HI,*RnM[x+z5 <GiAlg&,F_Gednxcj9&BNW9gEwIwi,G1f}+0IBGy`IgHjY)~}D&' );
define( 'SECURE_AUTH_SALT', '~xlr{&Bu}}}l@2&O(j)}4<5kV*Va4 ]H5Gp[SC]lkn`)B@+>%?:@/WsvQk;M_.65' );
define( 'LOGGED_IN_SALT',   '$V0]3zZBs9VZTGf_17q;UiW`rp!|nFqYW/F}&OSS&V5qT_O:>CGA@{__U1#KiXqK' );
define( 'NONCE_SALT',       'uuA zP4K.jqweyq!vx(H?aIr$EAj$9pJ&>uFi?LKgQ@pm!uAd?Mfx<ubIJ.#Q=@%' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'FS_METHOD', 'direct' );
define( 'WP_DEBUG', true);
define( 'WP_DEBUG_LOG', '/tmp/wp-errors.log' );

if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
   $_SERVER['HTTPS']='on';

define('FORCE_SSL_ADMIN', true);
define('RELOCATE', TRUE);
$_SERVER['HTTPS'] = 'on';
define('WP_HOME', 'https://www.stylecabbie.com');
define('WP_SITEURL', 'https://www.stylecabbie.com');

define( 'WPMS_ON', true );
define( 'WPMS_SMTP_PASS', 'Stylecabbie@123#' );

//define('WP_MEMORY_LIMIT', '64M');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
