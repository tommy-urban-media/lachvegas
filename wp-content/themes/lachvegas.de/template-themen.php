<?php
/**
 * Template Name: Themen
 */

get_header(); 

$tags = get_tags(array('hide_empty' => false)); 
?>


<div class="content">
	<div class="content__area">
		<div class="content__area--primary">

			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title() ?></h1>
				<div class="article__content"><?php the_content() ?></div>
			<?php endwhile ?>

			<br><br><br>

			<ul class="list list--tags">
				<?php foreach($tags as $tag):?>
					<li class="list-item">
						<a href="<?php echo get_tag_link( $tag->term_id )?>" title="<?php echo $tag->name?>">
							<?php echo $tag->name?> (<?php echo $tag->count?>)
						</a>
					</li>
				<?php endforeach;?>
			</ul>

		</div>

		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>

	</div>
</div>

<?php get_footer(); ?>
