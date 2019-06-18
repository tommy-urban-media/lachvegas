<?php 

global $data;

$dateQuery = array(
  'before' => date('Y-m-d H:i', strtotime('+1 day'))
);

// TODO change to stdclass
$data = [
  'name' => 'Beziehung & Partnerschaft',
  'url' => home_url('/beziehung-partnerschaft'),
  'query' => new WP_Query(
    array(
      'posts_per_page' => 3, 
      'post_type' => array(
        'news', 
        'post', 
        'guide', 
        //'statistic'
      ), 
      'orderby' => 'date',
      'date_query' => $dateQuery,
      'category_name' => get_category_by_slug('beziehung-partnerschaft')->cat_name
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
          'terms' => array('beziehung-partnerschaft')
        )
      )
    )
  ),
  'links' => [
    [
      'title' => 'Liebe',
      'url' => home_url('/') . 'themen/liebe' 
    ],
    [
      'title' => 'Sex',
      'url' => home_url('/') . 'themen/sex' 
    ],
    [
      'title' => 'Sexismus',
      'url' => home_url('/') . 'themen/sexismus' 
    ]
  ],
  'button_text' => 'Mehr Beziehung & Partnerschaft'
];

?>

<?php get_template_part('template-parts/category-sections/default') ?>