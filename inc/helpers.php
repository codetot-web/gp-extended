<?php
/**
 * Blocks Class
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

/**
 * Display block
 *
 * @param string $block_name
 * @param array $args
 *
 */
function gp_extended_the_block( $block_name, $args = [] ) {
    $block_path = file_exists(
        get_stylesheet_directory() . '/templates/blocks/' . esc_attr( $block_name ) . '.php'
    ) ? get_stylesheet_directory() . '/templates/blocks/' . esc_attr( $block_name ) . '.php' : false;

    if ( ! $block_path ) {
        $block_path = file_exists(
            GP_EXTENDED_DIR . 'blocks/' . esc_attr( $block_name ) . '.php'
        ) ? GP_EXTENDED_DIR . 'blocks/' . esc_attr( $block_name ) . '.php' : false;
    }

    if ($block_path) {

        extract($args, EXTR_SKIP); // phpcs:ignore

        require_once $block_path;
    }
}

/**
 * Get block
 *
 * @param string $block_name
 * @param array $args
 * @return string|null
 */
function gp_extended_get_block( $block_name, $args = [ ] ) {
    ob_start();

    gp_extended_the_block( $block_name, $args );

    return ob_get_clean();
}

/**
 * Get single setting
 *
 * @param string $key
 * @return bool|string|null
 */
function gp_extended_get_setting( $key ) {
	$settings_class = new \GpExtended\Settings();

	return $settings_class->get_setting( $key );
}
