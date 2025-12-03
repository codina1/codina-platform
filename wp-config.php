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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'codinDB' );

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
define( 'AUTH_KEY',         'kPuVuok?r`(RE3_TCP4Qx<|qx0;rV3SPK{.jZr52&{z$wX<i:h!FbEPYF$|h4u*4' );
define( 'SECURE_AUTH_KEY',  'EMlkvH0#a;ehtsL:$zjq9j<C*l!|u`Sd+qy&c{8gikr<?H.XUP]^?|eb0kY>`~J7' );
define( 'LOGGED_IN_KEY',    'K}LMf@VNSTNg0Og>N18B|hekif4=[7H#jo5NGTTV5lQ:57p;_@O7Y6~B4p4~%>uq' );
define( 'NONCE_KEY',        '6?X6b>5c5:b&i?c(1zU`E@FO:*]bk$ZhI-6% J{J?TltRFatmQB&vk|Dxjo:$a]c' );
define( 'AUTH_SALT',        'upO0muSeiZz6of: ]e<fMU7:sZ Ny7TF-.TdFY:]E/~?bhH5j$&K{8fnrXOl:BD^' );
define( 'SECURE_AUTH_SALT', 'Z:M+?iq=#){xV:A+:pZ0L8[tFq@{t?t>tYll,(gzMGX-rVin6;m~(GUr:##~DEey' );
define( 'LOGGED_IN_SALT',   '6v<oRT6dD7L o`pz<#zCS_x:j%,q+%7>NF:~a}-%E;{7=TmT5=OJl(4Fp)n.]_fP' );
define( 'NONCE_SALT',       '];k/*}o<s$RMT?bj h,hw,m>1P*ca`F)t5*l4]oe.mMFMGzM%T2Oe_#R,-$_b=x`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
