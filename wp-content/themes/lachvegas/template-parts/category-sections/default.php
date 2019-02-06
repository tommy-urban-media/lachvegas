<?php global $data; ?>

<?php $query = $data['query']; ?>
<?php if ($query->have_posts()) : ?>

<section class="section section--posts">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title"><a href="<?= $data['url'] ?>"><?= $data['name'] ?></a></h3>
      <span class="section__separator"></span>
    </header>
    
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
            
            <?php //if ($tag = get_the_tags()): ?>
              <span class="post-meta">
                <?php $category = getChildCategory($post->ID) ?>
                <?php if (isset($category) && !empty($category) && isset($category->name)): ?>
                  <a class="post-category-link" href="<?= $category->url ?>"><?= $category->name ?></a>
                <?php endif ?>

                <?php $tag = get_the_tags(); ?>
                <?php if ($tag): ?>
                <?php $tag = $tag[0]; ?>
                  <a class="post-tag-link" href="<?= get_term_link($tag->term_id) ?>"><?= $tag->name ?></a> 
                <?php endif ?>
              </span>
            <?php //endif ?>

            <a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
              <span class="news-title"><?php the_title() ?></span>
            </a>
            <!-- <span class="post-date"><?php echo the_time(get_option('date_format'));?></span> -->
            <?php echo custom_excerpt(get_the_excerpt($post->ID), 18, false) ?>

          </div>
        </li>

      <?php $i++ ?>
      <?php endwhile; ?>

      <?php if ($i < 3) : ?>
        
        <!-- 
        <li class="list-item">
          <div class="box box--square">
            <div class="box__pane" style="padding: 20px; background-color: #e0e0e0;">
              <span class="box__title"></span>
              <div class="box__content">
                <div class="animation animation--c3">
                  <div class="animation__tab">Mit dem Zweiten sieht man besser?</div>
                  <div class="animation__tab">2</div>
                  <div class="animation__tab">
                    <span style="display: block; text-align: center; text-transform: uppercase;">Stimmt!</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        -->

        <!--
        <li class="list-item">
          <div class="infobox infobox--square">
            <div class="infobox__pane" style="padding: 20px; background-color: #e0e0e0;">
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
          </div>
        </li>
        -->
        
      <?php endif ?>

    </ol>
    
    <footer class="section__footer">
      <a href="<?= $data['url'] ?>" class="button button__section"><span><?= $data['button_text'] ?></span><i class="icon fa fa-angle-double-right"></i></a>
    </footer>

  </div>
</section>

<?php endif ?>
<?php wp_reset_query() ?>