import $ from 'jquery';

export default class Menu {

  constructor ( options = {} ) {
    this.node = $(options.node);
    this.init();
  }

  init() {

    this.node.find('.menu-icon').on('click', (e) => {
      e.preventDefault();
      this.node.find('.menu').slideToggle('fast');
    });

  }

}
