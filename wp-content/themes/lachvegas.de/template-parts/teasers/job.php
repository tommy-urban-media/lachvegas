<?php
global $post;

$company = get_post_meta($post->ID, 'job_company', true);
$date = get_the_time(get_option('date_format'));

?>

<?php if (get_the_title($post->ID)): ?>
<article class="job"> 
  <a href="<?= get_the_permalink($post->ID)?>" class="job-link" target="_blank">
    <h3 class="job-title"><?php the_title() ?></h3>
    <div class="job-content">
      <div class="job-company"><?php echo isset($company) ? $company : 'unbekannt' ?></div>
      <span class="job-date"><i class="fa fa-calendar-alt"></i><?= $date ?></span>
      <div class="job-description"><?php echo apply_filters('the_content', $post->post_content) ?></div>
    </div>
  </a>
</article>
<?php endif ?>