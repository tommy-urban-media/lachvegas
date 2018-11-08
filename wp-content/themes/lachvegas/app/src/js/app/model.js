

import Log from './log';
import Utils from './utils';

export default class Model {


	constructor ( options = {} ) {

    this.app = options.app;

    this.log = new Log();
    this.utils = new Utils();

	}


  save() {

    console.log('saving data', this.data);
		this.loadAsync(this.url, this.data);

  }



	loadAsync(url, data = {}, method = 'post', callback = {}, scope = this) {

    $.ajax({

      url: url,
      data: data,
      dataType: 'json',
      type: method,
      success: response => {

        if (response) {

					console.log(response);

          if (typeof(callback) == 'function') {

              callback.call(scope, response);

          }

        }

			}
    });

  }

}
