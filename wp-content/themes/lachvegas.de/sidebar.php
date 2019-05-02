<?php
/**
 * Render the Sidebar on the right side
 *
 */

get_template_part('template-parts/sidebar/news');
//get_template_part('template-parts/sidebar/question-of-the-day');

get_template_part('template-parts/sidebar/newest-saying');

$rand = rand(0,1);

if ($rand) {
  
  get_template_part('template-parts/common/jobs');
  //showAD('portrait');

} else {

  //showAD('portrait');
  get_template_part('template-parts/common/jobs');
  
}

?>



<?php //echo get_template_part('template-parts/sidebar', 'tags'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'about'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'quotes'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'ad'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'featured-post'); ?>
<?php // echo get_template_part('template-parts/sidebar', 'external-website'); ?>


