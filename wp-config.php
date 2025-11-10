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
define( 'DB_NAME', 'wp_db' );

/** MySQL database username */
define( 'DB_USER', 'wordpress_usr' );

/** MySQL database password */
define( 'DB_PASSWORD', 'b0td3t3ct!15' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
 define('AUTH_KEY',         'NKS/EFgN.c1Mvszbj[>qgk=r*9Lb @L12<b)-_Zt32Vz~|X^NxB K6<#U2We^^bI');
 define('SECURE_AUTH_KEY',  'O]r?  (1N)v3(.UP>>w)9#%9+M?r @>1 %$/vAZcgkhGa.uE<C]6GY{:/v[zLC8{');
 define('LOGGED_IN_KEY',    'KEoc)e!0+a}b+IXM)Owp.B(6mbaR1]~i5g:{+l+#RNL>gd3iQ} ~>,3zhy}J|! -');
 define('NONCE_KEY',        'S43[v K:n_SWC+f7d`xv{M|rCF&2jxD/h~-+h#-Y[%pmo#?cC&%e/cTJ<~3fx,Mm');
 define('AUTH_SALT',        '?,%Jhy;(jE*^l*EGl@>^Vx?PI?x&0rCvz@`2();]Wi BTC7MAy1am#h5-qah|OTz');
 define('SECURE_AUTH_SALT', '0?Kb/kCxa%bBdgZ]ckBG]7t~fS9y<}aPeJ,znJ(/@;?]HJ5=4`fi8xkh.2|e=VPW');
 define('LOGGED_IN_SALT',   'Fk1`oZdw/A(&zBRy.4jbR8@9dnC{/8MLvqHojwQ}w!Xh|)e9:}Nq)b%#b-Lp`/&U');
 define('NONCE_SALT',       '?WW*^E/D`#?[jx<=lxY#yN^5N:+P%kDT@_||92th++qp8wp-6!Y}tIgv6w`R&~BU');

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
