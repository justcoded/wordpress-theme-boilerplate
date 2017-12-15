<?php
/* @var $image string */
/* @var $instance array */
?>

<div class="visual-gallery paused">
	<a href="#" class="btn-prev"><i class="icon-chevron-thin-left"></i></a>
	<a href="#" class="btn-next"><i class="icon-chevron-thin-right"></i></a>
	<ul class="gmask">
		<?php foreach ( $instance['images'] as $one_image ) : ?>
			<li class="">
				<div class="gallery-info-visual">
					<?php rwd_attachment_image( $one_image['image'], 'hd', 'img' ); ?>
					<div class="title-picture"><?php echo esc_html( $one_image['title'] ); ?></div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
