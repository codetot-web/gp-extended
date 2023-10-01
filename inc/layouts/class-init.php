<?php
/**
 * Init all layouts
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace Gp_Extended\Layouts;

/**
 * Init Class
 */
class Init {
	public function __construct()
	{
		$this->load_classes();
	}

	/**
	 * Load other classes
	 */
	function load_classes() {
		require_once GP_EXTENDED_DIR . 'inc/layouts/archive.php';
	}
}

new Init();
