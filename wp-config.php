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
define( 'AUTH_KEY',         'NG &<ynU?`7|E3u!}}9lTDpe]#x{)!}D[a0x+zmnM%FhGClh?=2@XVBM*6y,sn)u' );
define( 'SECURE_AUTH_KEY',  'Cb[,%wHhXPkgZ4Egk:SJ}g=mA>-:_lgej2_Pj[{Jh#l_):0{c1ukgy`@f!VU<5-(' );
define( 'LOGGED_IN_KEY',    '*tm+omDh%gkW<`|y[s&8}E~.<h{Li.|q<I2xulQ&`eJ+054e**ZA=<E6UoP#y^0]' );
define( 'NONCE_KEY',        '$F7@ST-uS%[y<nY|e<9P;RmGt?T? utGYoZ5]_T|Z`>y[6]d@4|idN+V~>.p|iX,' );
define( 'AUTH_SALT',        '3$^jy`/&.=^Is|8KjmfaWK@O(2&QGHA_S_o4;)nT>gm5Yi]Y*G}.z;&/l|3D9;3(' );
define( 'SECURE_AUTH_SALT', '+?<`Hyd|U ,VWBr3/VPs 6JLp*4KUm?LA[cB2uuo%noBHRf{$~+2v$(3h 3cx)}Q' );
define( 'LOGGED_IN_SALT',   '|.s3*Qg%j~6adX`:r5/;r-$%ZT>qv`zam1zp}jM%cn(4)Vd:mg~|HmeDjxJ.MA<O' );
define( 'NONCE_SALT',       '|V 1_uxo9q|a<NV@jq&_POZ>;[B*w=7O?:*.%v5R72gPstDn*ijY#9C9WqjuE)}?' );

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
