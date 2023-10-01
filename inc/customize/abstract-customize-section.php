<?php
/**
 * Section Customize Class
 *
 * @package GP_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended\Customize;

abstract class Customize_Section {
	/**
	 * Global $wp_customize
	 *
	 * @var object
	 */
	public $wp_customize;

	/**
	 * Panel id
	 *
	 * @var string
	 */
	public $panel_id = 'gp-extended-panel';

	public function __construct() {}

	/**
	 * Add section
	 *
	 * @param string $section_id
	 * @param string $section_name
	 */
	public function add_section($section_id, $section_name)
	{
		$this->wp_customize->add_section(sanitize_key( $section_id ), [
			'title' => sanitize_text_field( $section_name ),
			'panel' => $this->panel_id
		]);
	}

	/**
	 * Add controls
	 *
	 * @param array $controls
	 */
	public function add_controls( $controls )
	{
		if ( empty($controls) ) {
			return;
		}

		foreach( $controls as $control) {
			$this->add_control( $control );
		}
	}

	/**
	 * Get control setting
	 *
	 * @param string $control_id
	 *
	 * @return string
	 */
	private function get_control_setting( $control_id )
	{
		return sprintf( '%s[%s]', GP_EXTENDED_SETTINGS_KEY, sanitize_key( $control_id ) );
	}

	/**
	 * Add control
	 *
	 * @param array $control_args (with 'id', 'name', 'settings', 'args')
	 */
	public function add_control( $control_args ) {
		$control_id = $control_args['id'];

		$default_settings = [
			'type' => 'option',
			'capability' => 'edit_theme_options'
		];

		$final_settings = wp_parse_args($default_settings, $control_args['settings']);

		$this->wp_customize->add_setting($this->get_control_setting( $control_id ), $final_settings);

		$default_control_args = [
			'label' => sanitize_text_field( $control_args['name'] ),
			'settings' => $this->get_control_setting( $control_id )
		];

		$final_control_args = wp_parse_args($default_control_args, $control_args['args']);

		$this->wp_customize->add_control($control_id, $final_control_args);
	}
}
