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

$data = [
  'name' => 'Politik',
  'url' => home_url('/politik'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => $postTypes, 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'category_name' => get_category_by_slug('politik')->cat_name
    )
  ),
  'query_small' => new WP_Query(
    array(
      'posts_per_page' => 5, 
      'post_type' => 'news', 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'tax_query' => array(
        'relation' => 'NOT__IN',
        array(
          'taxonomy' => 'post_settings',
          'field' => 'name',
          'terms' => array('teasable')
        )
      ),
      'category_name' => get_category_by_slug('politik')->cat_name
    )
  ),
  'button_text' => 'Mehr Politik'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>