<?php
/* @var $instance array
 *
 * var $before_widget print:
 * <div class="pb-widget pb-widget-num-2 widget_hero-slider" data-index="1" >
 * <div class="pb-widget-inner" >
 *
 * var $after_widget print:
 * </div></div>
 *
 */
?>

<?php echo $before_widget; ?>
<div class="visual-gallery paused">
	<a href="#" class="btn-prev"><i class="icon-chevron-thin-left"></i></a>
	<a href="#" class="btn-next"><i class="icon-chevron-thin-right"></i></a>
	<ul class="gmask">
		<?php foreach ( $instance['images'] as $one_image ) : ?>
			<li class="">
				<div class="gallery-info-visual">
					<?php rwd_attachment_image( $one_image['image'], 'hd', 'img' ); ?>
					<div class="title-picture"><?php echo esc_html( $one_image['title'] ); ?></div>
					<div><?php echo $one_image['description']; ?></div>
					<div><?php echo $one_image['button_text']; ?></div>
					<div><?php echo $one_image['button_link']; ?></div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php echo $after_widget; ?>
