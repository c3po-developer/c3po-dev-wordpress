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
define( 'DB_NAME', 'c3po_dev_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'web' );

/** MySQL database password */
define( 'DB_PASSWORD', 'usalafuerza' );

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
define( 'AUTH_KEY',         'a+s=WzmceO>`tjGlWvjm<h79Nr&YrFn#_m|xcv&CK%m`zXSPXa{]s!};L5Qydq=:' );
define( 'SECURE_AUTH_KEY',  'lC?KSenvq6) 8C~p.D^7iQIVER!;#2g& gHzE4LG2EED?0SkWl`oWL~i.9c#jmpb' );
define( 'LOGGED_IN_KEY',    ';w?]x9Nia.AC:vIa{3BI|,WQT2P<0sdv;W0GS(~?#2W,gWn`5~~)SWXMW6Xyu]Hx' );
define( 'NONCE_KEY',        'Fej0?tJF5L-v=3ZHk5*SJL,???BYV^CC1Za8n8E9&XK,.rtWf2{hTIU1GF;`NQP;' );
define( 'AUTH_SALT',        'B1/vG6[6_Z jb$d1we]K9NS;#M O2E/GmLx g[8SU1@r)+w]=Y&aTf7+l>S08vgT' );
define( 'SECURE_AUTH_SALT', 'f^TM9p7N8}[icWnVkGCN!X+!@pw#!c ;l#P<PPV=;[K1Da]x0q;^ID[RD*fG{:P!' );
define( 'LOGGED_IN_SALT',   'CN4%0S0(pQ!&%TZ/6^q:[]V8jI`w<B*is*p$LNkRT)~htht[J>UNYueJ=P])|f@:' );
define( 'NONCE_SALT',       '1 PsV5qCK+6pH4@3I)?k^6l.O7ih,pFA(JoG!g{#q+CjsC7+gHApW(dV3-L[?O.)' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
