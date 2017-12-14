<?php
/* @var $image string */
/* @var $instance array */
?>
<div class="pb-widget pb-widget-num-0">
	<div class="pb-widget-inner">
		<div class="fade-gallery paused">
			<a href="#" class="btn-prev"><i class="icon-chevron-thin-left"></i></a>
			<a href="#" class="btn-next"><i class="icon-chevron-thin-right"></i></a>
			<ul class="gmask">
				<?php foreach ( $image_data as $one_image ) : ?>
					<li class="active">
						<div class="gallery-info">
							<div class="photo"><?php rwd_attachment_image( $one_image['image'], 'hd', 'img' ); ?></div>
							<div class="description">
								<p><?php echo esc_html( $one_image['title'] ); ?></p>
								<dl class="credit">
									<?php $desc = explode( ':', $one_image['description'] ); ?>
									<dt><?php echo esc_html( $desc[0] ); ?>:</dt>
									<dd><?php echo esc_html( $desc[1] ); ?></dd>
								</dl>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>