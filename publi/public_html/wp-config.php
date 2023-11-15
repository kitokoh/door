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
define( 'DB_NAME', 'okpsdoor_wp607' );

/** Database username */
define( 'DB_USER', 'okpsdoor_wp607' );

/** Database password */
define( 'DB_PASSWORD', 'Sp7.XL66]g' );

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
define( 'AUTH_KEY',         '330w7bwhyxxxbth45bzo4nuhjh9rdljouiljvkpp2ejqppaa4rrsg1inxdv9h8ab' );
define( 'SECURE_AUTH_KEY',  '1jkkhz6l9bgpqgls0gjp8m4i3h4zeiczpuj5mvjbjwsvxseu0xjewl04ndwys4q4' );
define( 'LOGGED_IN_KEY',    'bsiznoj1ee2ecali0hbvqjhtmrfub38e95cfxegbfnvgzbw2gpavbktdbnqmhzew' );
define( 'NONCE_KEY',        'zdu8t4uezidqhdxpudy7au16mhiwfjgsrpjfqy2ge2h0loeoiewaw9fzvp9sonpm' );
define( 'AUTH_SALT',        'mrlimdgrji4ede1ri2jttthpycls5ukyphyqdghzhqrxttzn10x26ihsb3jv7mbk' );
define( 'SECURE_AUTH_SALT', 'hme9uqm3c5lvxyo0xeq99fuewshtnwlsijzl8wva3sypp50uq75r6prfbyn68a7s' );
define( 'LOGGED_IN_SALT',   'nda7njjhluaxrwdzzwqc7lfzohjtxkmpjn4v0lq6hlgvpvjifhol7i6a8w0ltuht' );
define( 'NONCE_SALT',       'cyvircrziy67zcdmklbgfqglfuegsvcg8zd55nvu5g02mg1v6s4z3r2rch3a1udt' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
define('WP_DEBUG_DISPLAY', true);
$table_prefix = 'wprx_';

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
