<?php 

$cookies = new stdClass();

$cookies->entries = [
  [
    'id' => 1,
    'date' => null,
    'text' => 'Ein CGI-Script hat die Berechtigung chmod 737-Max. Prüfen Sie ob alle Require-Regeln des Perl Moduls fehlerfrei konfiguriert sind'
  ],
  [
    'id' => 2,
    'date' => null,
    'text' => '404 Nicht gefunden'
  ],
  [
    'id' => 3,
    'date' => null,
    'text' => 'Es ist ein kritischer Fehler aufgetreten der nicht rechtzeitig behoben werden konnte weil die Entwickler damit beschäftigt waren ein Zombie-Spiel durch zu spielen'
  ],
  [
    'id' => 4,
    'date' => null,
    'text' => 'sudo apt-get install fortune-cookie -g'
  ]
];

$rand = rand(0, count($cookies->entries)-1);
$cookie = $cookies->entries[$rand];

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
              <span><?= $cookie['text'] ?></span>
            </div>
          <?php endif ?>
          
        </div>
      </div>
    
    </div>
    
    <footer class="section__footer">

      <?php 
        $mailto = 'mailto:?';
        $mailto .= 'subject=Lachvegas.de Glückskeks des Tages';
        $mailto .= '&body=Dein Glückskeks des Tages: ' . urlencode( home_url('/') . '#section-fortune-cookie');
      ?>

      <a href="<?= $mailto ?>">Glückskeks an einen Freund senden</a>
    </footer>

  </div>
</section>