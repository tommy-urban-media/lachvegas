<?php 

global $data;

$postTypes = array(
  //'news', 
  'post', 
  'guide'
);

$dateQuery = array(
  'before' => date('Y-m-d H:i', strtotime('+1 day'))
);

$data = [
  'name' => 'Gesellschaft',
  'url' => home_url('/gesellschaft'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => $postTypes, 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'category_name' => get_category_by_slug('gesellschaft')->cat_name
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
          'terms' => array('gesellschaft')
        )
      ),
    )
  ),
  'links' => [
    /*
    [
      'title' => 'Arbeit',
      'url' => home_url('/') . 'arbeit' 
    ],
    [
      'title' => 'Beziehung',
      'url' => home_url('/') . 'beziehung' 
    ],
    [
      'title' => 'Verkehr',
      'url' => home_url('/') . 'verkehr' 
    ],
    [
      'title' => 'Stellenmarkt',
      'url' => home_url('/') . 'stellenmarkt' 
    ]
    */
  ],
  'button_text' => 'Mehr Gesellschaft'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>