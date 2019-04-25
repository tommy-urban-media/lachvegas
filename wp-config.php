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
	define('DB_NAME', 'lachvegas');
	
	/** MySQL database username */
	define('DB_USER', 'root');
	
	/** MySQL database password */
	define('DB_PASSWORD', '');
	
	/** MySQL hostname */
	define('DB_HOST', 'localhost');
	
	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');
	
	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');
	
	
	define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
	define('WP_HOME',    'http://' . $_SERVER['HTTP_HOST']);
	define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
	define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content');
	
	define('WP_DEFAULT_THEME', 'lachvegas.de');
	
	
	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	define('AUTH_KEY',         '.AfSvm;G d7BO-b)myy&uJ|lib^Fpw!fM{oxEAK4Y<s1JDs!P__EfQz5()buSj4$');
	define('SECURE_AUTH_KEY',  'rG/t;Dg|9v}5vL=2Dxe6O)eEI-nXa#$d0z!9L9/2H]=y+qV=d{Js4>kikvO@c/Ys');
	define('LOGGED_IN_KEY',    'T+`):IBpC/SfND@N}e}4=sM.-DvW9V17C.#EP&<ayWDXd@NP0~AdnarC@=pkvFQ*');
	define('NONCE_KEY',        'y@lR82&Po9w2&UChiK-4Y-;?T!=`A62dqHVQcJK*[WP7|r py~5Uo-bDn:1p>{_B');
	define('AUTH_SALT',        '{xRJn<LSgjfMV ;+,Pn+_@D(h#P_sx+fNQGw*q.i..jzMP5~9}ZRN$TK :I0%S7|');
	define('SECURE_AUTH_SALT', '~<?/+<{gB9]nX4CvA;q4ne.e0e-PgO!e23m-9k7snp2 dnU~{O])edB|.jWUylHP');
	define('LOGGED_IN_SALT',   '=>#+|+oX}~^F-99]Xfc|z*p3Tz#Omq7px|J>DyAV~4V-Eag4;+j08l_C&Rjv+.)w');
	define('NONCE_SALT',       'cR+OQz7x?UTDF]n&ue;#w~<~S(R6q9s`g|HWSJs*H;s:8hOhhs@v[kP/]U5c?=R3');
	
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
	define('WP_DEBUG', true);
	
	/* That's all, stop editing! Happy blogging. */
	
	/** Absolute path to the WordPress directory. */
	if ( !defined('ABSPATH') )
		define('ABSPATH', dirname(__FILE__) . '/');
	
	/** Sets up WordPress vars and included files. */
	require_once(ABSPATH . 'wp-settings.php');