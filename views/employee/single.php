<?php
/**
 * The template for displaying CPT single template
 */

use JustCoded\WP\Framework\Objects\Postmeta;
use JustCoded\WP\Framework\Web\View;

/* @var View $this */

// Post meta object.
$fields = new Postmeta();

$this->extends( 'layouts/main' ); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
		<div>
			<?php if ( $fields->position ) : ?>
				<h3><?php echo esc_html( $fields->position ); ?></h3>
			<?php endif; ?>
			<?php if ( $fields->bio ) : ?>
				<p><?php echo esc_html( $fields->bio ); ?></p>
			<?php endif; ?>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->

<?php endwhile; // End of the loop. ?>
