<?php 

global $data;

$data = [
  'name' => 'Gesellschaft',
  'url' => home_url('/kategorie/gesellschaft'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        'statistic'
      ), 
      'orderby' => 'date',
      'date_query' => array(
        'relation' => 'OR',
        'before' => date('Y-m-d H:i', time())
      ),
      'category_name' => get_category_by_slug('gesellschaft')->cat_name
    )
  ),
  'button_text' => 'Mehr Gesellschaft'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>