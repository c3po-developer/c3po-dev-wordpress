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
define( 'DB_NAME', 'db' );

/** MySQL database username */
define( 'DB_USER', 'user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pass' );

/** MySQL hostname */
define( 'DB_HOST', 'host' );

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
define('AUTH_KEY',         'u<_^=XJruFMFO@+Q-/=A0>F|o|)6s) &^- T_EakK(:a#+&G{BY[}5sZ=Y2se2Wm');
define('SECURE_AUTH_KEY',  '3#47 o|HxADJWW-d|$5@x+KZ-} jFGH&|ShG1T!Zwry/SWGtRS>fF1 ]-6y>w_rK');
define('LOGGED_IN_KEY',    'p#t!s|KoB[~Npt!.u8EdY(x7Xy`]3vR^-!Z_+PMJZxS|$+2]$u=`,hzHs9dIo;MC');
define('NONCE_KEY',        'VZ --f*7itAO?m_3iNr=T6zHmbO{Ydncb@7f|Q%VMA@Wvh`V:DG`DD_0pGbu$o`(');
define('AUTH_SALT',        'lGvzztibJc]}k.LT6O9(O+YP@`bV&TANZJ,D6FP0LfzPWjD>$Nj6vkcw+WCE6C!+');
define('SECURE_AUTH_SALT', 'qk@AN=srjK?E Y?g=m4u#2i$j-IEp|XA(~xbxV-|7aetqr_IX&%OCoZFnbeJ--.P');
define('LOGGED_IN_SALT',   '.Q%Qj]#IN]FLqHoCB%}9G|^ZK@ hCmu%mwS%Id]tS6zrl)QL>W0T-4}3WSj^`pGC');
define('NONCE_SALT',       '@B[/W|o7[IG=XsNlVtf4<8lJE=4wh%)_0dh+5G.SB  yepjPQzHU]WAZ[!/G|L4M');
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
