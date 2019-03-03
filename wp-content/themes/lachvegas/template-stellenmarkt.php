<?php
/**
 * Template Name: Stellenmarkt
 */

get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'job',
	'order_by' => 'date', 
	'order' => 'DESC',
);

$queryNews = new WP_Query($args);


$jobCategories = get_terms(array(
	'taxonomy' => 'job_categories',
	'hide_empty' => true,
));

?>


<div class="container">
	<div class="column small-3 medium-3 large-3">
		
		<div class="jobs-filters">
			<div class="panel">
				<h3 class="panel-header">Anstellungsart</h3>
				<div class="panel-content">
					<ul>
						<li>
							<label>Ausbildung</label>
							<input type="checkbox" />
						</li>
						<li>Vollzeit</li>
						<li>Proband</li>
						<li>Selbständig/Freelancer</li>
						<li>Teilzeit</li>
						<li>Trainee</li>
						<li>Mir doch scheißegal</li>
					</ul>
				</div>
			</div>

			<div class="panel">
				<h3 class="panel-header">Kategorien</h3>
				<div class="panel-content">
					<ul>
						<?php foreach ($jobCategories as $jobCategory): ?>
							<li>
								<a href="<?php echo get_term_link($jobCategory->term_id) ?>"><?= $jobCategory->name ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>

	</div>

	<div class="column small-9 medium-9 large-9 panel">

		<?php while ( have_posts() ) : the_post(); ?>
			<div class="entry-content">
				<?php the_content() ?>
			</div>
		<?php endwhile; ?>


		<?php if ($queryNews->have_posts()): ?>
		<ul class="job-items-list">
			<?php while ( $queryNews->have_posts() ) : $queryNews->the_post();?>
				<li class="job-item">
					<?php get_template_part('template-parts/teasers/job') ?>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php echo getPagination($queryNews, $paged)?>

		<?php wp_reset_postdata();?>

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
