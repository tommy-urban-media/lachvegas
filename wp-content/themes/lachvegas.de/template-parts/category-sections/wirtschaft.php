<?php 

global $data;

$postTypes = array(
  'news', 
  'post', 
  'guide', 
  'statistic'
);

$dateQuery = array(
  'before' => date('Y-m-d H:i', strtotime('+1 day'))
);

$category_name = get_category_by_slug('wirtschaft')->cat_name;

$data = [
  'name' => 'Wirtschaft',
  'url' => home_url('/wirtschaft'),
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
      'date_query' => $dateQuery,
      'category_name' => get_category_by_slug('wirtschaft')->cat_name
    )
  ),
  'query_small' => new WP_Query(
    array(
      'posts_per_page' => 5, 
      'post_type' => 'news', 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'post_settings',
          'field' => 'name',
          'terms' => array('teasable'),
          'operator' => 'NOT IN'
        ),
        array(
          'taxonomy' => 'category',
          'field' => 'name',
          'terms' => array('wirtschaft')
        )
      )
    )
  ),
  'button_text' => 'Mehr Wirtschaft'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>