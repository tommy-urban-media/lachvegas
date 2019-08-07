<?php if ( is_home() || is_front_page() || is_category() ): ?>

    <?php 


        $today = getdate();

        $tickerQuery = new WP_Query(
            array(
                'posts_per_page' => 10,
                'post_type' => 'news',
                'date_query' => array(
                    array(
                      'year' => 2020,
                      'month' => $today['mon'],
                      'day' => $today['mday']
                    ),
                    array(
                      'year' => 2020,
                      'month' => $today['mon']-1,
                    ),
                    array(
                      'year' => 2019,
                      'month' => $today['mon'],
                      'day' => $today['mday']
                    ),
                    array(
                      'year' => 2019,
                      'month' => $today['mon'],
                      'day' => ($today['mday'] > 1) ? $today['mday']-1 : 1
                    ),
                    array(
                      'year' => 2019,
                      'month' => $today['mon']-1
                    ),
                    array(
                      'year' => 2018,
                      'month' => $today['mon']
                    ),
                    array(
                      'year' => 2018,
                      'month' => $today['mon'],
                      'day' => ($today['mday'] > 1) ? $today['mday']-1 : 1
                    ),
                    array(
                      'year' => 2018,
                      'month' => $today['mon']-1
                    ),
                    'relation' => 'OR'
                  ),
                //'category_name' => 'gesellschaft'
            )
        );
    ?>

    <?php if ( $tickerQuery->have_posts() ): ?>
        <div class="ticker">
            
            <div class="ticker__header">
                <span class="ticker__title">News</span>
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
        </div>
    <?php endif ?>

<?php endif ?>