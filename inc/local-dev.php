<?php
/**
 * Local Dev
 *
 * @package gp-child-theme
 * @author codetot
 * @since 0.0.1
 */

$environment_type = wp_get_environment_type() ?? 'production';

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

/**
 * Disable live plugins on local/development environment
 *
 * @return void
 */
function gp_extended_disable_live_plugins() 
{
	$production_plugins = gp_extended_get_live_plugins();

    if ( !empty($production_plugins) ) :
    	deactivate_plugins( $production_plugins );
    endif;
}

if ( in_array( $environment_type, array( 'local', 'development' ), true ) ) {
	add_action( 'init', 'gp_extended_disable_live_plugins', 1000 );
}