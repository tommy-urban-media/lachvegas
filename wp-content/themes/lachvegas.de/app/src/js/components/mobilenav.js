import $ from 'jquery';

export default class MobileNav {

    constructor ( options = {} ) {
        this.n = options.node;
        this.node = $(options.node);

        this.init();
        console.log(this.node, 'mobile nav');
    }

    init() {
        this.initEvents();
    }

    initEvents() {

        this.n.querySelector('[data-nav-bg]').addEventListener('click', (e) => {
            e.preventDefault();
            this.close();
        });

        document.querySelector('.mobile-nav-icon').addEventListener('click', (e) => {
            e.preventDefault();
            this.open();
        });
        
    }

    open() {
        console.log('opening');
        this.n.classList.add('active');
        this.n.querySelector('[data-nav-bg]').classList.add('fade');
        this.n.querySelector('[data-nav]').classList.add('fade');
    }
    
    close() {

        setTimeout(() => {
            this.n.classList.remove('active');
        }, 250);
        
        this.n.querySelector('[data-nav-bg]').classList.remove('fade');
        this.n.querySelector('[data-nav]').classList.remove('fade');
    }

}
