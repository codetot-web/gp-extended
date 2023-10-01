<?php
/**
 * Customize Init Class
 *
 * @package GP_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended\Customize;

/**
 * Init
 */
 class Init {
	/**
	 * Global $wp_customize
	 *
	 * @var object
	 */
	public $wp_customize;

	public function __construct()
	{
		add_action('init', [$this, 'load_classes']);
		add_action('customize_register', [$this, 'register_customize'], 1);
	}

	/**
	 * Register customize panel
	 *
	 * @return void
	 */
	function register_customize( $wp_customize )
	{
		$wp_customize->add_panel('gp-extended-panel', [
			'title' => __('GP Extended Settings', 'gp-extended')
		]);
	}

	/**
	 * Load classes
	 */
	function load_classes()
	{
		require_once GP_EXTENDED_DIR . '/inc/customize/abstract-customize-section.php';

		require_once GP_EXTENDED_DIR . '/inc/customize/layouts.php';
		require_once GP_EXTENDED_DIR . '/inc/customize/features.php';
	}
}

new Init();
