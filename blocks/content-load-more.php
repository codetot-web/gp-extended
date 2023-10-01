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

ob_start(); ?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 66.91" width="16" height="12"><path d="M11.68,1.95C8.95-0.7,4.6-0.64,1.95,2.08c-2.65,2.72-2.59,7.08,0.13,9.73l54.79,53.13l4.8-4.93l-4.8,4.95 c2.74,2.65,7.1,2.58,9.75-0.15c0.08-0.08,0.15-0.16,0.22-0.24l53.95-52.76c2.73-2.65,2.79-7.01,0.14-9.73 c-2.65-2.72-7.01-2.79-9.73-0.13L61.65,50.41L11.68,1.95L11.68,1.95z" fill="currentColor" /></svg>
<?php
$svg_icon_html = ob_get_clean();

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
		<button type="button" class="btn btn-dark text-white d-inline-flex align-items-center content-load-more__button js-trigger">
			<span class="text pe-none js-trigger-text"><?php echo esc_html( $data['open_text'] ); ?></span>
			<span class="icon pe-none" aria-hidden="true"><?php echo $svg_icon_html; // phpcs:ignore ?></span>
		</button>
	</div>
</div>
