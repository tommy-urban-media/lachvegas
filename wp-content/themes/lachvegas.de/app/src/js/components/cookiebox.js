import $ from 'jquery';

import CookieHelper from '../app/cookie';

export default class CookieBox {

    constructor ( options = {} ) {
        this.node = $(options.node);
        this.cookieHelper = new CookieHelper();
        this.init();
    }

    init() {

        this.node.find('[data-button]').on('click', (e) => {
            e.preventDefault();
            this.node.remove();
            this.cookieHelper.set('lv_cookie_info', 1, 10000);
        }); 

    }

}
