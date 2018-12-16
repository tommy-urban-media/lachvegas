<?php 

global $data;

$data = [
  'name' => 'Wirtschaft',
  'url' => home_url('/kategorie/wirtschaft'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'category_name' => get_category_by_slug('wirtschaft')->cat_name
    )
  ),
  'button_text' => 'Mehr Wirtschaft'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>