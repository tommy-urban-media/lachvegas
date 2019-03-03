<?php 
  $query = new WP_Query(array(
    'posts_per_page' => 1, 
    'date_query' => array(
      array(
        'day' => date('d'),
        'month' => date('m')
      )
    ),
    'category_name' => get_category_by_slug('feiertage')->cat_name
  )); 	
?>
<?php if ( $query->have_posts() ) : ?>
<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>

<section class="section section--special-day">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Heute ist ...</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">

      <article class="holiday">
        <div class="holiday-grid">
          <div class="holiday-grid-item">
            <figure class="image-wrapper holiday-image">
              <img src="<?= get_bloginfo('template_url')?>/app/images/feiertage/reichtum-armut.jpg" alt="Armut und Reichtum" />
            </figure>
          </div>
          <div class="holiday-grid-item">
            <div class="holiday-content">
              <span class="holiday-date">20.02.2019</span>
              <span class="holiday-subtitle">UNO World Day of Social Justice</span>
              <h3 class="holiday-title">Welttag der Sozialen Gerechtigkeit</h3>
              <div class="holiday-content-text">
                <p>Wie sozial und gerecht es in der Welt zugeht sehen wir jeden Tag in den Nachrichten. Weltweit hat sich da in den letzten Jahren sehr viel getan. Ein Grund zum Feiern.</p>
                <p>Themen:</p>
                <p><a href="#">Gerechtigkeit</a></p>
              </div>
            </div>
          </div>
        </div>
      </article>



      <article class="holiday">
        <div class="holiday-grid">
          <div class="holiday-grid-item">
            <figure class="image-wrapper holiday-image">
              <img src="<?= get_bloginfo('template_url')?>/app/images/feiertage/internationaler-frauentag.jpg" alt="Internationaler Frauentag" />
            </figure>
          </div>
          <div class="holiday-grid-item">
            <div class="holiday-content">
              <span class="holiday-date">08.03.2019</span>
              <span class="holiday-subtitle">Tag zu Ehren der Frau</span>
              <h3 class="holiday-title">Internationaler Frauentag</h3>
              <div class="holiday-content-text">
                <p>Dieser Tag steht ganz im <strong>Zeichen der Frau</strong>.</p>
                <p>Männer sind heute den ganzen Tag dazu verpflichtet mit der Liebsten stundenlang shoppen zu gehen und dabei zu LÄCHELN!</p>
                <p>Und Nein liebe Herren: Nach der Shopping-Tour gehen wir nicht zum Dönerladen oder zu McDoof sondern wir gehen ins Veggie-Restaurant!</p>
                <br>
                <p>Themen:</p>
                <p><a href="#">Frauen</a><a href="#">Liebe</a><a href="#">Sex</a></p>

              </div>
            </div>
          </div>
        </div>

        <div class="holiday-grid">
          <div class="holiday-grid-item">
            <div class="quote">Frauen sind gefährlicher als das FBI. Sie kriegen alles raus.</div>
          </div>
          <div class="holiday-grid-item">
            <div class="quote">Eine Mutter braucht 9 Monate um ein Baby zu Welt zu bringen. Eine Ehefrau braucht 9 Minuten um aus ihrem Mann einen Narren zu machen</div>
          </div>
          <!--
          <div class="holiday-grid-item">
            <div class="quote">Frauen schlafen Nachts nie. Sie planen wie sie sich am nächsten Tag an ihrem Mann rächen können</div>
          </div>
          <div class="holiday-grid-item">
            <div class="quote">Frauen würden niemals auf die Idee kommen zu lügen. Sie erzählen nur nicht die Wahrheit</div>
          </div>
          -->
          <div class="holiday-grid-item">
            <div class="quote">Männer tun was sie tun müssen und Frauen sagen ihnen was das ist.</div>
          </div>
        </div>

        <div class="holiday-grid">
          <div class="holiday-grid-item holiday-grid-item--center">
            <a class="button" href="<?= home_url('/') ?>frauen">mehr erfahren</a>
          </div>
        </div>

      </article>


    </div>
  </div>
</section>

<?php endwhile ?>
<?php endif ?>
