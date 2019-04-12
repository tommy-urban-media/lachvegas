<?php 

global $data;

$data = [
  'name' => 'Quizze',
  'url' => home_url('/kategorie/quizze'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 10, 
      'post_type' => array(
        'quiz'
      )
    )
  ),
  'button_text' => 'Alle Quizze'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>