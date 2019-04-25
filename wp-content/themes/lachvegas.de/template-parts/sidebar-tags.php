<section class="section section-tags">

  <h3 class="section-headline"><?php _e('Tags')?></h3>

  <div class="section-content">

    <?php $tags = get_tags(array('orderby' => 'count', 'order' => 'DESC'))?>

    <ul class="tag-list">
      <?php foreach($tags as $tag):?>
        <li>
          <a href="<?php echo get_tag_link( $tag->term_id )?>" title="<?php echo $tag->name?>">
            <?php echo $tag->name?> [<?php echo $tag->count?>]
          </a>
        </li>
      <?php endforeach;?>
    </ul>

  </div>

</section>
