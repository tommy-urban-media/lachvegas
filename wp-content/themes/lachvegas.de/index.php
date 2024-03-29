<?php
/**
 * Index template of this theme
 *
 * @author Tommy Krueger
 *
 */

get_header(); ?>

		<div id="primary">

			<div id="content" role="main">

			<?php
			if(is_home()):
				query_posts( 'posts_per_page=15' );
			endif;
			?>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'excerpt' ); ?>

				<?php endwhile; ?>

				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'theme' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'theme' ); ?></p>
							<?php get_search_form(); ?>jbhj
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				<?php endif; ?>

			<div id="content-bottom">
				<img id="trees-bg" src="<?php bloginfo('template_url')?>/images/layout/trees-bg.png" />
				<img id="binary-tree" src="<?php bloginfo('template_url')?>/images/layout/binary-tree.png" />
			</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
