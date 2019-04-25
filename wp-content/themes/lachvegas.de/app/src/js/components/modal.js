import $ from 'jquery';

export default class Modal {

  constructor ( options = {} ) {
    this.node = $(options.node);
    this.init();
  }

  init() {

    this.overlay = document.querySelector('.modal-overlay');

    this.node.find('.modal__close').on('click', () => {
      this.node.removeClass('modal-show');
    });

    this.node.on('click', () => {
      
    });

  }

}
