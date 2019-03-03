<?php

$today = getdate();

$jobsArgs = array(
	'post_type' => 'job',
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
$jobsQuery = new WP_Query($jobsArgs);

$posts = array();

while ($jobsQuery->have_posts()) {
  $jobsQuery->the_post(); 
  setup_postdata($post);
  $posts[] = $post;
}

function fn($a, $b) {
  $a_date = $a->post_date;
  $b_date = $b->post_date;

  $a_date = substr($a_date, 5);
  $b_date = substr($b_date, 5);

  return $a_date < $b_date;
}
usort($posts, 'fn');

?>



<div class="jobs">
  <h3 class="jobs-headline"><span style="font-weight: 300;">LV</span> Stellenmarkt</h3>
  <p class="jobs-description">Aktuelle Stellenangebote für Verrückte, Bekloppte und die die es noch werden wollen</p>
  <ul class="jobs-listing">

    <?php foreach ($posts as $post): ?>
    <li class="list-item">
      <?php get_template_part('template-parts/teasers/job') ?>
    </li>
    <?php endforeach ?>
    <?php wp_reset_query(); ?>

    <!-- 
    <div class="job"> 
      <a href="#" class="job-link" target="_blank">
        <h3 class="job-title">Gebetsbuchverteiler (m)</h3>
        <div class="job-content">
          <div class="job-description">Bei den Salafisten zum Verteilen des Koran auf dem Gehweg</div>
        </div>
      </a>
    </div>

    <div class="job"> 
      <a href="#" class="job-link" target="_blank">
        <h3 class="job-title">Ausrüstungstechniker/-in Schwerpunkt Spannerausrüstung und Fernaufklärung</h3>
        <div class="job-content">
          <div class="job-company">farfield GmbH</div>
          <div class="job-description"></div>
        </div>
      </a>
    </div>
    -->

  </ul>
  <a href="<?= home_url('/') ?>stellenmarkt" class="button">Alle Job-Angebote</a>
</div>