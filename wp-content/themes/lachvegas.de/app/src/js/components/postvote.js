import $ from 'jquery';

export default class PostVote {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.postID = this.node.data('post-id');
        this.url = this.node.data('url');
        this.param = this.node.data('param');

        console.log(this.data);
        console.log(this.param);

        this.vote_clicked = false;

        this.init();
    }

    init() {

        // add votes bar
        this.updateVotesBar();

        this.node.find('[data-vote-up]').on('click', (e) => {
            e.preventDefault();
            this.save({
                post_id: this.postID,
                vote_up: 1
            });

            this.vote_clicked = true;
        });

        this.node.find('[data-vote-down]').on('click', (e) => {
            e.preventDefault();
            this.save({
                post_id: this.postID,
                vote_down: 1
            });

            this.vote_clicked = true;
        });

    }


    updateVotesBar() {

        let up = parseInt(this.param.up)
        let down = parseInt(this.param.down);
        let percent = 50;

        if (up !== down) {
            let sum = up + down;
            percent = up / sum * 100;
        }

        let $vbar = this.node.find('[data-votes-bar]');
        let $voteBar = $vbar.find('.votes-bar');

        if ($voteBar.length) {
            $voteBar.css('width', percent + '%');
        } else {
            let $bar = $('<span class="votes-bar"></span>');
            $bar.css('width', percent + '%');
            this.node.find('[data-votes-bar]').append($bar);
        }
    
    }


    save( obj ) {

        if (this.vote_clicked) {
            return;
        }

        let data = Object.assign({}, { action: 'post_vote' }, obj);

        $.ajax({
            url: this.url,
            dataType: 'json',
            data: data,
            type: 'POST',
            success: (data) => {
                console.log(data);

                if (obj.hasOwnProperty('vote_down')) {
                    $('[data-votes-down]').text(data.votes);
                    this.param.down = data.votes;
                }
                if (obj.hasOwnProperty('vote_up')) {
                    $('[data-votes-up]').text(data.votes);
                    this.param.up = data.votes;
                }

                this.updateVotesBar();

            }, 
            error: (error) => {
                console.log(error);
                this.node.removeClass('state-is-pending');
            }
        });

    } 

}
