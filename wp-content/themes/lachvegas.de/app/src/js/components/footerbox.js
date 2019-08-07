import $ from 'jquery';

export default class FooterBox {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.init();
    }

    init() {

        this.node.find('[data-close-btn]').on('click', (e) => {
            e.preventDefault();
            this.close();
        });

    }


    close() {

        this.node.addClass('closed');
    
    }

}
