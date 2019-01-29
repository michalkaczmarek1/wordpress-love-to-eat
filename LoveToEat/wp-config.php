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
define('DB_NAME', 'lovetoeat');

/** MySQL database username */
define('DB_USER', 'michal_kacz');

/** MySQL database password */
define('DB_PASSWORD', 'michal_kacz123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')/j$ZBiG/3=F/u1Er)-6^p5Z{[D9<V2AZUeZ.Lmf~1Bt!l?&P>3sBS>%,lIwGv>I');
define('SECURE_AUTH_KEY',  'j!1|~%a7G^&:k:r9m@377TC#*B >j&0-xZacE-Ak?]UwN4[.lXcw4Ku@dW@g#5Td');
define('LOGGED_IN_KEY',    'tXX{<1a7_jbyH)x!gHJU!e -Zr$]e4C$OU?jU$yv(;9}q>sO#lNj<`Y!=oW@q)id');
define('NONCE_KEY',        'Jl0s3n{22=a8tgWI?V8K9W*y?iK>oV;]]g{8A=5XD)8rk.DC@)*d@jF$4g~K>DyR');
define('AUTH_SALT',        'K:km&&.* XJBOcIIdv<^n.^yJgUu=:vWO6XA=E}E&OHFeJ 3x^S(y@4f>cN6%5e6');
define('SECURE_AUTH_SALT', 'lR[3xgHW^6.jS6(O8,]JBhZ_R,;ixtAzdsZitW9]zk^T|,!c0kk=@;JC8/H=&-a3');
define('LOGGED_IN_SALT',   '~GQ=VHw03j,s.hf)%i]RTutKk]12SaavlQtLrGb]ZgZ})IAO?x^.KG|Z07 499Vu');
define('NONCE_SALT',       '/f]jNBJHJ<1$dISHs}5FZqIeQl/gS|i^1<n9bII/4?wSu&Tt$<Z*9I[<)bC>F,7=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lte_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

