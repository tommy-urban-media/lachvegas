<?php 

global $data;

$data = [
  'name' => 'Politik',
  'url' => home_url('/kategorie/politik'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'category_name' => get_category_by_slug('politik')->cat_name
    )
  ),
  'button_text' => 'Mehr Politik'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>