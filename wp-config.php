<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'branchiz_wor4757');

/** MySQL database username */
define('DB_USER', 'branchiz_wor4757');

/** MySQL database password */
define('DB_PASSWORD', 'Hl9DcTbkANCJ');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'QDAuFpnlkXz=&cY]@Su&p!u!>f>E!hwTb?cXOQorCBZ^_[?$p>|oe=ZAmpaEVwU=Vb+f??hhnLqL)lcQy^rN*rhm<(c])^]x@q?|hB=^$k^X=Wpj]]Yh;meE$n&)|iox');
define('SECURE_AUTH_KEY', '@eyLzaCH]z(H_Qi|!WR%AUSUPN{=(qgPUD;wlo(xRgFuxtyIu|sIfIHXMR)*LYn=S-UBcYG?M)DD@q<KNGV&d=Rds}b$TnyB_m-//E]Z!/(K-saAKFJX+%ZaLNn|doY%');
define('LOGGED_IN_KEY', 'BJGNW!r(oGa)LM-SMUc_(m^Nl<MwoCn/^QTFIzRza{c?i$GZydRz/+}*w>kFuwDeBqtP+=^YUSjkRix;@GK&/Qla[]U^?tNjONLfCXy/|B/JHSaB&y=&w)%HHzgxJ]$Q');
define('NONCE_KEY', 'ie>OL([[qUUFOIZ)$@FACsc&kEl(cuifxi<d?@}J!?ssyBlK[pX({IMGXqi-P^|lYp+[GCybfMTQUZyh%&!RVPfk/w%XGr;}/UCLJ=VF?V<Utw^>*/oLlv_/^vs@uk_+');
define('AUTH_SALT', 't*OrF|-z+C}Ifxy>ygpoT^Hu)=>]MxHQU/TjNPbDGuX)FD_aarWgQNvmE$o;cF!|LD=yW_]CZfb^>&sIXD}=iIq>@u>Ghxt}MTK{J[bveJ*][[K&ng{kU;W!Vpy@]kZ;');
define('SECURE_AUTH_SALT', 'Iu$lA{FbryGZ&PLfxO&vtFzc??PHM$S?]HoS[EzEuEBfeL&Uu|uNvbt(WKrkJKr=Ce&U!SqMSS!}<+}c;oYgQfBdV$IqCs<}ojUpVFqIzH)aX)DLbdmRWCx(F*>MbudW');
define('LOGGED_IN_SALT', '>Q*/vQG-{uE^wsJok<(|{IBchY{BHZI>o]B|[AiJ/]PkVm;u!=d[b@>+UE!tnGKc{VlG@AH]H]&Ru^P?adXnwQXwdF-PlD{y]vsVZ>?kPAOmN}giw}jkQqqoo!fh|)w>');
define('NONCE_SALT', 'O+)}V-&@H$@IcAV!RddRMGU(U+@Sgw}wtWGvxT>^E;-gKOM<p{Na(kCYi;gQclJ}c(;oWs[TxLmym^Yqey|l%Lq=[?e{HUTFS>;mFTg>p;(mZUAk%Hi{ubWSRFQoER$y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_vpfo_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
