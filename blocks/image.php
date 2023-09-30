<?php
/**
 * Block: Image
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

$data = wp_parse_args(
	$args,
	array(
		'class'         => '',
		'image_id'      => '',
		'ratio'         => '', // 1x1, 3x4, 9x16
		'placeholder'   => true,
		'wrapper_class' => '',
		'wrapper'       => true,
		'size'          => 'large',
		'lazyload'      => true,
	)
);

$_class  = 'image';
$_class .= ! empty( $data['class'] ) ? esc_attr( ' ' . $data['class'] ) : '';
$_class .= $data['lazyload'] ? ' lazyload' : '';

if ( ! empty( $data['ratio'] ) ) {
	$_class .= ' ratio ratio-' . esc_attr( $data['ratio'] );
}

$image_id = ! empty( $data['image_id'] ) ? $data['image_id'] : '';
if ( empty( $data['image_id'] ) && $data['placeholder'] ) {
	$image_id = get_theme_mod( 'custom_logo' );
	$_class  .= ' image--placeholder';
}

ob_start();
echo wp_get_attachment_image(
	$image_id,
	$data['size'],
	null,
	array(
		'class'   => 'image__img',
		'loading' => false,
	)
);
$image_html = ob_get_clean();

if ( $data['lazyload'] ) :
	$image_html = str_replace( 'src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI7wAAAABJRU5ErkJggg==" data-src="', 'data-src="', $image_html );
	$image_html = str_replace( 'srcset="', 'data-srcset="', $image_html );

	if ( $data['wrapper'] ) : ?>
		<figure class="<?php echo esc_attr( $_class ); ?>">
			<?php echo $image_html; ?>
		</figure>
	<?php else : ?>
		<?php echo $image_html; ?>
		<?php 
	endif;
else :
	echo $image_html;
endif;

