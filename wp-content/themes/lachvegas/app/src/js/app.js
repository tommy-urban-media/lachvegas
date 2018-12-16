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

};

window.App = new App();
window.App.init();
