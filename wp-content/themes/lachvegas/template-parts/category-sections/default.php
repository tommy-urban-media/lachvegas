<?php global $data; ?>

<div class="content__area">
  <section class="section section--posts">
    <header class="section__header">
      <h3 class="section__title"><a href="<?= $data['url'] ?>"><?= $data['name'] ?></a></h3>
      <span class="section__separator"></span>
    </header>
    <?php $query = $data['query']; ?>
    <?php if ($query->have_posts()) : ?>
      <ol class="list list--category">
        <?php $i = 0; ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>

          <li class="list-item">
            <div class="post-content">
              
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute('echo=0'); ?>">
                <figure class="post-image">
                  <?php if (has_post_thumbnail()):?>
                    <?php the_post_thumbnail('16_9_medium')?>
                  <?php else: ?>
                    <img src="<?= get_bloginfo('template_url')?>/app/public/lachvegas-placeholder.png" />
                  <?php endif ?>
                </figure>
              </a>
              
              <?php if ($tag = get_the_tags()): ?>
                <span class="post-meta">
                  <a href="<?= get_category_link(12) ?>"><?= getChildCategory($post->ID) ?></a>
                  <?php $tag = get_the_tags();
                    if ($tag) {
                      $tag = $tag[0]; 
                      echo $tag->name;
                    } 
                  ?>
                </span>
              <?php endif ?>
              
              <a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
                <span class="news-title"><?php the_title() ?></span>
              </a>
              <span class="post-date"><?php echo the_date('d.m.Y')?></span>
              <?php echo custom_excerpt(get_the_excerpt($post->ID), 18, false) ?>

            </div>
          </li>

        <?php $i++ ?>
        <?php endwhile; ?>

        <?php if ($i < 3) : ?>

          <li class="list-item">
            <div class="infobox">
              <p>Du wolltest schon immer wissen was die Stewardessen im Flugzeug hinter dem Vorhang treiben?</p>
              <span class="infobox__title">Mitgliedausweis Mile High Club</span>
              <div class="infobox__c">
                <ol>
                  <li><i class="fas fa-check-circle"></i>Ein Muss für jeden Dauerflieger</li>
                  <li><i class="fas fa-check-circle"></i>Für den kleinen Höhenflug zwischendurch</li>
                  <li><i class="fas fa-check-circle"></i>Für den kleinen Höhenflug zwischendurch</li>
                </ol>
              </div>
            </div>
          </li>
          
        <?php endif ?>


      </ol>
    <?php endif ?>
    
    <footer class="section__footer">
      <a href="<?= $data['url'] ?>" class="button button__section"><?= $data['button_text'] ?></a>
    </footer>

  </section>
</div>

<?php wp_reset_query() ?>