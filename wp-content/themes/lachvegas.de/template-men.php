<?php
/**
 * Template Name: Männerseite
 */

get_header(); 
?>


<?php while ( have_posts() ) : the_post(); ?>

    <div class="content">
        <section class="section">
            <div class="section__area">
                <div class="section__area__full">
                    <h1 class="page-title"><?php the_title() ?></h1>
                    <?php the_content() ?>
                </div>
            </div>
        </section>
    </div>


    <div class="grid-wrapper">

        <?php $posts = get_field('page_posts', $post->ID)?>

        <?php foreach($posts as $p): ?>
            
            <div class="grid-item">
                <article class="grid-article">
                    <a  class="grid-article__link" href="<?= get_the_permalink($p->ID) ?>">
                        <?php if (has_post_thumbnail($p->ID)):?>
                            <figure class="post-image">
                                <?php echo get_the_post_thumbnail($p->ID, '16_9_medium')?>
                            </figure>
                        <?php endif ?>
                        <h3 class="grid-article__title"><?= get_the_title($p->ID) ?></h3>
                    </a>
                </article>
            </div>
            
        <?php endforeach ?>
        
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

<?php endwhile ?>

<?php get_footer(); ?>
