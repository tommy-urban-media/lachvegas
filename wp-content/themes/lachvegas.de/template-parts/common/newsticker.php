<div class="ticker">

  <?php
		$tickerQuery = new WP_Query(
			array(
				'posts_per_page' => 10,
				'post_type' => 'news',
				'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => get_category_by_slug('eilmeldungen')->cat_name
			)
		);
	?>

	<?php if ( $tickerQuery->have_posts() ) : ?>
		<div class="ticker__head">
			<span class="ticker__title">Eilmeldungen</span>
		</div>
		<div class="ticker__body">
			<div class="ticker__list-wrapper">
				<ol class="ticker__list">
					<?php while ( $tickerQuery->have_posts() ) : $tickerQuery->the_post(); setup_postdata($post)?>
						<li class="ticker__list-item">
							<a href="<?= get_the_permalink($post->ID) ?>"><?php the_title() ?></a>
						</li>
					<?php endwhile; ?>
				</ol>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif ?>

</div>