<ul class="news-archive">
  <?php wp_get_archives(array('type' => 'monthly', 'post_type' => 'news' /*, 'show_post_count' => 1*/ )) ?>
  <?php //$arch = wp_get_archives(array('type' => 'monthly', 'post_type' => 'news', 'echo' => false)) ?>
  <?php //var_dump($arch) ?>
  <?php // wp_get_archives(array('type' => 'daily', 'post_type' => 'news')) ?>
  <!-- <a href="<?php echo get_post_type_archive_link( 'news' ); ?>">News Archive</a> -->
</ul>
