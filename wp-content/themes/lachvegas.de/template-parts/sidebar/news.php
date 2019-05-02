<?php

$today = getdate();

$newsArgs = array(
	'post_type' => 'news',
  'posts_per_page' => 30,
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
  )
);
$newsQuery = new WP_Query($newsArgs);

$posts = array();

while ($newsQuery->have_posts()) {
  $newsQuery->the_post(); 
  setup_postdata($post);
  $posts[] = $post;
}

usort($posts, 'fnn');

?>



<section class="news section-sidebar">
  <h3 class="news-headline">Schlagzeilen</h3>
  <ul class="news-list">
    <?php $i = 0; ?>
    <?php foreach ($posts as $post): ?>
      <?php if (!empty($post->post_title) && $i<5): ?>
        <li class="news-list__item">
          <?php get_template_part('template-parts/teasers/teaser-news-list') ?>
        </li>
        <?php $i++ ?>
      <?php endif ?>
    <?php endforeach ?>
    <?php wp_reset_query(); ?>
  </ul>
  <a href="<?= home_url('/') ?>news" class="button"><span>Alle News</span><i class="icon fa fa-angle-double-right"></i></a>
</section>