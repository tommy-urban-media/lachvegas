<?php 

global $data;

$dateQuery = array(
  'before' => date('Y-m-d H:i', strtotime('+1 day'))
);

// TODO change to stdclass
$data = [
  'name' => 'Wissen',
  'url' => home_url('/wissen'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        //'news', 
        'post', 
        'guide'
      ), 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'category_name' => get_category_by_slug('wissen')->cat_name
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
          'terms' => array('wissen')
        )
      )
    )
  ),
  'button_text' => 'Mehr Wissen'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>