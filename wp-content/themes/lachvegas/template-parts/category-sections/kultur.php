<?php 

global $data;

$data = [
  'name' => 'Kultur',
  'url' => home_url('/kategorie/kultur'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'category_name' => get_category_by_slug('kultur')->cat_name
    )
  ),
  'button_text' => 'Mehr Kultur'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>