<?php

get_header(); ?>

<div class="content">
	<div class="content__area">
		<div class="content__area--primary">

			<?php if ( have_posts() ): ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Suchergebnisse für: %s' ), get_search_query() ); ?></h1>
				</header><!-- .page-header -->

				<ol class="list list--news">
					<?php while ( have_posts() ) : the_post(); ?>
						<li class="list-item">
							<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
							<span class="post-meta">
								<?= $subtitle ?>
							</span>
							<?php endif ?>
							<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
								<?php the_title() ?>
							</a>
							<div class="post-content">
								<?php if (has_post_thumbnail()):?>
									<a href="<?= get_the_permalink($post->ID) ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
										<figure class="post-image post-image--teaser">
											<?php the_post_thumbnail('article_thumbnail')?>
										</figure>
									</a>
								<?php endif ?>
								<span class="post-date"><?php echo the_date('d.m.Y')?></span>
								<?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
							</div>
						</li>
					<?php endwhile; ?>
				</ol>

			<?php else: ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Suchergebnisse für: %s' ), get_search_query() ); ?></h1>
				</header><!-- .page-header -->

			<?php endif;?>

		</div>

		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>

	</div>
</div>


<?php get_footer(); ?>
