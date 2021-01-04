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
define( 'DB_NAME', 'vimfilec_wp480' );

/** MySQL database username */
define( 'DB_USER', 'vimfilec_wp480' );
// define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'H8p9Sn@-7F' );
// define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'ukp1oj2gdqfmdmwdabtepdrhwuueomnzlaio7ru0tsfkldxogde0gjehfsj5o7ke' );
define( 'SECURE_AUTH_KEY',  'hyufiiawohomr50ajmdwanbzcapz8teltztxjdeqdcjpx4rfdieifsa4lhizafjw' );
define( 'LOGGED_IN_KEY',    'ddwefjk4pgwza0kyyr2kwkoxgafebqaslrjdhj5ekp8nmzxl30a1ry4aeyrgpd6b' );
define( 'NONCE_KEY',        'cpg2fpf6gq3pyvoeiowy6judiza7p0uglpz1rt9a2xsp4wlb8w4tukvmlcevrtpt' );
define( 'AUTH_SALT',        'ze6bvkdmseqlot7dldrfprrka3bc5enlagzgpwrprm94kmnpncj84mkdpqdxypne' );
define( 'SECURE_AUTH_SALT', 'xisrrm0uspglkmvpidbpau6zzrofg8moscsejr5fdgjuwlfp4iinudsar1wxon4y' );
define( 'LOGGED_IN_SALT',   'l40lizxuatpp780kfb3ge0mjxrzhuv2likpei1276bawlvmzdviet9psj3rh1rvg' );
define( 'NONCE_SALT',       '2pjgtbbn8klpfrh31f3lhxqnqzgrfjegxtwdbzir0ne1p1jltifdkj5abh0vqn9v' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wplg_';

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
