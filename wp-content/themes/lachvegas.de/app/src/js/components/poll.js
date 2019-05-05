import $ from 'jquery';

export default class Poll {

  constructor ( options = {} ) {
    this.node = $(options.node);
    this.data = this.node.data('param');
    this.url = this.node.data('url');
    this.$currentButtonTarget = null;

    console.log(this.data);

    this.init();
  }

  init() {

    this.node.find('[data-item]').on('click', (e) => {
      e.preventDefault();

      let answerID = $(e.currentTarget).find(`[name="question_${this.data.id}"]`).data('answer-id');
      console.log('id', answerID);
      if (!answerID) {
        console.warn('Antwort fehlt');
      } else {
        
        this.node.find('[data-item]').removeClass('is-selected');
        $(e.currentTarget).addClass('is-selected');

        this.save({
          poll_id: this.data.id,
          poll_answer_id: answerID //$el.data('answer-id'),
        });
      }

    });

    /*
    this.node.find('[data-button]').on('click', (e) => {
      e.preventDefault();

      let answerID = this.getAnswerID();

      if (!answerID) {
        console.warn('Antwort fehlt');
      } else {

        this.node.addClass('state-is-pending');

        this.save({
          poll_id: this.data.id,
          poll_answer_id: answerID //$el.data('answer-id'),
        });
      }

    });
    */

  }


  getAnswerID() {
    let answerID = this.node.find(`[name="question_${this.data.id}"]:checked`).val();

    if (!answerID) {
      return false;
    }
    return answerID;
  }


  save( obj ) {

    let data = Object.assign({}, { action: 'save_poll_result' }, obj);

    $.ajax({
      url: this.url,
      dataType: 'json',
      data: data,
      type: 'POST',
      success: (data) => {

        this.node.removeClass('state-is-pending');

        if (data.status) {
          this.node.find('[data-results]').show();
        }

        if (data.data) {

          setTimeout(() => {
            $('[data-results-number]').text(data.data.results_number);

            for (var i in data.data.results) {
              var res = data.data.results[i];
              var id = res.id;
              var votes_percent = Math.round(res.votes * 100 / data.data.votes, 2);
  
              $('[data-results-item="'+ id +'"]').css({width: votes_percent + '%'});
              $('[data-results-item="'+ id +'"]').text(votes_percent + '%');
            }
          }, 500);

        }
      }, 
      error: (error) => {
        this.node.removeClass('state-is-pending');
      }
    });

  } 

}
