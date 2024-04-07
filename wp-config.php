<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'wp_md_codechallenge' );

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
define( 'AUTH_KEY',         '3w-SzlDCBf&TNb5g;<y2]GMhEp>gQICgo0bq5-3ZS_l!`Po *:eW s5^J ZM>VDa' );
define( 'SECURE_AUTH_KEY',  '>nz:]H<hn^>r%IY9HAw$X5&?OUWuM0;9.)FZl-KN~$Y-(ePdcry]1Y/[p9U0iA1F' );
define( 'LOGGED_IN_KEY',    '/l/RFflw6mF(b/;lOmN^.T2$ef&nrsl0Q5eiA7`KVI1AOeBXNt`YX,zR[U8j)r@?' );
define( 'NONCE_KEY',        'b?$fCmcX`?Mg ,0)G_+ncm?x7Kv7cLT%2KPGp0c;|=q@>{l5R8-enM{DR*[=led ' );
define( 'AUTH_SALT',        'X]*pP`(qH~EL]sQ^UH]qM}9$X(DsH6 ABqU8P^q-bz=h}:#VuCldMep~HEy7VY%3' );
define( 'SECURE_AUTH_SALT', ']zoW?f,c!H0Ya{JY`friWeBx;xTe;wtWXVQxjeRwk~=>)Ifc[a/A}v6tq(.WwWg:' );
define( 'LOGGED_IN_SALT',   'e$We#9:.,9iKr/bc;-2y6W26qpT=L.3|)F$K bHN^UdZs#.D!YqoBJStFMJ=Jw%q' );
define( 'NONCE_SALT',       '9RU<2|Vd2m/Q/@2]( olsqL8R:zX]5VZG[[@OO84fj;QH-pJi-IhKA;$t4[Uk$*i' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'md_';

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
