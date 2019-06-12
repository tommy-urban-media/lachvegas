<?php

$today = getdate();

$jobsArgs = array(
	'post_type' => 'job',
  'posts_per_page' => 3,
  'date_query' => array(
    array(
      'year' => 2020,
      'month' => $today['mon']
    ),
    array(
      'year' => 2020,
      'month' => $today['mon']-1
    ),
    array(
      'year' => 2019,
      'month' => $today['mon']
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
      'month' => $today['mon']-1
    ),
    'relation' => 'OR'
  )
);
$jobsQuery = new WP_Query($jobsArgs);

$posts = array();

while ($jobsQuery->have_posts()) {
  $jobsQuery->the_post(); 
  setup_postdata($post);
  $posts[] = $post;
}

?>



<div class="dating-box">
  <h3 class="dating-box__headline"><span style="font-weight: 300;">LV</span> Partnerbörse</h3>
  <p class="dating-description">Jetzt Bekanntschaften machen. Nur für Verrückte, Bekloppte und Alle die es noch werden wollen</p>
  <ul class="dating-listing">
    <?php foreach ($posts as $post): ?>
    <li class="list-item">
      <?php get_template_part('template-parts/teasers/job') ?>
    </li>
    <?php endforeach ?>
    <?php wp_reset_query(); ?>
  </ul>

  <p>Jetzt Neu: WauWau sucht WauWauFrau</p>
  <a href="<?= home_url('/') ?>partnerboerse" class="button"><span>Zur Partnerbörse</span><i class="icon fa fa-angle-double-right"></i></a>
</div>