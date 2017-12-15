<?php
/* @var $image string */
/* @var $instance array */
?>

<div class="fade-gallery paused">
	<a href="#" class="btn-prev"><i class="icon-chevron-thin-left"></i></a>
	<a href="#" class="btn-next"><i class="icon-chevron-thin-right"></i></a>
	<ul class="gmask">
		<?php foreach ( $instance['images'] as $one_image ) : ?>
			<li class="active">
				<div class="gallery-info">
					<div class="photo"><?php rwd_attachment_image( $one_image['image'], 'hd', 'img' ); ?></div>
					<div class="description">
						<p><?php echo esc_html( $one_image['title'] ); ?></p>
						<div><?php echo $one_image['description']; ?></div>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
