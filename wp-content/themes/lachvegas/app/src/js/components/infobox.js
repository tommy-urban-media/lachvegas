import $ from 'jquery';

export default class InfoBox {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.$currentButtonTarget = null;

        console.log(this.data);

        this.boxes = [
            ''
        ]

        this.init();
    }

    init() {

        this.collectBoxes();

    }


    collectBoxes() {

        console.log('collecting boxes ...');

    }

}
