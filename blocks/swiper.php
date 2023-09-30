<?php
/**
 * Swiper slider
 *
 * @package Gp_Extended
 * @author codetot
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'items' => [],
	'content' => '',
	'pagination' => true,
	'prevNextButtons' => true,
	'scrollbar' => false,
	'swiper_options' => []
]);

if(!empty($data['swiper_options'])) {
	$swiper_options = $data['swiper_options'];
} else {
	$swiper_options = array(
		'slidesPerView'=> 1,
		'pagination' => $data['prevNextButtons'],
		'navigation' => $data['pagination'],
		'spaceBetween' => 30,
		'loop' => true,
	);
}

$_class = 'swiper-wrap' ;

$_class .= !empty($data['class']) ? esc_attr( ' ' . $data['class'] ) : '';

if ( !empty( $data['items'] ) || !empty( $data['content'] ) ) :
?>
	<div class="<?php echo esc_attr( $_class ); ?>" data-options='<?php echo json_encode($swiper_options); ?>'>
		<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php
			if ( !empty($data['items']) ) :
				foreach( $data['items'] as $item ) :
					$_item_class ='swiper-slide';
					if ($item['lazyload']) {
						$_item_class .= ' lazyload';
					}
					?>
					<div class="<?php echo esc_attr( $_item_class ); ?>">
						<?php if ($item['lazyload']) : ?>
							<noscript>
								<?php echo $item['content']; ?>
							</noscript>
						<?php else : ?>
							<?php echo $item['content']; ?>
						<?php endif; ?>
					</div>
				<?php endforeach;
			elseif ( !empty($data['content']) ) :
				echo $data['content'];
			endif;
			?>
			</div>

			<?php if ($data['pagination']) : ?>
				<!-- If we need pagination -->
				<div class="swiper-pagination"></div>
			<?php endif; ?>
			<?php if ($data['scrollbar']) : ?>
				<!-- If we need scrollbar -->
				<div class="swiper-scrollbar"></div>
			<?php endif; ?>
		</div>
		<?php if ($data['prevNextButtons']) : ?>
			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		<?php endif; ?>
	</div>
<?php else : ?>
	<!-- There are no slider items to render -->
<?php endif;
