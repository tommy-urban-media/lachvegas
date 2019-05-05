<?php


global $post;
$relations = get_field('quiz_questions');
//var_dump($relations);	

$quiz = new stdClass();
$quiz->id = $post->ID;
$quiz->title = get_the_title($post->ID);
$quiz->questions = [];

foreach ($relations as $question) {
    //var_dump($question->ID);
    //echo apply_filters('the_content', $question->post_content);
    $answers = get_field('quiz_answers', $question->ID);
    $result_text = get_field('quiz_answer_result_text', $question->ID);

    $q = new stdClass();
    $q->id = $question->ID;
    $q->text = $question->post_content;
    $q->answer_text = $result_text;
    $q->answers = [];
    
    foreach ($answers as $answer) {
        //echo apply_filters('the_content', $answer->post_content);

        $a = new stdClass();
        $a->id = $answer->ID;
        $a->label = $answer->post_content;
        $a->value = $answer->post_content;

        $q->answers[] = $a;
    }

    $quiz->questions[] = $q;
    
}

?>


<?php

// var_dump($quiz);

/*
global $quiz_data;
$id = get_post_meta($post->ID, 'quiz_id', true);
$option_name = 'quiz_' . $id;
$quiz = '';
$quiz_results = null;

if ($id) {
	//$quiz = get_option($option_name);
	get_template_part('data/quiz/' . $id);

	if ($quiz_data) {

		$quiz_results = get_option($option_name);
		$quiz = $quiz_data;
		$quiz['results'] = $quiz_results;
		
	} else {
		echo 'No Quiz available!';
	}

} 
*/
?>

<?php if ( !$quiz ): ?>
    <h3>No Quiz Data given</h3>
<?php endif ?>

<div class="quiz" data-component="Quiz" data-param='<?= json_encode($quiz) ?>' data-url="<?php echo admin_url('admin-ajax.php') ?>">
    <div class="quiz__bg"></div>

    <div class="quiz__start" data-quiz-start>
        <span class="quiz__subtitle"><?= count($quiz->questions) ?> Fragen</span>
        <h3 class="quiz__title"><?= $quiz->title ?></h3>
        <button class="quiz__button-start" data-button-start>Jetzt Starten</button>
    </div>

    <div class="quiz__stage">        
        <div class="quiz__number" data-quiz-number>
            Frage <span class="quiz__current" data-num-current>1</span>
            von <span class="quiz__total" data-num-total><?= count($quiz->questions) ?></span>
        </div>

        <div class="quiz__questions" data-quiz-questions>
            <?php foreach($quiz->questions as $index => $q): ?>
                <div class="quiz__question" data-quiz-question data-question-id="<?= $q->id ?>" data-question-result="<?= $q->result ?>">
                
                    <?php if (isset($q->text)):?>
                        <div class="quiz__question-content"><?= $q->text ?></div>
                    <?php endif ?>

                    <div class="quiz__question-answers">
                        <?php foreach($q->answers as $answer): ?>
                        <div class="quiz__question-answer" data-item>
                            <div class="input-wrapper type-radio">
                                <input type="radio" id="<?= $q->id?>_answer_<?= $answer->id?>" name="question_<?= $q->id?>" data-answer-id="<?= $answer->id ?>" value="<?= $answer->id ?>"/>
                                <label for="<?= $q->id?>_answer_<?= $answer->id?>"><?= $answer->value ?></label>
                            </div>
                        </div>
                            
                        <!-- <button class="quiz__button quiz__button--<?= $answer->value ?>" data-button data-value="<?= $answer->value ?>" data-answer-id="<?= $answer->id ?>"><?= $answer->label ?></button>-->
                        <?php endforeach ?>
                    </div>

                    <div class="quiz__answer-text" data-answer-text>
                        <span data-answer-right-wrong></span>
                        <?= $q->answer_text ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="quiz__summary" data-summary>
        <h3>Auswertung</h3>
        <div data-summary-text>... <em>Bitte beantworte alle Fragen um die Auswertung zu sehen.</em></div>
    </div>

</div>