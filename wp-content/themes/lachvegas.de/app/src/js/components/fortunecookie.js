import $ from 'jquery';

export default class FortuneCookie {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.data = this.node.data('param');
        this.url = this.node.data('url');

        console.log(this.data);

        this.init();
    }

    init() {

        this.node.find('[data-button]').on('click', (e) => {
            e.preventDefault();
            $(e.currentTarget).hide();
            this.node.find('[data-ribbon]').show();
            this.setCookie('lv_fortune_cookie', 1, 1);
        });

    }

    getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    setCookie(cname, cvalue, exdays) {
        var d = new Date();
        //d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        // set cookie to 24 hours the next day midnight
        d.setHours(24, 0, 0, 0);
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
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
