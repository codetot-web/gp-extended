<?php
/**
 * Customize: Extra Features
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended\Customize;

class Features extends Customize_Section {
	/**
	 * Section id
	 *
	 * @var string
	 */
	public $section_id = 'gp_extended_features';

	public function __construct()
	{
		add_action( 'customize_register', [$this, 'init'] );
	}

	function get_final_control_args( $args ) {
		$default_args = [
			'section' => $this->section_id
		];

		return array_merge( $default_args, $args );
	}

	/**
	 * Init
	 */
	function init( $wp_customize )
	{
		$this->wp_customize = $wp_customize;

		$section_name = __('Features', 'gp-extended');

		$this->add_section($this->section_id, $section_name);

		$controls = [
			[
				'id'       => 'global_enable_slideout_menu',
				'name'     => __('Enable Slideout Menu', 'gp-extended'),
				'settings' => [
					'default' => true
				],
				'args' => $this->get_final_control_args([
					'type' => 'checkbox'
				])
			]
		];

		$this->add_controls($controls);
	}
}

new Features();
