<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/config.php';

if ( $_ENV['DEBUG'] ?? false ) {
	// error_reporting( E_ALL );
	// ini_set( 'display_errors', 1 );
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_DISPLAY', true );
}

// Set the WordPress path inside the vendor.
define( 'ABSPATH', realpath( __DIR__ . '/../wordpress' ) . '/' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'WPINC', 'wp-includes' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'WP_CONTENT_DIR', 'wp-content' );

// Load only the necessary WP Core.
require ABSPATH . 'wp-includes/load.php';
require ABSPATH . 'wp-includes/plugin.php';
require ABSPATH . 'wp-includes/class-wp-http.php';
require ABSPATH . 'wp-includes/class-wp-http-requests-hooks.php';
require ABSPATH . 'wp-includes/class-wp-http-proxy.php';
require ABSPATH . 'wp-includes/class-wp-http-response.php';
require ABSPATH . 'wp-includes/class-wp-http-cookie.php';
require ABSPATH . 'wp-includes/class-wp-http-requests-response.php';
require ABSPATH . 'wp-includes/http.php';
require ABSPATH . 'wp-includes/functions.php';
require ABSPATH . 'wp-includes/class-wp-error.php';
require ABSPATH . 'wp-includes/formatting.php';
require ABSPATH . 'wp-includes/compat.php';
require ABSPATH . 'wp-includes/cache.php';

// Start the WordPress object cache, or an external object cache if the drop-in is present.
wp_start_object_cache();

function get_bloginfo( $info ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	$return = null;
	switch ( $info ) {
		case 'version':
			$return = '6.7.2';
			break;
		case 'url':
			if ( isset( $_SERVER['HTTP_HOST'] ) ) {
				$scheme = ! empty( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'] ? 'https' : 'http';
				$host   = sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) );
				$return = "{$scheme}://{$host}";
			}
			break;
	}
	return $return;
}
