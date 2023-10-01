<?php
/**
 * Block: Content Load More
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

$data = wp_parse_args(
	$args,
	array(
		'class'      => '',
		'content'    => '',
		'open_text'  => __( 'View more', 'codetot-components' ),
		'close_text' => __( 'Collapse', 'codetot-components' ),
		'height'     => 200,
	)
);

$_class  = 'content-load-more';
$_class .= ! empty( $data['class'] ) ? esc_attr( ' ' . $data['class'] ) : '';

?>
<div class="<?php echo esc_attr( $_class ); ?>"
	data-block="content-load-more"
	data-max-height="<?php echo esc_attr( $data['height'] ); ?>"
	data-open-text="<?php echo esc_attr( $data['open_text'] ); ?>"
	data-close-text="<?php echo esc_attr( $data['close_text'] ); ?>"
>
	<div class="overflow-hidden content-load-more__main js-wrapper-content" style="overflow: hidden; max-height: <?php echo esc_attr( $data['height'] . 'px' ); ?>">
		<div class="content-load-more__content js-content">
			<?php echo wpautop( do_shortcode( $data['content'] ) ); ?>
		</div>
	</div>
	<div class="content-load-more__footer">
		<button class="btn d-inline-flex align-items-center content-load-more__button js-trigger">
			<span class="text pe-none js-trigger-text"><?php echo esc_html( $data['open_text'] ); ?></span>
			<span class="icon text-primary pe-none" aria-hidden="true"><?php echo ct_gp_get_svg_icon( 'arrow-down' ); ?></span>
		</button>
	</div>
</div>
