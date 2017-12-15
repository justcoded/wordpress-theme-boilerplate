<?php
/**
 * Page Template: Employee
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
		'employee/_content',
		array(
			'model' => $model,
		)
	);
endwhile;
?>
