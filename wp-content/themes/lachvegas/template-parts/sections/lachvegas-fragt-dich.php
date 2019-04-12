<?php 

/*
$d = new stdClass();

$question1 = (object)[
  'id' => 1,
  'title' => 'Glaubst du dass der Klimawandel noch aufzuhalten ist?',
  'votes' => 41,
  'answers' => (object)[
    (object)[
      'id' => 1,
      'title' => 'ja',
      'votes' => 3
    ],
    (object)[
      'id' => 2,
      'title' => 'nein',
      'votes' => 4
    ],
    (object)[
      'id' => 3,
      'title' => 'mir egal ich nehme am Klimawandel nicht Teil',
      'votes' => 34
    ]
  ]
];

$d->entries[] = $question1;

$question = $d->entries[0];
*/

$post = get_post(2090);

?>


<?php if ( !empty($post) ) : ?>
  <section class="section section--lachvegas-asks-you">
    <div class="section__pane">
      <header class="section__header">
        <h3 class="section__title">Lachvegas fragt</h3>
        <span class="section__separator"></span>
      </header>
      <div class="section__content" style="padding: 0 40px;">
        <?php get_template_part('template-parts/common/poll'); ?>
      </div>
    </div>
  </section>
<?php endif ?>