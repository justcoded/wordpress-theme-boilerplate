<?php
/**
 * The template for displaying archive pages.
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

use Boilerplate\Theme\Models\Employee;

$this->extends( 'layouts/main' );

$model = new Employee();
?>

<?php
while ( $model->post_employee->have_posts() ) : $model->post_employee->the_post();
	$model->set_post();
	$this->render(
		'post/_content',
		array(
			'model' => $model,
		)
	);
endwhile;
?>
