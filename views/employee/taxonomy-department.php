<?php
/**
 * The template for displaying custom taxonomy pages inside some CPT.
 *
 * @var View $this
 */

use JustCoded\WP\Framework\Objects\Termmeta;
use JustCoded\WP\Framework\Web\View;

// term meta object.
$fields = new Termmeta();

$this->extends( 'layouts/main' ); ?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<div>
		<?php if ( $fields->featured_image ) : ?>
			<?php rwd_attachment_image( $fields->featured_image, 'hd', 'img' ); ?>
		<?php endif; ?>
		<?php if ( $fields->subheading ) : ?>
			<h3><?php echo esc_html( $fields->subheading ); ?></h3>
		<?php endif; ?>
	</div>

	<?php
	while ( have_posts() ) :
		the_post();

		$this->include( 'employee/_content' );
	endwhile;

	the_posts_navigation();
	?>

<?php else : ?>

	<?php $this->include( 'search/_nothing' ); ?>

<?php endif; ?>
