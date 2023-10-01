<?php
/**
 * Settings Class
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended;

class Settings {
	public $settings;

	/**
	 * Load settings
	 */
	function load_settings() {
		$settings = get_option( GP_EXTENDED_SETTINGS_KEY, [] );

		if ( !empty($settings) ) :
			$this->settings = !empty( $settings ) ? $settings : [];
		endif;
	}

	/**
	 * Get setting
	 *
	 * @param string $key
	 * @return bool|string|null
	 */
	public function get_setting( $key ) {
		if ( empty($this->settings) ) {
			$this->load_settings();
		}

		return $this->settings[$key] ?? null;
	}
}

