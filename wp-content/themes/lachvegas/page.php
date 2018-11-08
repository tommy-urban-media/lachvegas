<?php
/**
 * The template for displaying all pages.
 */

get_header();
?>

<main class="main" role="main">

	<div class="content">


		<div class="content-block entry-content">

			<?php while ( have_posts() ) : the_post(); ?>

				<article class="article" data-id="<?php echo $post->ID ?>">

					<?php echo get_template_part('template-parts/article', 'jsonld'); ?>

					<header class="article-header">

						<h1 class="article-title">

							<span class="article-title-headline"><?php the_title()?></span>

						</h1>

					</header>

					<div class="article-content entry-content">

						<?php the_content()?>

					</div>

				</article>


			<?php endwhile; ?>

		</div>


	</div>

	<?php echo get_template_part('sidebar')?>

</main>

<?php get_footer(); ?>
