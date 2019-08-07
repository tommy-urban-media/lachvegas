<?php
/**
 * The template for displaying all pages.
 */

get_header();
?>

<div class="content content-home">
	<div class="content__area">
		<div class="content__area--wide">

			<?php while ( have_posts() ) : the_post(); ?>
				<article class="article" data-id="<?php echo $post->ID ?>">
					<?php get_template_part('template-parts/article/jsonld'); ?>
                    <?php get_template_part('template-parts/article-socials') ?>	
					
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


	<?php // get_template_part('template-parts/sections/gender') ?>
	<?php get_template_part('template-parts/sections/newsletter') ?>
	<?php //get_template_part('template-parts/sections/lachvegas-fragt-dich') ?>	

</div>


<?php get_footer(); ?>
