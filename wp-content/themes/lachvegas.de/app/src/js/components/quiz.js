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
            right: ["Richtig!", "Genau!", "Richtige Antwort"],
            wrong: ["Falsch!", "Leider falsch."]
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
      
            let selectedAnswerID = $(e.currentTarget).find(`[type=radio]`).data('answer-id');
            
            if (!selectedAnswerID) {
                console.warn('Antwort fehlt');
            } else {
        
                let $parent = $(e.currentTarget).closest('[data-quiz-question]')
                let questionID = $parent.data('question-id');

                if (this.user.answers.filter((answer) => { return answer.question_id === questionID }).length) {
                    console.warn('answer already given');
                } else {

                    this.node.find('[data-item]').removeClass('is-selected');
                    $(e.currentTarget).addClass('is-selected');


                    let correctAnswerID = this.getCorrectAnswerID(questionID, selectedAnswerID);

                    this.user.answers.push({
                        question_id: questionID,
                        answer_id: selectedAnswerID,
                        correct_answer_id: correctAnswerID
                    });

                    let text;
                    if (selectedAnswerID === correctAnswerID) {
                        $(e.currentTarget).addClass('is-correct');
                        text = this.answerTexts.right[0];
                    } else {
                        $(e.currentTarget).addClass('is-wrong');
                        text = this.answerTexts.wrong[0];

                        // mark the correct answer as green
                        console.log(`[data-answer-id="id-${correctAnswerID}"]`);
                        $(`[data-answer-id="id-${correctAnswerID}"]`).addClass('is-correct');
                    }
                    $parent.find('[data-answer-is-correct]').html(text);
    
                    // show the result of the current given answer
                    $parent.find('[data-answer-text]').show();
                }

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

        this.node.find('[data-button-next]').on('click', (e) => {
            this._current_quiz_question++;
            this.showCurrentQuestion();
        });

        this.node.find('[data-button-summary]').on('click', (e) => {
            this.showSummary();
        });

    }


    showCurrentQuestion() {
        $('[data-quiz-start]').hide();
        $('[data-quiz-number]').show();

        $('[data-num-current]').html(`${this._current_quiz_question}`);
        
        $(`[data-quiz-question]`).hide();
        $(`[data-quiz-question]:nth-child(${this._current_quiz_question}`).show();
    }


    getCorrectAnswerID(questionID) {
        let correctAnswerFound = false;
        this.data.questions.forEach((question) => {
            if (questionID === question.id) {
                let correctAnswers = question.answer_correct;

                correctAnswers.forEach(answer => {
                    correctAnswerFound = answer.id;
                });
            }
        });

        return correctAnswerFound;
    }


    save( obj ) {

        let data = Object.assign({}, { action: 'add_quiz_result' }, obj);

        console.log('saving quiz data', data);

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
                    //this.deactivateQuestion();
                    this.checkSummary();
                }
            }
        });

  } 


    showSummary() {
        console.log('show results');

        $('[data-summary-text]').html(this.getSummaryText({
            correct_answers: this.user.answers.filter(answer => { return answer.answer_id === answer.correct_answer_id }).length,
            questions: this.data.questions.length 
        }));

        $('[data-summary]').show();
    }

    getSummaryText(obj = {}) {
        return `Du hast ${obj.correct_answers} von ${obj.questions} richtig beantwortet.`;
    }

}
