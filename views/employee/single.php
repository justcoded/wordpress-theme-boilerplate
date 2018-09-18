<?php
/**
 * The template for displaying CPT single template
 *
 * @var View $this
 */

use JustCoded\WP\Framework\Objects\Postmeta;
use JustCoded\WP\Framework\Web\View;

// Post meta object.
$fields = new Postmeta();

$this->extends( 'layouts/main' ); ?>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php if ( $fields->position ) : ?>
				<h3><?php echo esc_html( $fields->level . ' ' . $fields->position ); ?></h3>
			<?php endif; ?>
			<?php if ( $fields->bio ) : ?>
				<p><?php echo nl2br( esc_html( $fields->bio ) ); ?></p>
			<?php endif; ?>
		</div>
	</article><!-- #post-## -->

<?php endwhile; // End of the loop. ?>
