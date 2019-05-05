<?php 

$d = new stdClass();

$pollDataJson = get_post_meta($post->ID, 'poll_data', true); 
$pollData = json_decode($pollDataJson);

$question = (object)[
  'id' => $post->ID,
  'title' => get_the_title($post->ID),
  'votes' => get_post_meta($post->ID, 'poll_votes', true),
  'answers' => $pollData
];

/*
{"0":{"id":1,"title":"ja","votes":0},"1":{"id":2,"title":"nein","votes":0},"2":{"id":3,"title":"mir egal ich nehme am Klimawandel nicht Teil","votes":0},"3":{"id":4,"title":"Der Klimawandel ist eine Erfindung der Chinesen hat ein schlauer Mensch einmal gesagt. Die Chinesen kann man nicht aufhalten also Nein","votes":0}}
*/
        
?>

<div class="poll" data-component="Poll" data-url="<?php echo admin_url('admin-ajax.php') ?>" data-param='<?= json_encode($question) ?>'>
  <div class="poll__bg"></div>
  <div class="poll__stage">
    <h3 class="poll__title"><?= $question->title ?> </h3>
    <div class="poll__answers">
      <?php foreach ($question->answers as $answer): ?>
        <div class="poll__answers__item" data-item>
          <!-- <button class="button" data-button data-answer-id="<?= $answer->id ?>"><?= $answer->title ?></button> -->
          <div class="input-wrapper type-radio">
            <input type="radio" id="<?= $question->id?>_answer_<?= $answer->id?>" name="question_<?= $question->id?>" data-answer-id="<?= $answer->id ?>" value="<?= $answer->id ?>"/>
            <label for="<?= $question->id?>_answer_<?= $answer->id?>"><?= $answer->title ?></label>
          </div>
        </div>
      <?php endforeach ?>
    </div>

    <!-- <button class="button" data-button>Speichern</button> -->

    <div class="poll__results__wrapper" data-results>
      <div class="poll__results__title">
        <span class="poll__results__number" data-results-number>0%</span> aller Teilnehmer haben diese Frage genauso beantwortet (Teilnehmer gesamt: <?= $question->votes ?>)
      </div>

      <div class="poll__results" data-results>
        <!-- <div class="poll__results__text">Ergebnis: </div> -->
        <div class="poll__results__list">
          <?php foreach ($question->answers as $answer): ?>
            <?php 
              if (!$answer->votes) {
                $answer->votes = 0;
              } 
              if ($question->votes) {
                $percent = round($answer->votes * 100 / $question->votes, 2);
              } else {
                $percent = 0;
              }
            ?>

            <div class="poll__results__list__item">
              <span class="poll__results__list__title"><?= $answer->title ?></span>
              <span class="poll__results__list__bar" data-results-item="<?= $answer->id ?>" style="width: <?= $percent ?>%;"><?= $percent ?>%</span>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>