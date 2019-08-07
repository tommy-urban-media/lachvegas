<?php global $categoryQuery?>
<div class="content content-home">

    <?php get_template_part('template-parts/common/breadcrumb') ?>
 
    <div class="content__area">
        <div class="content__area--wide">

            <?php if ( $categoryQuery->have_posts() ) : ?>
                <h1><?php echo single_cat_title() ?></h1>

                <?php if ($categoryDescription = category_description($cat)): ?>
                    <div class="category-description">
                        <?php echo $categoryDescription ?>
                    </div>
                <?php endif ?>

                <?php if ($categoryQuery->have_posts()): ?>

                    <ol class="joke-list">
                        <?php $i = 0; ?>
                        <?php while ( $categoryQuery->have_posts() ) : $categoryQuery->the_post(); setup_postdata($post)?>
                            <li class="joke-list__item">
                                <?php get_template_part('partials/teasers/joke') ?>
                            </li>
                        <?php $i++ ?>
                        <?php endwhile; ?>
                    </ol>
            
                    <?php echo getPagination($categoryQuery, $paged, true, $cat)?>
                    <?php wp_reset_postdata();?>

                <?php endif; ?>

            <?php else: ?>
                <?php echo get_template_part('partials/category/empty')?>
            <?php endif ?>

            <br/><br/><br/><br/>
            <?php get_template_part('partials/menu/joke-menu') ?>
        </div>

    </div>
</div><!-- .content -->
