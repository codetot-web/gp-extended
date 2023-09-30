<?php
/**
 * Block: Button
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */


$data = wp_parse_args(
	$args,
	array(
		'class'        => '',
		'type'         => '',
		'size'         => '',
		'button_text'  => '',
		'button_url'   => '',
		'button_attrs' => '',
		'icon_before'  => '',
		'icon_after'   => '',
		'link_target'  => '_self',
		'link_title'   => '',
	)
);

$link_title = $data['link_title'] ?? sprintf( __( 'View %s', 'gp-extended' ), $data['button_text'] );

$_class  = 'btn';
$_class .= ! empty( $data['size'] ) ? esc_attr( 'btn-' . $data['size'] ) : ''; // sm, lg
$_class .= ! empty( $data['type'] ) ? esc_attr( ' btn-' . $data['type'] ) : ' btn-primary'; // primary, dark, light, gray, outline
$_class .= ! empty( $data['class'] ) ? esc_attr( ' ' . $data['class'] ) : '';

ob_start();
if ( ! empty( $data['icon_before'] ) ) : ?>
	<span class="icon" aria-hidden="true"><?php echo $data['icon_before']; ?></span>
	<span class="text"><?php echo esc_html( $data['button_text'] ); ?></span>
<?php elseif ( ! empty( $data['icon_after'] ) ) : ?>
	<span class="text"><?php echo esc_html( $data['button_text'] ); ?></span>
	<span class="icon" aria-hidden="true"><?php echo $data['icon_after']; ?></span>

	<?php
else :
	echo esc_html( $data['button_text'] );
endif;
$button_html = ob_get_clean();

if ( ! empty( $data['button_url'] ) ) :
	?>
	<a class="<?php echo esc_attr( $_class ); ?>" href="<?php echo esc_url_raw( $data['button_url'] ); ?>" title="<?php echo esc_attr( $link_title ); ?>" target="<?php echo esc_attr( $data['link_target'] ); ?>">
		<?php echo $button_html; // phpcs:ignore ?>
	</a>
<?php else : ?>
	<button class="<?php echo esc_attr( $_class ); ?>">
		<?php echo $button_html; // phpcs:ignore ?>
	</button>
	<?php
endif;
