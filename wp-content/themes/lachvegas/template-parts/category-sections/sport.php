<?php 

global $data;

$data = [
  'name' => 'Sport',
  'url' => home_url('/kategorie/sport'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 6, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'category_name' => get_category_by_slug('sport')->cat_name
    )
  ),
  'button_text' => 'Mehr Sport'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>