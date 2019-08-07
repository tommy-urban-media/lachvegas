<?php 

global $data;

$data = [
  'name' => 'Quiz',
  'url' => home_url('/quiz'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'quiz'
      )
    )
  ),
  'button_text' => 'Alle Quizze'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>