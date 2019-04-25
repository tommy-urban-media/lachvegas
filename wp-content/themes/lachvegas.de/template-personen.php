<?php
/**
 * Template Name: Personen
 */

get_header(); 

$terms = get_terms(
  array(
    'hide_empty' => false,
    'taxonomy' => 'people',
    'order' => 'DESC',
		//'orderby' => 'name'
		'orderby' => 'count'
  )
);

// var_dump($terms);

?>

<div class="content">

	<section class="section">
	<div class="section__area">
		<div class="section__area__full">
			<h1 class="page-title"><?php _e('Personen')?></h1>

				<?php if ( !empty($terms) ) : ?>
					<ol class="teasers-vip">
						<?php $i = 0; ?>
						<?php foreach ( $terms as $term ):?>
							
							<?php 

								$image = get_field('taxonomy_image', $term->taxonomy . '_' . $term->term_id);

								$imageUrl = false;
								if (isset($image['sizes'])) {
									$imageUrl = $image['sizes']['thumbnail'];
								}

								$role = get_field('taxonomy_subtitle', $term->taxonomy . '_' . $term->term_id) or '-';

							?>
							<li class="list-item">
								<a href="<?= get_term_link($term->term_id) ?>">
									<span class="image-wrapper">
										<?php if($imageUrl): ?>
											<img src="<?= $imageUrl; ?>" alt="<?= $term->name ?>"/>
										<?php endif ?>
									</span>
									<span class="person-role"><?= $role ?></span>
									<span class="person-name"><?= $term->name ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ol>
				<?php endif ?>



			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
