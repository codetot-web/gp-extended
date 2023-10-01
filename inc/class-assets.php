<?php
/**
 * Assets Class
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended;

class Assets {
	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'frontend_assets'], 5);
	}

	/**
	 * Frontend Assets
	 */
	function frontend_assets()
	{
		$allow_enqueue_assets = apply_filters('gp_extended_frontend_assets_enqueue', true);

		if ($allow_enqueue_assets) {
			wp_enqueue_style('gp-extended-style', GP_EXTENDED_PLUGIN_URI . '/assets/css/frontend.min.css', [], GP_EXTENDED_VERSION);
		}
	}
}

new Assets();
