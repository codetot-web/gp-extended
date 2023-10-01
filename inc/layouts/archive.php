<?php
/**
 * Archive layout
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

namespace Gp_Extended\Layouts;

/**
 * Archive Class
 */
class Archive {
	public function __construct()
	{
		add_action('wp', [$this, 'archive_layout']);
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	function archive_layout()
	{
		if ( !is_archive() ) {
			return;
		}

		$archive_load_more = gp_extended_get_setting('archive_enable_load_more_description') ?? false;

		var_dump( $archive_load_more );

		if ( $archive_load_more) {
			remove_action( 'generate_after_archive_title', 'generate_do_archive_description' );
			add_action( 'generate_after_archive_title', [$this, 'archive_description_load_more'] );
		}
	}

	function archive_description_load_more()
	{
		$term_description = get_the_archive_description();

		if ( ! empty( $term_description ) ) {
			gp_extended_the_block('content-load-more',
				array(
					'content' => $term_description,
					'height'     => 250
				)
			);
		}

		/**
		 * GeneratePress: generate_after_archive_description hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_archive_description' );
	}
}

new Archive();
