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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fran' );

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
define( 'AUTH_KEY',         'h}Lk`SR*]wIkb!AtS+&$p+Ru0E=ZZwiqqNg[X|Q]Lu|D`dJ(cnUoukD}c8AnXP%z' );
define( 'SECURE_AUTH_KEY',  'UeFI{GmO|Zp^sK6c{q,5<p.Ol{bSp9 GHi?O/,Cwt}KUh&)~tS&b83@Tizwf :++' );
define( 'LOGGED_IN_KEY',    'K}r#2~4qa_0;~<<}#t~S]uG}~V<9Rv&GT]ho$N~z&$Fk`6zE@|TEgES^Vu}nAZcS' );
define( 'NONCE_KEY',        't@r4S4;W<iN LSJ&jX:&-)NunLf<3Q[ cdK|&DS(zs#V{<VNfS^8%Ca{Ax>dd/64' );
define( 'AUTH_SALT',        'e*U,ph57w|SEn9 At; c.R`9xAwLXWs^/hgrjQ#sFyhO,N?r`WZ#jkq>9I<)+XqH' );
define( 'SECURE_AUTH_SALT', ':B71YG>efIa6@.3B!s]/!gx1nd}_ix;rD3% ?{p2U^,T$Pn7C^>a4HtW`KL MWX8' );
define( 'LOGGED_IN_SALT',   'k-~Y?+e@N)q8rB%r!!X4D=0ajSvbgr(?~%?aW5p70Jw$j+nbP4E>{nrKM7NdxCu_' );
define( 'NONCE_SALT',       'd?;]92ZQL_Oa:=s)GwOc?w5=vi/&>j@BE.WqF* RE.jE#q*f?_2>ezgEvTRgu$55' );

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
