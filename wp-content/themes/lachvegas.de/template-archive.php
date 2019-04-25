<?php
/**
 * Template Name: Archivseite
 */

get_header(); ?>



<main class="main" role="main">

	<div id="content">


	<?php query_posts(array('post_type' => 'post', 'order_by' => 'date', 'order' => 'DESC', 'posts_per_page' => -1))?>

		<?php if(have_posts()): ?>

		<h1><?php _e('Archive')?></h1>

		<ul class="archive-list">
			<?php while ( have_posts() ) : the_post();?>
				<li class="archive-list-item">

					<?php if(has_post_thumbnail()):?>
						<a class="post-image" href="<?php echo get_permalink()?>" title="<?php the_title()?>"><?php the_post_thumbnail('archive-image')?></a>
					<?php else:?>
						<a class="post-image" href="<?php echo get_permalink()?>" title="<?php the_title()?>"><img src="<?php bloginfo('template_url')?>/images/layout/thumbnail-home.jpg" /></a>
					<?php endif;?>

					<a class="post-title" href="<?php echo get_permalink()?>">
						<?php the_title()?>
					</a>

					<span class="post-meta">
						<?php echo _e('geschrieben von ')?> <a class="contact-link" href="#"><?php the_author()?></a> | <?php echo the_date('d. M. Y')?>
					</span>

				</li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>

		<div class="clear"></div>

		<div class="tags">
			<?php $tags = get_tags()?>
			<h3>Tags</h3>
			<ul class="tag-list">
			<?php foreach($tags as $tag):?>
				<li class="archive-tag">
					<a href="<?php echo get_tag_link( $tag->term_id )?>" title="<?php echo $tag->name?>">
						<?php echo $tag->name?> (<?php echo $tag->count?>)
					</a>
				</li>
			<?php endforeach;?>
			</ul>
		</div>

		<?php echo get_template_part('partials/partial', 'content-bottom')?>

	</div>
</div>

<?php get_footer(); ?>
