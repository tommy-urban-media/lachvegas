import $ from 'jquery';

export default class PostVote {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.postID = this.node.data('post-id');
        this.url = this.node.data('url');

        console.log(this.data);

        this.init();
    }

    init() {

        this.node.find('[data-vote-up]').on('click', (e) => {
            e.preventDefault();
            this.save({
                post_id: this.postID,
                vote_up: 1
            });
        });

        this.node.find('[data-vote-down]').on('click', (e) => {
            e.preventDefault();
            this.save({
                post_id: this.postID,
                vote_down: 1
            });
        });

    }


    save( obj ) {

        let data = Object.assign({}, { action: 'post_vote' }, obj);

        $.ajax({
            url: this.url,
            dataType: 'json',
            data: data,
            type: 'POST',
            success: (data) => {
                console.log(data);
            }, 
            error: (error) => {
                console.log(error);
                this.node.removeClass('state-is-pending');
            }
        });

    } 

}
