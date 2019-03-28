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
          <?php get_template_part('template-parts/teasers/teaser-category-article-list') ?>
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