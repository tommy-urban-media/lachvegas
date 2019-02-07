<?php 

/*
$personQuery = new WP_Query( 
  array(
    'posts_per_page' => 10, 
    'post_type' => array('person')
  ) 
); 
*/

$terms = get_terms(
  array(
    'hide_empty' => false,
    'taxonomy' => 'people',
    'order' => 'DESC',
    'orderby' => 'count'
  )
);

?>


<?php if ( !empty($terms) ) : ?>

<section class="section section--vip">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Unsere Promis</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">

      <ol class="teasers-vip">
        <?php $i = 0; ?>
        <?php foreach ( $terms as $term ):?>
          
          <?php 

            $image = get_field('taxonomy_image', $term->taxonomy . '_' . $term->term_id);

            $imageUrl = false;
            if (isset($image['sizes'])) {
              $imageUrl = $image['sizes']['thumbnail'];
            }

          ?>

          <?php if ($imageUrl): ?>
          <?php if ($i <= 5): ?>
          <li class="list-item">
            <a href="<?= get_term_link($term->term_id) ?>">
              <span class="image-wrapper">
                <img src="<?= $imageUrl; ?>" alt="<?= $term->name ?>"/>
              </span>
              <span class="person-role"><?= get_field('taxonomy_subtitle', $term->taxonomy . '_' . $term->term_id) ?></span>
              <span class="person-name"><?= $term->name ?></span>
            </a>
          </li>
          <?php $i++?>
          <?php endif ?>
          <?php endif ?>
        <?php endforeach ?>
      </ol>
      
    </div>
  </div>
</div>

<?php endif ?>



<?php /* ?>

<?php if ( $personQuery->have_posts() ) : ?>

<section class="section section--vip">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Unsere Promis</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">

      <ol class="teasers-vip">
        <?php $i = 0; ?>
        <?php while ( $personQuery->have_posts() ) : $personQuery->the_post(); setup_postdata($post)?>
          <?php if ($i <= 5): ?>
          <li class="list-item">
            <a href="<?= get_the_permalink($post->ID) ?>">
              <span class="image-wrapper"><?php the_post_thumbnail('thumbnail') ?></span>
              <span class="person-role"><?= get_post_meta($post->ID, 'subtitle', true) ?></span>
              <span class="person-name"><?php the_title() ?></span>
            </a>
          </li>
          <?php endif ?>
          <?php $i++?>
        <?php endwhile ?>
      </ol>

      <!--
      <div class="teasers-vip__links">
        <?php $i = 0 ?>
        <?php while ( $personQuery->have_posts() ) : $personQuery->the_post(); setup_postdata($post)?>
          <?php if ($i > 1): ?>
            <a href="<?= get_the_permalink($post->ID) ?>"><span class="person-name"><?php the_title() ?></span></a>, 
          <?php endif ?>
          <?php $i++?>
        <?php endwhile ?>
      </div>
      -->
      
    </div>
  </div>
</div>

<?php endif ?>

<?php */ ?>