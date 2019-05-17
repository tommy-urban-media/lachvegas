<?php
/**
 * Template Name: Männerseite
 */

get_header(); 

$count = get_option('posts_per_page', 20);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 20,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => ['post', 'news'],
	'order_by' => 'date', 
	'order' => 'DESC',
);

$posts = new WP_Query($args);

?>


<div class="content">
    <section class="section">
        <div class="section__area">
            <div class="section__area__full">
                <h1 class="page-title">Männerseite</h1>
                <p>Die Seite nur für Männer</p>
            </div>
        </div>
    </section>
</div>

<?php if ( $posts->have_posts() ) : ?>

<div class="grid-wrapper">
    
    <?php while ( $tickerQuery->have_posts() ) : $tickerQuery->the_post(); setup_postdata($post)?>
        
        <div class="grid-item">
            <article class="article">
                <a  class="article__link" href="<?= get_the_permalink($post->ID) ?>">
	                <?php if (has_post_thumbnail($post->ID)):?>
                        <figure class="post-image">
			                <?php the_post_thumbnail('16_9_medium')?>
                        </figure>
	                <?php else: ?>
                    <h3 class="article__title"><?= get_the_title($post->ID) ?></h3>
                </a>
            </article>
        </div>
        
    <?php endwhile ?>
    
    <!--
    <div class="grid-item"><img src="http://lorempixel.com/512/512/people/1" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/600/300/people/2" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/g/people/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    
    <div class="grid-item"><img src="http://lorempixel.com/512/512/fashion/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/fashion/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/256/512/fashion/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/fashion/" alt="Placeholder Image"></div>
    
    <div class="grid-item"><img src="http://lorempixel.com/512/512/fashion/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/fashion/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>

    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>

    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    <div class="grid-item"><img src="http://lorempixel.com/512/512/city/" alt="Placeholder Image"></div>
    -->
    
</div>

<?php endif ?>

<br>

<div class="grid-wrapper">
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>

    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>

    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>

    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>

    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
</div>


<?php get_footer(); ?>
