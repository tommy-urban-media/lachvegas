<?php 

$fortuneCookiesArgs = array(
	'post_type' => 'fortune_cookie',
  'posts_per_page' => 1,
  'orderby' => 'rand'
);
$fortuneCookiesQuery = new WP_Query($fortuneCookiesArgs);

$p = null;
while ($fortuneCookiesQuery->have_posts()) {
  $fortuneCookiesQuery->the_post(); 
  setup_postdata($post);
  $p = $post;
}

?>


<section class="section section--topics" id="section-fortune-cookie">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Mein Glückskeks des Tages</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">

      <div class="fortune-cookie" data-component="FortuneCookie">
        <div class="fortune-cookie__badge">
          
          <?php if (isset($_COOKIE['lv_fortune_cookie'])): ?>
            <div class="fortune-cookie__info">Du hast heute schon einen Glückskeks geöffnet. Schau morgen wieder vorbei</div>
          <?php else: ?>
            <div class="fortune-cookie__button" data-button>Glückskeks öffnen</div>
            <div class="fortune-cookie__ribbon" data-ribbon>
              <span><?php echo apply_filters( 'the_content', $p->post_content ) ?></span>
            </div>
          <?php endif ?>
          
        </div>
      </div>
    
    </div>
    
    <footer class="section__footer" style="justify-content: center">

      <?php 
        $mailto = 'mailto:?';
        $mailto .= 'subject=Lachvegas.de Glückskeks des Tages';
        $mailto .= '&body=Dein Glückskeks des Tages: ' . urlencode( home_url('/') . '#section-fortune-cookie');
      ?>

      <a href="<?= $mailto ?>">Glückskeks an einen Freund senden</a>
    </footer>

  </div>
</section>