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
define('DB_NAME', 'pawsunion');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '5Wz1>IFGTX`<Z0afg/J-B:X_kdbf~jLYNHUMpFR*,J)N}4e9~HO;cvl25;*Kf*F~');
define('SECURE_AUTH_KEY',  'BinCTSB8ej?2W_b9_fNq9CHF{R?=RPCU%LAykr%Y?&l(b=7TV6?Ye-ho5[{ReWgv');
define('LOGGED_IN_KEY',    'n`o%T~u*#>U+H?imT3gjw-_O0Wx9=k:phPevFu/)421=8Q91y`bv]Lgn-[-mLn[}');
define('NONCE_KEY',        'viB9X}S$,TM{2^(+fx`6n6VSGb6sRKN_|Wqek65+n?}x^srqq~XsZlgoDT<97sm,');
define('AUTH_SALT',        'c%!8m?L}Cd&Vfd=3nQ4DiX9U *]DPy{cJ}cEXx92:yin6-z:3^q%;F:Er=;C;L3A');
define('SECURE_AUTH_SALT', '|AzYW]}^t[R;+]:BhY7$Z.Au/c;>1j)8wPfqqA`axq_zB3R}a_4M jKhsaMU#t_(');
define('LOGGED_IN_SALT',   '+LbG>F`)~X:p)g^O5&(nR2UV$9s^;+l)8984#x^7Ys[8>MvSpbXaH(P_nv3.BzkQ');
define('NONCE_SALT',       '~`T;r-+@OLzDe[nMYBg.Q=m_&y(xt:fD2@p*l%IZ%-O^K21`IykE+WqbnTeNKa4:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
