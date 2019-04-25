
<?php 

$modal = [
  [
    'id' => 1,
    'title' => 'Polizei sucht Schwanzgrapscherin',
    'subtitle' => 'Bitte um Mithilfe',
    'content' => '<p>
      In der Innenstadt ist eine Schwanzgrapscherin unterwegs und treibt dort ihr Unwesen. 
      Bereits mehrfach haben sich männliche Personen bei der Polizei beschwert nachdem die Grapschen bei ihnen vorgefasst hatte. 
      Wenn Sie etwas gesehen haben oder sogar selbst betroffen sind melden Sie sich bitte umgehend bei der Polizei.
      <br><br>
      Wir bedanken uns für Ihre Mithilfe
      </p>',
    'buttons' => [
      [
        'name' => 'Interessiert nicht'
      ]
    ]
  ],
  [
    'id' => 2,
    'title' => 'Glaubst du dass der Klimawandel noch aufzuhalten ist?',
    'subtitle' => 'Klimawandel',
    'content' => 's fsdf sdfsdahsdfs euqw sdf hdiaze27eh qdastd76 asdasd sdf sdf',
    'buttons' => [
      [
        'id' => 1,
        'name' => 'ja'
      ],
      [
        'id' => 2,
        'name' => 'nein'
      ],
      [
        'id' => 3,
        'name' => 'mir egal ich nehme am Klimawandel nicht Teil'
      ]
    ]
  ],
  [
    'id' => 3,
    'title' => 'Du glaubst du hast ein Schrumpfhirn?',
    'subtitle' => 'Frage des Tages',
    'content' => 'Kein Problem. Jetzt Wartenummer ziehen und Schrumpfhirn beim nächsten Arztbesuch entfernen lassen.',
    'buttons' => []
  ]
];


$rand = rand(0, count($modal)-1);
$item = $modal[$rand];
$item = (object)$item;

$post = get_post(2090);

?>

<div class="modal modal-effect1" id="modal-1">
  <div class="modal__stage">
    <div class="modal__header">
      <span class="icon"><i class="fa fa-question-circle"></i></span>
      <span class="subtitle"><?= $item->subtitle ?></span>
      <h3 class="title"><?= $item->title ?></h3>
    </div>
    <div class="modal__content">
      <?php get_template_part('template-parts/common/poll'); ?>
    </div>
  </div>
</div>
<div class="modal-overlay"></div>
