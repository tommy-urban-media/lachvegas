<?php

$today = getdate();

$newsArgs = array(
	'post_type' => 'news',
  'posts_per_page' => 5,
  'date_query' => array(
    array(
      'year' => 2020,
      'month' => $today['mon']
    ),
    array(
      'year' => 2019,
      'month' => $today['mon']
    ),
    array(
      'year' => 2018,
      'month' => $today['mon']
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

function fnn($a, $b) {
  $a_date = $a->post_date;
  $b_date = $b->post_date;

  $a_date = substr($a_date, 5);
  $b_date = substr($b_date, 5);

  return $a_date < $b_date;
}
usort($posts, 'fnn');

?>



<section class="news section-sidebar">
  <h3 class="news-headline">Schlagzeilen</h3>
  <ul class="news-list">
    <?php foreach ($posts as $post): ?>
    <li class="news-list__item">
      <?php get_template_part('template-parts/teasers/teaser-news-list') ?>
    </li>
    <?php endforeach ?>
    <?php wp_reset_query(); ?>
  </ul>
  <a href="<?= home_url('/') ?>news" class="button"><span>Alle News</span><i class="icon fa fa-angle-double-right"></i></a>
</section>