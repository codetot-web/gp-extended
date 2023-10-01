<?php
/**
 * Customize: Layout
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace GpExtended\Customize;

class Layouts extends Customize_Section {
	/**
	 * Section id
	 *
	 * @var string
	 */
	public $section_id = 'gp_extended_layouts';

	public function __construct()
	{
		add_action( 'customize_register', [$this, 'init'] );
	}

	/**
	 * Get archive layout choices
	 *
	 * @return array
	 */
	function get_archive_item_choices() {
		return apply_filters('gp_extended_archive_item_choices', [
			'minimal'   => _x('Minimal', 'archive layout option', 'gp-extended'),
			'card'      => _x('Card', 'archive layout option', 'gp-extended'),
			'newspaper' => _x('Newspaper', 'archive layout option', 'gp-extended'),
			'creative'  => _x('Creative', 'archive layout option', 'gp-extended')
		]);
	}

	/**
	 * Get archive layout choices
	 *
	 * @return array
	 */
	function get_archive_layout_choices() {
		return apply_filters('gp_extended_archive_layout_choices', [
			'2-col'  => sprintf( _n('%d column', '%d columns', 'gp-extended', 2), 2 ),
			'3-col'  => sprintf( _n('%d column', '%d columns', 'gp-extended', 3), 3 ),
			'4-col'  => sprintf( _n('%d column', '%d columns', 'gp-extended', 4), 4 ),
			'5-col'  => sprintf( _n('%d column', '%d columns', 'gp-extended', 5), 5 ),
		]);
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

		$section_name = __('Layouts', 'gp-extended');

		$this->add_section($this->section_id, $section_name);

		$controls = [
			[
				'id'       => 'archive_item',
				'name'     => __('Archive: Item', 'gp-extended'),
				'settings' => [
					'default' => 'minimal',
					'sanitize_callback' => 'sanitize_text_field'
				],
				'args' => $this->get_final_control_args([
					'type'    => 'select',
					'choices' => $this->get_archive_item_choices()
				])
			],
			[
				'id'       => 'archive_layout_column',
				'name'     => __('Archive: Column Layout', 'gp-extended'),
				'settings' => [
					'default' => '3-col',
					'sanitize_callback' => 'sanitize_text_field'
				],
				'args' => $this->get_final_control_args([
					'type'    => 'select',
					'choices' => $this->get_archive_layout_choices()
				])
			],
			[
				'id'       => 'archive_enable_load_more_description',
				'name'     => __('Archive: Enable Load more description', 'gp-extended'),
				'settings' => [
					'default' => false
				],
				'args' => $this->get_final_control_args([
					'type' => 'checkbox'
				])
			],
			[
				'id'       => 'single_post_enable_author_box',
				'name'     => __('Single Post: Enable Author Box', 'gp-extended'),
				'settings' => [
					'default' => true
				],
				'args' => $this->get_final_control_args([
					'type' => 'checkbox'
				])
			],
			[
				'id'       => 'single_post_enable_social_share',
				'name'     => __('Single Post: Enable Social Share', 'gp-extended'),
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

new Layouts();
