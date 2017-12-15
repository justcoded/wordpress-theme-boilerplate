<?php
/* Template Name: Employee Archive */

$model = new Boilerplate\Theme\Models\Employee();

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php $this->render( 'page/_content', array(
		'referer' => 'employee',
	) ); ?>

<?php endwhile; // End of the loop. ?>

<?php while ( $model->query->have_posts() ) : $model->query->the_post(); ?>
	<?php $this->render( 'employee/_content' ); ?>
<?php endwhile; ?>

<?php if ( $model->query->max_num_pages > 1 ) : // check if the max number of pages is greater than 1.  ?>
	<nav class="pagenav">
		<div class="alignleft">
			<?php echo cpt_prev_posts_link( $model->query, 'Prev Page' ); // display newer posts link. ?>
		</div>
		<div class="alignright">
			<?php echo cpt_next_posts_link( $model->query, 'Next Page' ); // display older posts link. ?>
		</div>
	</nav>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
