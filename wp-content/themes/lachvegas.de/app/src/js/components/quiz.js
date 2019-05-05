import $ from 'jquery';

export default class Quiz {

  constructor ( options = {} ) {
    this.node = $(options.node);
    this.data = this.node.data('param');
    this.url = this.node.data('url');
    this.$currentButtonTarget = null;

    console.log(this.data);

    // the active running quiz question the user sees
    this._current_quiz_question = 1;

    this.user = {
      answers: []
    };

    this.answerTexts = {
      right: ["Richtig! ", "Genau! ", "Richtige Antwort. "],
      wrong: ["Falsch! "]
    }

    this.init();
  }

  init() {

    // activate the start button to start the quiz
    this.node.find('[data-button-start]').on('click', (e) => {
      e.preventDefault();
      this.showCurrentQuestion();
    });


    this.node.find('[data-item]').on('click', (e) => {
      e.preventDefault();
      
      let answerID = $(e.currentTarget).find(`[type=radio]`).data('answer-id');
      console.log('id', answerID);
      if (!answerID) {
        console.warn('Antwort fehlt');
      } else {
        
        this.node.find('[data-item]').removeClass('is-selected');
        $(e.currentTarget).addClass('is-selected');

        let $parent = $(e.currentTarget).closest('[data-quiz-question]')

        let questionID = $parent.data('question-id');

        this.user.answers.push({
          question_id: questionID,
          answer_id: answerID
        });

        $parent.find('[data-answer-text]').show();

        // show the next question
        //this._current_quiz_question++;
        //this.showCurrentQuestion();

        this.showQuestionResult();
      }

      console.log(this.user);

      /*
      this.save({
        quiz_id: this.data.id,
        question_id: $el.closest('[data-question-id]').data('question-id'),
        question_result: $el.closest('[data-question-result]').data('question-result'),
        answer_id: $el.data('answer-id'),
        answer_value: value
      });
      */
    });

  }


  showCurrentQuestion() {
    $('[data-quiz-start]').hide();
    $('[data-quiz-number]').show();

    $('[data-num-current]').html(`${this._current_quiz_question}`);
    
    $(`[data-quiz-question]`).hide();
    $(`[data-quiz-question]:nth-child(${this._current_quiz_question}`).show();
  }


  showQuestionResult(questionID) {

  }


  save( obj ) {

    let data = Object.assign({}, { action: 'add_quiz_result' }, obj);

    $.ajax({
      url: this.url,
      dataType: 'json',
      data: data,
      type: 'POST',
      success: (data) => {

        if (data.status) {

          let resultEl = this.$currentButtonTarget.closest('[data-question-id]').find('[data-answer-text]').show();

          if (data.answer_correct) {
            resultEl.find('[data-answer-pretext]').addClass('state-is-true').html('<i class="fa fa-check-circle"></i>');
            resultEl.find('[data-answer-right-wrong]').html(this.answerTexts.right[0]);
          }
          else {
            resultEl.find('[data-answer-pretext]').addClass('state-is-false').html('<i class="fa fa-times-circle"></i>');
            resultEl.find('[data-answer-right-wrong]').html(this.answerTexts.wrong[0]);
          }

          this.user.answers.push({
            question_id: obj.question_id,
            answer_correct: data.answer_correct
          });

          resultEl.css('display', 'flex');
          this.deactivateQuestion();
          this.checkSummary();
        }
      }
    });

  } 

  deactivateQuestion(selector) {
    $(selector).find('[data-button]').attr('disabled', 'disabled');
  }

  checkSummary() {
    if (this.user.answers.length === this.data.questions.length) {
      console.log('show results');

      $('[data-summary-text]').html(this.getSummaryText({
        correct_answers: this.user.answers.filter(answer => { return answer.answer_correct === true }).length,
        questions: this.data.questions.length 
      }));

    } else {
      console.log('dont show results yet');
    }
  }

  getSummaryText(obj = {}) {
    return `Du hast ${obj.correct_answers} von ${obj.questions} richtig beantwortet.`;
  }

}
