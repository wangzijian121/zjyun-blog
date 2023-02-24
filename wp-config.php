<?php
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
$list = explode(‘,’,$_SERVER['HTTP_X_FORWARDED_FOR']);
$_SERVER['REMOTE_ADDR'] = $list[0];
}
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */



define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3308' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'U/Ua%QsN1&oE@:`ytMjJ=q?oQq@4Vx-yC|rOIpG]avX>ucfC ,6Sjy5L?cq%,k1=' );
define( 'SECURE_AUTH_KEY',  '^!m>.]T{6K9|Bzbyr3zf%z`|s~R[Qyj%JF`FbL~NFk1H5^IX?ENt$nkdV[ lL:qw' );
define( 'LOGGED_IN_KEY',    'S(Ir=>7i-^{f^F[]A-m0ZrwAy <ONa2U>,cb}~4^wNuT,IxEWzTHFda3o`SJ>(od' );
define( 'NONCE_KEY',        'P3ofhwR%mzPNK,33i:Uyg.+D!=2zP(f.S{j52rh+|ego`e|68(=Lp6%a/}UFPdmJ' );
define( 'AUTH_SALT',        'v6)W>prHg83R%*!j8D+y<x#{xKo9RL@Lx_3yFJ@{hTmP@c+keb0whEUNuz3pCEl,' );
define( 'SECURE_AUTH_SALT', ')/7`=`KV@*340sv!+2mY#o(*xYh%9K1U/(&u&Hv{~,e2QWGXn#sCpU.Z0$27iF12' );
define( 'LOGGED_IN_SALT',   'B:rlmw|Yko;qvghW?Q;fM&/}G+-QMlSYKi6U{%UJX2?cM`Z_]0.9prYXz-gJT>5$' );
define( 'NONCE_SALT',       'uzkz2L:ETE^asTZMOCDjN]/3G@c3Fc`b$~I0Uc}yiP8|=WtlJ+J,!@2t_htx}Vl|' );
define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', false );
define( 'WP_POST_REVISIONS', 3 );
define('ALLOW_UNFILTERED_UPLOADS', true);
/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

