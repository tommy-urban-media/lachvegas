<?php 

global $data;

$data = [
  'name' => 'Wissen',
  'url' => home_url('/kategorie/wissen'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'category_name' => get_category_by_slug('wissen')->cat_name
    )
  ),
  'button_text' => 'Mehr Wissen'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>