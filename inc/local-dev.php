<?php
/**
 * Local Dev
 *
 * @package gp-child-theme
 * @author codetot
 * @since 0.0.1
 */

$environment_type = wp_get_environment_type() ?? 'production';

/**
 * Get list of live plugins which need to disable on local environment
 *
 * @return array
 */
function gp_extended_get_live_plugins() {
    $default_plugins = array(
		'litespeed-cache/litespeed-cache.php',
		'w3-total-cache/w3-total-cache.php',
		'wp-asset-clean-up/wpacu.php',
		'cloudflare/cloudflare.php',
		'wordfence/wordfence.php',
		'post-smtp/postman-smtp.php',
		'seo-by-rank-math/rank-math.php',
		'wpvivid-backup-pro/wpvivid-backup-pro.php',
		'wpvivid-backuprestore/wpvivid-backuprestore.php',
		'wpvivid-imgoptim/wpvivid-imgoptim.php',
	);

    return apply_filters('gp_extended_disable_live_plugins', $default_plugins);
}

if ( ! function_exists('gp_extended_disable_live_plugins' ) && in_array( $environment_type, array( 'local', 'development' ), true ) ) {
	/**
	 * Disable live plugins on local/development environment
	 */
	function gp_extended_disable_live_plugins() 
	{
		$production_plugins = gp_extended_get_live_plugins();

		if ( !empty($production_plugins) ) :
			deactivate_plugins( $production_plugins );
		endif;
	}

	add_action( 'init', 'gp_extended_disable_live_plugins', 1000 );
}

if ( ! function_exists('gp_extended_is_local_env' ) ) {
	/**
	 * Check if is localhost:3000 with child theme
	 *
	 * @return bool
	 */
	function gp_extended_is_local_env() {
		return ! empty( $_SERVER['HTTP_X_CODETOT_CHILD_THEME_HEADER'] ) && 'development' === $_SERVER['HTTP_X_CODETOT_CHILD_THEME_HEADER'];
	}
}