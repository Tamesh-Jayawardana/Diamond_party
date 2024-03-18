<?php
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'diamondparty_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '.#>WX1*GwiC_>#!jn|b|Eeg;xvSLLOgS[Z(22Ma[.`r1tv+0LpfG*gZiLJ*H)uJ(' );
define( 'SECURE_AUTH_KEY',  'd~lm)>E]_S%H<Vy#FC{7]dIxCtqR3G=B>;&{nl1}Af_rHJ[@A9dIrjbN}-k<]>8k' );
define( 'LOGGED_IN_KEY',    '_kCaBX>uOTsw@o}oS:zNC<!%,`jObwSehR 7M>,}ItSjCv J-`)<jO}_.s}bOS!x' );
define( 'NONCE_KEY',        'nBQ1&@jgt/-Xp/f;2?j$?ESB?-G`Ml[/?4AF5xk|MAfR[dgV&v[nU|*vq-cDGN6m' );
define( 'AUTH_SALT',        ':02Ihe_r0:$yv=5o]T#bLg/.^814rk9%DG=:i9jo]yB?i R{l;MTodK^}L_W#5Zd' );
define( 'SECURE_AUTH_SALT', 'qN@;Fp*TP_X;T{U58n#UX|.jwiII`4n/A,KO~-ix)5;Ns0/hL(f/mpD:E@6}#{bp' );
define( 'LOGGED_IN_SALT',   '^*+ygnt%FCwcZIacdXC!cXV*W3}6QYCj:`UD|9.X?bg3z,H(hUuH:jPFdwJ0]-8*' );
define( 'NONCE_SALT',       'LIt+N}|7X%STd9zON<fhJyd,56|>tN>[$cus>}vT#Aa/(C?-sy~bsyh<HM<!H}+@' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
