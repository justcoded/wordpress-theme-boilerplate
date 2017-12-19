<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->
	<div>
		<?php
		// print custom field position, if it exists
		if ( $fields->position ) : ?>
			<h3><?php echo $fields->position; ?></h3>
		<?php endif; ?>
		<?php
		// print custom field bio, if it exists
		if ( $fields->bio ) : ?>
			<h3><?php echo $fields->bio; ?></h3>
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
