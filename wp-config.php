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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bouwbedrijf_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'X~~fkK|1UclO(Xi8m4Te#c(xZvz7)t!nV2{YcF(oU8.[U]O&dde Vf_qxRV+{z|?' );
define( 'SECURE_AUTH_KEY',  'Y{lsWy2|wttB*/AU8Za#i{nUo_1/[ ?Hq:lEjgkoR_7xV971:>bp9u+-Jts]Vh_]' );
define( 'LOGGED_IN_KEY',    '/h{a !LOS5 YQ(WJI:3p0P$gSeN&X6{%{Gm_3b1b44/z}z}IcX(<G/.i;rWwbm4X' );
define( 'NONCE_KEY',        'q*Ws+/$?4UBjT8S>NXURC`bLv]nCTc^dPc0W~/jJc(z1jyP51N[&s]uie]*rKAAH' );
define( 'AUTH_SALT',        'CO50K<6#CM$k1l3$JB.o+Hri}.;d~NbovSwkG<nf,H.qFHFwmYc#IAf(eIzFwv[~' );
define( 'SECURE_AUTH_SALT', 'QQ^.7+b0$aWc:Z9+--Mp~Kx/h<;0x5;:yQXS]iBoX%PF4r0aUnhPYxI{70}|tX=#' );
define( 'LOGGED_IN_SALT',   'OoHGs,0KwW,,G93ywjyh+,/`uwk,0%yMnL}6YvOR5Vj/yvfji&7YbM];V7?2@?{V' );
define( 'NONCE_SALT',       'mq<]Y#0ws.>/1Ms6?&#,5l[[=7FrJAS$ALOuJYPU4Ae2_hdkl+ySZY1nX}eyK2ej' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
