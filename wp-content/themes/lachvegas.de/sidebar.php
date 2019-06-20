<?php
/**
 * Render the Sidebar on the right side
 *
 */

get_template_part('template-parts/sidebar/news');
// get_template_part('template-parts/sidebar/question-of-the-day');

get_template_part('template-parts/sidebar/newest-saying');

$rand = rand(0,1);

if ($rand) {
  
  get_template_part('template-parts/common/jobs');
  //showAD('portrait');

} else {

  //showAD('portrait');
  get_template_part('template-parts/common/jobs');
  
}

// get_template_part('template-parts/common/partnerboerse');
get_template_part('template-parts/sidebar/most_voted_articles');
get_template_part('template-parts/sidebar/most_viewed_articles');
get_template_part('template-parts/sidebar/random_article');

?>

<?php // echo get_template_part('template-parts/sidebar', 'about'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'quotes'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'featured-post'); ?>


