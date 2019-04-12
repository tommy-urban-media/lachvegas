import $ from 'jquery';

// Import all available Components
import Components from './components'; 


export default class App {


  constructor () {

    this._components = Components; 

  }


  init () {

    this.getNodes();
    this.setupTheme();
    this.setupModalTriggers();

  }


  getNodes() {

    $('[data-component]').each((i, node) => {

      let component = $(node).data('component');

      if (this._components[component] !== undefined) {

        try {
          
          new (this._components[component])({ app: this, node: node });

        } catch (e) {

          console.warn('component ' + component + ' could not be called', e);

        }

      } else {

        console.warn('component "' + component + '" does not have implementation ');

      }

    });

  }


  setupTheme () {

    $('.search-label').on('click', () => {
      $('.search-area').toggleClass('is-expanded');
    });

  }

  setupModalTriggers () {


    setTimeout(() => {

      let el = $('#modal-1');
      el.addClass('modal-show');

      el.find('[data-modal-close]').off('click').on('click', (e) => {
        e.preventDefault();
        el.removeClass('modal-show');
      });

      $('.modal-overlay').on('click', (e) => {
        e.preventDefault();
        el.removeClass('modal-show');
      });

    }, 2000);


    $('[data-modal]').each((i, el) => {
      
      let id = $(el).data('modal');
      let $modal = $('#' + id);

      $(el).on('click', (e) => {

        $modal = $('#' + $(e.currentTarget).data('modal'));
        $modal.addClass('modal-show');

        $modal.find('[data-modal-close]').off('click').on('click', (e) => {
          e.preventDefault();
          $modal.removeClass('modal-show');
        });

        $('.modal-overlay').on('click', () => {
          e.preventDefault();
          $modal.removeClass('modal-show');
        });

      });

    });

  }

};

window.App = new App();
window.App.init();
