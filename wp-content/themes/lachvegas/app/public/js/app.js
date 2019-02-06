(function() {
  'use strict';

  var globals = typeof global === 'undefined' ? self : global;
  if (typeof globals.require === 'function') return;

  var modules = {};
  var cache = {};
  var aliases = {};
  var has = {}.hasOwnProperty;

  var expRe = /^\.\.?(\/|$)/;
  var expand = function(root, name) {
    var results = [], part;
    var parts = (expRe.test(name) ? root + '/' + name : name).split('/');
    for (var i = 0, length = parts.length; i < length; i++) {
      part = parts[i];
      if (part === '..') {
        results.pop();
      } else if (part !== '.' && part !== '') {
        results.push(part);
      }
    }
    return results.join('/');
  };

  var dirname = function(path) {
    return path.split('/').slice(0, -1).join('/');
  };

  var localRequire = function(path) {
    return function expanded(name) {
      var absolute = expand(dirname(path), name);
      return globals.require(absolute, path);
    };
  };

  var initModule = function(name, definition) {
    var hot = hmr && hmr.createHot(name);
    var module = {id: name, exports: {}, hot: hot};
    cache[name] = module;
    definition(module.exports, localRequire(name), module);
    return module.exports;
  };

  var expandAlias = function(name) {
    return aliases[name] ? expandAlias(aliases[name]) : name;
  };

  var _resolve = function(name, dep) {
    return expandAlias(expand(dirname(name), dep));
  };

  var require = function(name, loaderPath) {
    if (loaderPath == null) loaderPath = '/';
    var path = expandAlias(name);

    if (has.call(cache, path)) return cache[path].exports;
    if (has.call(modules, path)) return initModule(path, modules[path]);

    throw new Error("Cannot find module '" + name + "' from '" + loaderPath + "'");
  };

  require.alias = function(from, to) {
    aliases[to] = from;
  };

  var extRe = /\.[^.\/]+$/;
  var indexRe = /\/index(\.[^\/]+)?$/;
  var addExtensions = function(bundle) {
    if (extRe.test(bundle)) {
      var alias = bundle.replace(extRe, '');
      if (!has.call(aliases, alias) || aliases[alias].replace(extRe, '') === alias + '/index') {
        aliases[alias] = bundle;
      }
    }

    if (indexRe.test(bundle)) {
      var iAlias = bundle.replace(indexRe, '');
      if (!has.call(aliases, iAlias)) {
        aliases[iAlias] = bundle;
      }
    }
  };

  require.register = require.define = function(bundle, fn) {
    if (bundle && typeof bundle === 'object') {
      for (var key in bundle) {
        if (has.call(bundle, key)) {
          require.register(key, bundle[key]);
        }
      }
    } else {
      modules[bundle] = fn;
      delete cache[bundle];
      addExtensions(bundle);
    }
  };

  require.list = function() {
    var list = [];
    for (var item in modules) {
      if (has.call(modules, item)) {
        list.push(item);
      }
    }
    return list;
  };

  var hmr = globals._hmr && new globals._hmr(_resolve, require, modules, cache);
  require._cache = cache;
  require.hmr = hmr && hmr.wrap;
  require.brunch = true;
  globals.require = require;
})();

(function() {
var global = typeof window === 'undefined' ? this : window;
var process;
var __makeRelativeRequire = function(require, mappings, pref) {
  var none = {};
  var tryReq = function(name, pref) {
    var val;
    try {
      val = require(pref + '/node_modules/' + name);
      return val;
    } catch (e) {
      if (e.toString().indexOf('Cannot find module') === -1) {
        throw e;
      }

      if (pref.indexOf('node_modules') !== -1) {
        var s = pref.split('/');
        var i = s.lastIndexOf('node_modules');
        var newPref = s.slice(0, i).join('/');
        return tryReq(name, newPref);
      }
    }
    return none;
  };
  return function(name) {
    if (name in mappings) name = mappings[name];
    if (!name) return;
    if (name[0] !== '.' && pref) {
      var val = tryReq(name, pref);
      if (val !== none) return val;
    }
    return require(name);
  }
};
require.register("src/js/app.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

// Import all available Components


var _jquery = require('jquery');

var _jquery2 = _interopRequireDefault(_jquery);

var _components = require('./components');

var _components2 = _interopRequireDefault(_components);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var App = function () {
  function App() {
    _classCallCheck(this, App);

    this._components = _components2.default;
  }

  _createClass(App, [{
    key: 'init',
    value: function init() {

      this.getNodes();
      this.setupTheme();
      this.setupModalTriggers();
    }
  }, {
    key: 'getNodes',
    value: function getNodes() {
      var _this = this;

      (0, _jquery2.default)('[data-component]').each(function (i, node) {

        var component = (0, _jquery2.default)(node).data('component');

        if (_this._components[component] !== undefined) {

          try {

            new _this._components[component]({ app: _this, node: node });
          } catch (e) {

            console.warn('component ' + component + ' could not be called', e);
          }
        } else {

          console.warn('component "' + component + '" does not have implementation ');
        }
      });
    }
  }, {
    key: 'setupTheme',
    value: function setupTheme() {

      (0, _jquery2.default)('.search-label').on('click', function () {
        (0, _jquery2.default)('.search-area').toggleClass('is-expanded');
      });
    }
  }, {
    key: 'setupModalTriggers',
    value: function setupModalTriggers() {

      setTimeout(function () {

        var el = (0, _jquery2.default)('#modal-1');
        el.addClass('modal-show');

        el.find('[data-modal-close]').off('click').on('click', function (e) {
          e.preventDefault();
          el.removeClass('modal-show');
        });

        (0, _jquery2.default)('.modal-overlay').on('click', function () {
          e.preventDefault();
          el.removeClass('modal-show');
        });
      }, 2000);

      (0, _jquery2.default)('[data-modal]').each(function (i, el) {

        var id = (0, _jquery2.default)(el).data('modal');
        var $modal = (0, _jquery2.default)('#' + id);

        (0, _jquery2.default)(el).on('click', function (e) {

          $modal = (0, _jquery2.default)('#' + (0, _jquery2.default)(e.currentTarget).data('modal'));
          $modal.addClass('modal-show');

          $modal.find('[data-modal-close]').off('click').on('click', function (e) {
            e.preventDefault();
            $modal.removeClass('modal-show');
          });

          (0, _jquery2.default)('.modal-overlay').on('click', function () {
            e.preventDefault();
            $modal.removeClass('modal-show');
          });
        });
      });
    }
  }]);

  return App;
}();

exports.default = App;
;

window.App = new App();
window.App.init();
});

require.register("src/js/app/log.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var __useDefault = exports.__useDefault = true;

var Log = function () {
  function Log() {
    _classCallCheck(this, Log);
  }

  _createClass(Log, [{
    key: 'init',
    value: function init() {}
  }, {
    key: 'info',
    value: function info(message) {
      this.print(message, 'info');
    }
  }, {
    key: 'error',
    value: function error(message) {
      this.print(message, 'error');
    }
  }, {
    key: 'print',
    value: function print(message) {
      var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'info';

      if ((typeof console === 'undefined' ? 'undefined' : _typeof(console)) === 'object' && window.console.log) {
        console.log(message);
      }
    }
  }]);

  return Log;
}();

exports.default = Log;
});

;require.register("src/js/app/model.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _log = require('./log');

var _log2 = _interopRequireDefault(_log);

var _utils = require('./utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Model = function () {
  function Model() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Model);

    this.app = options.app;

    this.log = new _log2.default();
    this.utils = new _utils2.default();
  }

  _createClass(Model, [{
    key: 'save',
    value: function save() {

      console.log('saving data', this.data);
      this.loadAsync(this.url, this.data);
    }
  }, {
    key: 'loadAsync',
    value: function loadAsync(url) {
      var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'post';
      var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
      var scope = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : this;


      $.ajax({

        url: url,
        data: data,
        dataType: 'json',
        type: method,
        success: function success(response) {

          if (response) {

            console.log(response);

            if (typeof callback == 'function') {

              callback.call(scope, response);
            }
          }
        }
      });
    }
  }]);

  return Model;
}();

exports.default = Model;
});

;require.register("src/js/app/utils.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

//import THREE from 'three.js';

var __useDefault = exports.__useDefault = true;

/**
 * Utility class to be used for global functions
 */

var Utils = function () {
	function Utils() {
		_classCallCheck(this, Utils);
	}

	_createClass(Utils, [{
		key: 'getParam',
		value: function getParam(param) {

			if (param = new RegExp('[?&]' + encodeURIComponent(param) + '=([^&]*)').exec(location.search)) return decodeURIComponent(param[1]);
		}
	}, {
		key: 'isIframe',
		value: function isIframe() {

			return !(parent.location == self.location);
		}
	}, {
		key: 'url',
		value: function url(path) {
			var cacheBust = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;


			if (appConfig.root) {

				var url = appConfig.root + path;

				if (cacheBust) return url + '?time=' + Math.random();else return url;
			}
		}

		// derived from: https://github.com/mrdoob/three.js/blob/master/examples/js/Detector.js

	}, {
		key: 'isWebGLSupported',
		value: function isWebGLSupported() {

			try {

				var canvas = document.createElement("canvas");
				return !!window.WebGLRenderingContext && (canvas.getContext("webgl") || canvas.getContext("experimental-webgl"));
			} catch (e) {
				return false;
			}
		}
	}, {
		key: 'debug',
		value: function debug(txt) {

			if (window.isDevelopmentMode) console.log(txt);
		}
	}, {
		key: 'loadAsynch',
		value: function loadAsynch(url, params) {
			var callback = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};


			$.ajax({
				url: url,
				dataType: 'json',
				data: params,
				method: 'post',
				success: function success(data) {
					console.log(data);

					if (callback) {
						callback();
					}
				}
			});
		}
	}]);

	return Utils;
}();

exports.default = Utils;
});

;require.register("src/js/app/view.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
exports.__useDefault = undefined;

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _utils = require('./utils');

var _utils2 = _interopRequireDefault(_utils);

var _template = require('../views/template');

var _template2 = _interopRequireDefault(_template);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var __useDefault = exports.__useDefault = true;

/**
 * View base class
 * Used for all DOM - related objects
 *
 */

var View = function () {
	function View() {
		var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

		_classCallCheck(this, View);

		this.options = options;
		this.app = options.app;

		this.utils = new _utils2.default();

		this.name = '';
		this.$view = '';
	}

	_createClass(View, [{
		key: 'setData',
		value: function setData() {}
	}, {
		key: 'render',
		value: function render() {

			this.$el = this.$view;
			return this.$el;
		}
	}, {
		key: 'getHtml',
		value: function getHtml() {

			return this.$el.html();
		}
	}, {
		key: 'appendTo',
		value: function appendTo($element) {}
	}]);

	return View;
}();

exports.default = View;
});

;require.register("src/js/components/calendar.js", function(exports, require, module) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Calendar = function Calendar() {
  var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  _classCallCheck(this, Calendar);

  console.log(options);
};

exports.default = Calendar;
});

;require.register("src/js/components/index.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _calendar = require('./calendar');

var _calendar2 = _interopRequireDefault(_calendar);

var _menu = require('./menu');

var _menu2 = _interopRequireDefault(_menu);

var _modal = require('./modal');

var _modal2 = _interopRequireDefault(_modal);

var _ticker = require('./ticker');

var _ticker2 = _interopRequireDefault(_ticker);

var _quiz = require('./quiz');

var _quiz2 = _interopRequireDefault(_quiz);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {

  Calendar: _calendar2.default,
  Ticker: _ticker2.default,
  Menu: _menu2.default,
  Modal: _modal2.default,
  Quiz: _quiz2.default

};
});

;require.register("src/js/components/menu.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _jquery = require('jquery');

var _jquery2 = _interopRequireDefault(_jquery);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Menu = function () {
  function Menu() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Menu);

    this.node = (0, _jquery2.default)(options.node);
    this.init();
  }

  _createClass(Menu, [{
    key: 'init',
    value: function init() {
      var _this = this;

      this.node.find('.menu-icon').on('click', function (e) {
        e.preventDefault();
        _this.node.find('.menu').slideToggle('fast');
      });
    }
  }]);

  return Menu;
}();

exports.default = Menu;
});

;require.register("src/js/components/modal.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _jquery = require('jquery');

var _jquery2 = _interopRequireDefault(_jquery);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Modal = function () {
  function Modal() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Modal);

    this.node = (0, _jquery2.default)(options.node);
    this.init();
  }

  _createClass(Modal, [{
    key: 'init',
    value: function init() {
      var _this = this;

      this.overlay = document.querySelector('.modal-overlay');

      this.node.find('.modal__close').on('click', function () {
        _this.node.removeClass('modal-show');
      });

      this.node.on('click', function () {});
    }
  }]);

  return Modal;
}();

exports.default = Modal;
});

;require.register("src/js/components/quiz.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _jquery = require('jquery');

var _jquery2 = _interopRequireDefault(_jquery);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Quiz = function () {
  function Quiz() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Quiz);

    this.node = (0, _jquery2.default)(options.node);
    this.data = this.node.data('param');
    this.url = this.node.data('url');
    this.$currentButtonTarget = null;

    this.user = {
      answers: []
    };

    this.answerTexts = {
      right: ["Richtig! ", "Genau! ", "Richtige Antwort. "],
      wrong: ["Falsch! "]
    };

    this.init();
  }

  _createClass(Quiz, [{
    key: 'init',
    value: function init() {
      var _this = this;

      this.node.find('[data-button]').on('click', function (e) {
        e.preventDefault();

        var $el = (0, _jquery2.default)(e.currentTarget);
        var value = $el.data('value');

        _this.$currentButtonTarget = $el;
        _this.deactivateQuestion($el.closest('[data-question-id]'));

        _this.save({
          quiz_id: _this.data.id,
          question_id: $el.closest('[data-question-id]').data('question-id'),
          question_result: $el.closest('[data-question-result]').data('question-result'),
          answer_id: $el.data('answer-id'),
          answer_value: value
        });
      });
    }
  }, {
    key: 'save',
    value: function save(obj) {
      var _this2 = this;

      var data = Object.assign({}, { action: 'add_quiz_result' }, obj);

      _jquery2.default.ajax({
        url: this.url,
        dataType: 'json',
        data: data,
        type: 'POST',
        success: function success(data) {

          if (data.status) {

            var resultEl = _this2.$currentButtonTarget.closest('[data-question-id]').find('[data-answer-text]').show();

            if (data.answer_correct) {
              resultEl.find('[data-answer-pretext]').addClass('state-is-true').html('<i class="fa fa-check-circle"></i>');
              resultEl.find('[data-answer-right-wrong]').html(_this2.answerTexts.right[0]);
            } else {
              resultEl.find('[data-answer-pretext]').addClass('state-is-false').html('<i class="fa fa-times-circle"></i>');
              resultEl.find('[data-answer-right-wrong]').html(_this2.answerTexts.wrong[0]);
            }

            _this2.user.answers.push({
              question_id: obj.question_id,
              answer_correct: data.answer_correct
            });

            resultEl.css('display', 'flex');
            _this2.deactivateQuestion();
            _this2.checkSummary();
          }
        }
      });
    }
  }, {
    key: 'deactivateQuestion',
    value: function deactivateQuestion(selector) {
      (0, _jquery2.default)(selector).find('[data-button]').attr('disabled', 'disabled');
    }
  }, {
    key: 'checkSummary',
    value: function checkSummary() {
      if (this.user.answers.length === this.data.questions.length) {
        console.log('show results');

        (0, _jquery2.default)('[data-summary-text]').html(this.getSummaryText({
          correct_answers: this.user.answers.filter(function (answer) {
            return answer.answer_correct === true;
          }).length,
          questions: this.data.questions.length
        }));
      } else {
        console.log('dont show results yet');
      }
    }
  }, {
    key: 'getSummaryText',
    value: function getSummaryText() {
      var obj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      return 'Du hast ' + obj.correct_answers + ' von ' + obj.questions + ' richtig beantwortet.';
    }
  }]);

  return Quiz;
}();

exports.default = Quiz;
});

;require.register("src/js/components/ticker.js", function(exports, require, module) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// import View from '../app/view';

var Ticker = function Ticker() {
  var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  _classCallCheck(this, Ticker);

  console.log(options);
};

exports.default = Ticker;
});

;require.register("src/js/helpers/clickHelper.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Helper class to define custom geometries used for THREE.js rendering
 */
var ClickHelper = function () {
  function ClickHelper() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, ClickHelper);

    this.app = options.app;
    this.mouse = new THREE.Vector2();
    //this.projector = new THREE.Projector();

    this.points = [];
    this.mesh = null;
    this.helperPlane = options.plane || null;
    this.connectPoints = true;

    if (!this.helperPlane) this.renderHelperPlane();

    this.initClickEvents();
  }

  _createClass(ClickHelper, [{
    key: 'initClickEvents',
    value: function initClickEvents() {
      var _this = this;

      document.addEventListener('mousedown', function (e) {
        return _this.onDocumentMouseDown(e);
      }, false);
    }
  }, {
    key: 'renderHelperPlane',
    value: function renderHelperPlane() {

      this.groundFloor = new THREE.PlaneGeometry(10000, 10000, 1);

      this.helperPlane = new THREE.Mesh(this.groundFloor, new THREE.MeshLambertMaterial({
        color: 0x00ff00
      }));

      this.helperPlane.rotation.x = -Math.PI / 2;
      this.app.scene.add(this.helperPlane);
    }
  }, {
    key: 'get3dPointZAxis',
    value: function get3dPointZAxis(event) {
      var vector = new THREE.Vector3(event.clientX / window.innerWidth * 2 - 1, -(event.clientY / window.innerHeight) * 2 + 1, 0.5);

      vector.unproject(this.app.camera);
      var dir = vector.sub(this.app.camera.position).normalize();
      var distance = -this.app.camera.position.z / dir.z;
      var pos = this.app.camera.position.clone().add(dir.multiplyScalar(distance));
      return pos;
    }
  }, {
    key: 'renderPoints',
    value: function renderPoints() {

      if (this.points) {

        this.app.scene.remove(this.mesh);

        var shape = new THREE.Shape(this.points);
        // var geometry = new THREE.ShapeGeometry( shape );

        shape.autoClose = true;
        var points = shape.createPointsGeometry();
        var spacedPoints = shape.createSpacedPointsGeometry(50);

        this.mesh = new THREE.Line(points, new THREE.LineBasicMaterial({ color: 0xce0000, linewidth: 3 }));
        //line.position.set( this.mouse.x, 10, this.mouse.y );
        this.mesh.rotation.x = Math.PI / 2;
        this.mesh.scale.set(1, 1, 1);

        this.app.scene.add(this.mesh);

        var p = JSON.stringify(this.points);
        console.log(p);
      }
    }
  }, {
    key: 'onDocumentMouseDown',
    value: function onDocumentMouseDown(e) {

      e.preventDefault();
      this.updateMousePosition(e);

      console.log('clickHelper clicked at', this.mouse);

      if (this.connectPoints) {

        var pos = this.get3dPointZAxis(e);
        console.log(pos);

        this.points.push(new THREE.Vector3(pos.x, -pos.y, 0));

        this.renderPoints();
      }

      var intersects = this.app.raycaster.intersectObject(this.helperPlane);

      if (intersects.length && intersects[0].object) {

        console.log('intersecting plane', intersects);
      }
    }
  }, {
    key: 'updateMousePosition',
    value: function updateMousePosition(e) {

      this.mouse.x = e.clientX / $('#webgl-scene').width() * 2 - 1;
      this.mouse.y = -(e.clientY / $('#webgl-scene').height()) * 2 + 1;
    }
  }]);

  return ClickHelper;
}();

exports.default = ClickHelper;
});

;require.register("src/js/helpers/datetime.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _log = require('../app/log');

var _log2 = _interopRequireDefault(_log);

var _utils = require('../app/utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Datetime = function () {
  function Datetime() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Datetime);

    this.time = options.time;
  }

  _createClass(Datetime, [{
    key: 'setTime',
    value: function setTime(time) {

      this.time = time;
    }

    /**
     * Retrieves a time based string in the format:
     * ALso adds leading zeros.
     * 
     * mm:ss => 00:00
     */

  }, {
    key: 'getMinutesWithSeconds',
    value: function getMinutesWithSeconds() {

      var min = Math.floor(this.time / 60);
      var sec = (this.time - min * 60).toFixed(0);

      if (min < 10) {
        min = '0' + min;
      }

      if (sec < 10) {
        sec = '0' + sec;
      }

      return min + ':' + sec;
    }
  }]);

  return Datetime;
}();

exports.default = Datetime;
});

;require.register("src/js/helpers/geometry.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); //import THREE from 'three.js';

var _log = require('../app/log');

var _log2 = _interopRequireDefault(_log);

var _utils = require('../app/utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Helper class to define custom geometries used for THREE.js rendering
 */
var Geometry = function () {
	function Geometry() {
		var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

		_classCallCheck(this, Geometry);

		this.options = options;
		this.utils = new _utils2.default();
	}

	_createClass(Geometry, [{
		key: 'renderDashedCircle',
		value: function renderDashedCircle(radius, color) {

			if (color == undefined) color = new THREE.Color('rgba(255, 255, 255, 0.75)');

			var circleGeometry = new THREE.Geometry();
			var verticesArray = circleGeometry.vertices;
			var segments = 128;
			var angle = 2 * Math.PI / segments;

			for (var i = 0; i <= segments; i++) {
				var x = radius * Math.cos(angle * i);
				var y = radius * Math.sin(angle * i);

				verticesArray.push(new THREE.Vector3(x, y, 0));
			}

			// see: http://soledadpenades.com/articles/three-js-tutorials/drawing-the-coordinate-axes/
			var circleMaterial = new THREE.LineDashedMaterial({
				color: 0x00FF00,
				transparent: true,
				opacity: 0.1,
				dashSize: this.utils.AU / 1000,
				gapSize: this.utils.AU / 1000
			});

			circleGeometry.computeLineDistances();

			var circleLine = new THREE.Line(circleGeometry, circleMaterial, THREE.LinePieces);
			circleLine.position.set(0, 0, 0);
			circleLine.rotation.set(-90 * Math.PI / 180, 0, 0);

			return circleLine;
		}
	}]);

	return Geometry;
}();

exports.default = Geometry;
});

;require.register("src/js/helpers/particle.js", function(exports, require, module) {
"use strict";

Object.defineProperty(exports, "__esModule", {
		value: true
});

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Particle = function Particle(options) {
		_classCallCheck(this, Particle);

		// define the position of the particle
		this.position = options.vector;

		// initialize size with init value
		this.size = 256;

		// field for additional 
		this.properties = {};
};

exports.default = Particle;
});

;require.register("src/js/helpers/text.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); //import THREE from 'three.js';

var _log = require('../app/log');

var _log2 = _interopRequireDefault(_log);

var _utils = require('../app/utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Helper class to define custom geometries used for THREE.js rendering
 */
var Text = function () {
	function Text() {
		var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

		_classCallCheck(this, Text);

		this.options = options;
		this.utils = new _utils2.default();

		this.app = options.app;
		this.text = options.text;
		this.color = options.color || 0x009000;
		this.position = options.position;

		this.font = './fonts/optimer_bold.typeface.json';
		this.isCenter = options.isCenter || true;

		this.material = new THREE.MeshPhongMaterial({
			color: this.color,
			shininess: 100
		});

		this.mesh;
	}

	_createClass(Text, [{
		key: 'render',
		value: function render() {
			var _this = this;

			this.loader = new THREE.FontLoader();
			this.loader.load(this.font, function (font) {

				_this.geometry = new THREE.TextGeometry(_this.text, {

					font: font,

					size: .7,
					height: .01,
					curveSegments: 20,
					weight: 'light',

					bevelThickness: .03,
					bevelSize: .01,
					bevelEnabled: true

				});

				_this.mesh = new THREE.Mesh(_this.geometry, _this.material);

				if (_this.isCenter) _this.center();

				_this.mesh.castShadow = true;

				if (_this.options.group) _this.options.group.add(_this.mesh);
			});
		}
	}, {
		key: 'center',
		value: function center() {

			this.geometry.computeBoundingBox();
			var textWidth = this.geometry.boundingBox.max.x - this.geometry.boundingBox.min.x;

			this.mesh.position.set(-0.5 * textWidth, .1, 0);
		}
	}, {
		key: 'getMesh',
		value: function getMesh() {

			return this.mesh;
		}
	}]);

	return Text;
}();

exports.default = Text;
});

;require.register("src/js/helpers/textures.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); //import THREE from 'three.js';

var _log = require('../app/log');

var _log2 = _interopRequireDefault(_log);

var _utils = require('../app/utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Helper class to define custom textures used for THREE.js rendering
 * Textures rendered to 2d canvas
 */
var Textures = function () {
  function Textures() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Textures);

    this.options = options;
    this.utils = new _utils2.default();

    this.canvas = null;
    this.context = null;
    this.size = 512;
  }

  _createClass(Textures, [{
    key: 'createCanvas',
    value: function createCanvas() {
      var size = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 128;


      this.size = size;
      this.canvas = document.createElement('canvas');
      this.canvas.width = this.size;
      this.canvas.height = this.size;
    }
  }, {
    key: 'getCircleMaterial',
    value: function getCircleMaterial() {
      var size = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 128;


      this.createCanvas(size);
      this.context = this.canvas.getContext('2d');

      this.context.beginPath();
      this.context.arc(this.canvas.width, this.canvas.height, size / 2, 0, 2 * Math.PI);
      this.context.stroke();

      return this.canvas;
    }
  }, {
    key: 'updateCircleTexture',
    value: function updateCircleTexture(time) {
      var color = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '#00ce00';
      var glowColor = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '#ffffff';


      var radius = Math.abs(this.size / 2 * Math.sin(time.elapsedTime));

      this.clearCanvas();

      this.drawRadialGradient();

      this.drawCircle(radius, 4, '#00ce00', 2, '#fff');
      //this.drawCircle(radius/2, 8, '#00ce00');
      //this.drawCircle(radius/6, 6, '#00ce00');
    }
  }, {
    key: 'clearCanvas',
    value: function clearCanvas() {
      var clearColor = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'black';


      this.context.fillStyle = clearColor;
      this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
    }
  }, {
    key: 'drawCircle',
    value: function drawCircle() {
      var radius = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 10;
      var lineWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 10;
      var stroke = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '#00ce00';
      var shadowRadius = arguments[3];
      var shadowColor = arguments[4];


      this.context.beginPath();

      if (shadowRadius && shadowColor) {
        this.context.shadowBlur = shadowRadius;
        this.context.shadowColor = shadowColor;
      }

      this.context.lineWidth = lineWidth;
      this.context.strokeStyle = stroke;
      this.context.arc(this.canvas.width / 2, this.canvas.width / 2, radius, 0, 2 * Math.PI);
      this.context.stroke();
    }
  }, {
    key: 'drawRadialGradient',
    value: function drawRadialGradient() {

      var gradient = this.context.createRadialGradient(this.canvas.width / 2, this.canvas.height / 2, 0, this.canvas.width / 2, this.canvas.height / 2, this.canvas.width / 2);

      gradient.addColorStop(0.0, 'rgba(50, 200, 50, 1.0)');
      gradient.addColorStop(0.85, 'rgba(25, 255, 25, 0.35)');
      gradient.addColorStop(1.0, 'rgba(0, 50, 0, 0.0)');

      this.context.fillStyle = gradient;
      this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
    }
  }, {
    key: 'getStarMaterial',
    value: function getStarMaterial(showShininess) {

      // create the star texture
      var canvas = document.createElement('canvas');
      canvas.width = 512;
      canvas.height = 512;

      //var col = new THREE.Color(color);
      var context = canvas.getContext('2d');

      var gradient = context.createRadialGradient(canvas.width / 2, canvas.height / 2, 0, canvas.width / 2, canvas.height / 2, canvas.width / 2);

      gradient.addColorStop(0, 'rgba(255, 255, 255, 1.0)');
      gradient.addColorStop(0.05, 'rgba(205, 205, 224, 1.0)');
      gradient.addColorStop(0.1, 'rgba(125, 100, 0, 0.35)');
      gradient.addColorStop(1.0, 'rgba(0,0,0,0.0)');

      context.fillStyle = gradient;
      context.fillRect(0, 0, canvas.width, canvas.height);

      if (showShininess) {
        context.beginPath();
        context.lineWidth = 2;

        // top - bottom
        context.moveTo(canvas.width / 2, 0);
        context.lineTo(canvas.width / 2, canvas.height);

        // left - right
        context.moveTo(0, canvas.height / 2);
        context.lineTo(canvas.width, canvas.height / 2);

        // set line color
        context.strokeStyle = 'rgba(255,255,255,0.75)';
        context.stroke();
      }

      var texture = new THREE.Texture(canvas);
      texture.needsUpdate = true;

      return texture;
    }
  }]);

  return Textures;
}();

exports.default = Textures;
});

;require.register("src/js/templates/dialog.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = template;

//import TemplateLevelStart from './dialog/level_start';
//import TemplateLevelCompleted from './dialog/level_completed';

function template(data) {

  console.log('rendering template with data', data);

  return $('\n\n    <div class="dialog">\n\n      <div class="dialog-title">' + data.title + '</div>\n\n      <div class="dialog-content">' + data.content + '</div>\n\n    </div>\n\n  ');
}
});

;require.register("src/js/templates/dialog/level_completed.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = template;
function template(data) {

  console.log('rendering template with data', data);

  return $('\n    <div>\n\n      <h1>Level Solved</h1>\n\n      <p>\n        moves: ' + data.moves + ' <br>\n        pushes: ' + data.pushes + ' <br>\n        time: ' + data.time + '\n      </p>\n\n      <p>\n\n        <button\n          id="button-replay-level"\n          class="button button-large button-game"\n          data-handler="interactive"\n          data-event="click"\n          data-action="reload"\n          title="Reload this level">\n\n          <span class="fa fa-repeat"></span>\n\n        </button>\n\n\n        <button\n          id="button-next-level"\n          class="button button-large button-game"\n          data-handler="interactive"\n          data-event="click"\n          data-action="loadNextLevel"\n          title="Load next Level">\n\n          <span class="fa fa-forward"></span>\n\n        </button>\n\n      </p>\n\n    </div>\n  ');
}
});

;require.register("src/js/templates/dialog/level_start.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = template;
function template(data) {

  console.log('rendering template with data', data);

  return $('\n    <div>\n\n      <p>The best result for this level was:</p>\n      <p>3:00 Min <br> 56 pushes <br> 143 moves </p>\n      <h3>Can you beat it?</h3>\n      <p>\n\n        <button\n          class="button button-large button-game"\n          data-handler="interactive"\n          data-event="click"\n          data-action="start"\n          data-scope="level"\n          id="btn-start-game">\n\n          Start Game\n\n        </button>\n\n      </p>\n\n    </div>\n  ');
}
});

;require.register("src/js/views/button.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _view = require('../app/view');

var _view2 = _interopRequireDefault(_view);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Button = function (_View) {
  _inherits(Button, _View);

  function Button() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Button);

    var _this = _possibleConstructorReturn(this, (Button.__proto__ || Object.getPrototypeOf(Button)).call(this));

    _this.app = options.app;
    _this.name = options.name;
    _this.text = options.text;

    _this.object = options.object;
    _this.action = options.action;

    _this.isActive = false;

    _this.$template = $('<button class="button button-round button-control button-inactive">' + _this.text + '</button>');

    return _this;
  }

  _createClass(Button, [{
    key: 'render',
    value: function render() {
      var $element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : $('body');


      $element.append(this.$template);
      this.initEvents();
    }
  }, {
    key: 'initEvents',
    value: function initEvents() {
      var _this2 = this;

      this.$template.on('click', function (e) {

        if (!_this2.isActive) return;

        var $btn = $(e.currentTarget);
        _this2.app.level[_this2.object][_this2.action]();
      });
    }
  }, {
    key: 'remove',
    value: function remove() {

      this.$template.remove();
    }
  }, {
    key: 'activate',
    value: function activate() {

      this.isActive = true;
      this.$template.addClass('button-animated');
    }
  }, {
    key: 'deactivate',
    value: function deactivate() {

      this.isActive = false;
      this.$template.removeClass('button-animated');
    }
  }]);

  return Button;
}(_view2.default);

exports.default = Button;
});

;require.register("src/js/views/dialog.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _view = require('../app/view');

var _view2 = _interopRequireDefault(_view);

var _dialog = require('../templates/dialog');

var _dialog2 = _interopRequireDefault(_dialog);

var _level_start = require('../templates/dialog/level_start');

var _level_start2 = _interopRequireDefault(_level_start);

var _level_completed = require('../templates/dialog/level_completed');

var _level_completed2 = _interopRequireDefault(_level_completed);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

// base template


// nested templates


var Dialog = function (_View) {
  _inherits(Dialog, _View);

  function Dialog() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Dialog);

    var _this = _possibleConstructorReturn(this, (Dialog.__proto__ || Object.getPrototypeOf(Dialog)).call(this));

    _this.classes = {
      TemplateLevelStart: _level_start2.default,
      TemplateLevelCompleted: _level_completed2.default
    };

    _this.app = options.app;
    _this.data = options.data;

    _this.className = '.dialog';

    _this.prepareTemplate();
    _this.render();
    _this.initEvents();

    return _this;
  }

  _createClass(Dialog, [{
    key: 'prepareTemplate',
    value: function prepareTemplate() {

      // render main template with nested template
      if (this.data.template) {

        var nestedTemplate = new this.classes[this.data.template](this.data);
        this.data.content = nestedTemplate.html();
      }

      this.$template = new _dialog2.default(this.data);
    }
  }, {
    key: 'render',
    value: function render() {

      $('body').find(this.className).remove();
      $('body').append(this.$template);

      this.resizeToContent();
    }
  }, {
    key: 'initEvents',
    value: function initEvents() {
      var _this2 = this;

      this.$template.find('[data-handler]').each(function (i, item) {

        $(item).on($(item).data('event'), function (e) {

          e.preventDefault();

          var $btn = $(e.currentTarget);
          var action = $btn.data('action');

          _this2.app[action]();
          _this2.close();
        });
      });

      /*
      this.$template.find('.button-round').on('click', (e) => {
         let $btn = $(e.currentTarget);
        let resolution = $btn.data('resolution');
         this.$template.find('.button-round').not(this).removeClass('active');
        $btn.toggleClass('active');
         this.action.scope.setResolution(resolution);
         this.$template.find('.action-btn').removeClass('hidden');
       });
      */

      /*
      this.$template.find('.action-btn').on('click', (e) => {
         this.close();
        this.action.scope[this.action.function]();
       });
      */

      /*
      this.actions.forEach( (action) => {
         $(action.id).on('click', (e) => {
          e.preventDefault();
           this.app[action.action]();
          this.close();
         });
       });
      */
    }
  }, {
    key: 'resizeToContent',
    value: function resizeToContent() {

      var contentWidth = this.$template.outerWidth();
      var contentHeight = this.$template.outerHeight();

      this.$template.css({
        left: $(window).width() / 2 - contentWidth / 2,
        top: $(window).height() / 2 - contentHeight / 2
      });
    }
  }, {
    key: 'close',
    value: function close() {

      this.$template.remove();
    }
  }]);

  return Dialog;
}(_view2.default);

exports.default = Dialog;
});

;require.register("src/js/views/interface.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _view = require('../app/view');

var _view2 = _interopRequireDefault(_view);

var _datetime = require('../helpers/datetime');

var _datetime2 = _interopRequireDefault(_datetime);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Interface = function (_View) {
  _inherits(Interface, _View);

  function Interface() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Interface);

    var _this = _possibleConstructorReturn(this, (Interface.__proto__ || Object.getPrototypeOf(Interface)).call(this));

    _this.app = options.app;
    _this.datetime = new _datetime2.default();

    _this.$template = $('\n      <div id="interface">\n\n        <div class="level">\n          <span class="level-name"></span>\n          <span class="level-difficulty"></span>\n        </div>\n\n        <div class="time">\n          <span class="icon">Time: </span>\n          <span class="time-seconds">00:00</span>\n        </div>\n\n        <div class="moves">\n          <span class="icon">Moves: </span>\n          <span class="number-moves">0</span>\n        </div>\n\n        <div class="pushes">\n          <span class="icon">Pushes: </span>\n          <span class="number-pushes">0</span>\n        </div>\n\n        <div class="icons" title="How to play">\n          <span class="icon icon-help" data-action="openLightbox">i</span>\n          <span class="icon icon-fullscreen">fs</span>\n          <span class="icon icon-solver" id="solver">S</span>\n        </div>\n\n      </div>\n\n      <div id="items">\n        <!--\n        <div class="item">\n          <span class="icon">Hammer: </span>\n          <span class="hammers-number">0</span>\n        </div>\n        -->\n      </div>\n\n      <div id="buttons"></div>\n\n      <div id="controls">\n        <div class="button button-round button-control button-up">up</div>\n        <div class="button button-round button-control button-left">left</div>\n        <div class="button button-round button-control button-down">down</div>\n        <div class="button button-round button-control button-right">right</div>\n      </div>\n\n    ');

    return _this;
  }

  _createClass(Interface, [{
    key: 'render',
    value: function render() {

      $('body').append(this.$template);

      this.initEvents();
    }
  }, {
    key: 'initEvents',
    value: function initEvents() {
      var _this2 = this;

      this.$template.find('.button-up').on('click', function (e) {
        _this2.app.level.character.move('up');
      });

      this.$template.find('.button-left').on('click', function (e) {
        _this2.app.level.character.move('left');
      });

      this.$template.find('.button-down').on('click', function (e) {
        _this2.app.level.character.move('down');
      });

      this.$template.find('.button-right').on('click', function (e) {
        _this2.app.level.character.move('right');
      });

      this.$template.find('.icon-fullscreen').on('click', function (e) {

        if (THREEx.FullScreen.available()) {

          THREEx.FullScreen.activated() ? THREEx.FullScreen.cancel() : THREEx.FullScreen.request();
        }
      });
    }
  }, {
    key: 'setLevelName',
    value: function setLevelName(level) {

      this.$template.find('.level-name').text(level.world + '@' + level.name);

      if (level.difficulty) {
        this.$template.find('.level-difficulty').text('(' + level.difficulty + ' level)');
      }
    }
  }, {
    key: 'setMoves',
    value: function setMoves(moves) {

      this.$template.find('.number-moves').text(moves);
    }
  }, {
    key: 'setPushes',
    value: function setPushes(pushes) {

      this.$template.find('.number-pushes').text(pushes);
    }
  }, {
    key: 'updateTime',
    value: function updateTime(time) {

      this.datetime.setTime(time);
      this.$template.find('.time .time-seconds').text(this.datetime.getMinutesWithSeconds());
    }
  }, {
    key: 'remove',
    value: function remove() {

      this.$template.remove();
    }
  }]);

  return Interface;
}(_view2.default);

exports.default = Interface;
});

;require.register("src/js/views/label.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _view = require('../app/view');

var _view2 = _interopRequireDefault(_view);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Label = function (_View) {
  _inherits(Label, _View);

  function Label() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Label);

    var _this = _possibleConstructorReturn(this, (Label.__proto__ || Object.getPrototypeOf(Label)).call(this));

    _this.app = options.app;
    _this.data = options.data;
    _this.planetsystem = options.planetsystem;

    _this.planetsystemName = _this.planetsystem.name.toLowerCase().replace(' ', '-');
    _this.planetName = _this.data.name.toLowerCase().replace(' ', '-');

    _this.$template = $('\n      <span class="label label-' + _this.planetsystemName + ' label-' + _this.planetName + '">\n        <span class="label-marker"></span>\n        ' + _this.data.name + '\n      </span>\n    ');

    _this.render();
    _this.initEvents();

    return _this;
  }

  _createClass(Label, [{
    key: 'render',
    value: function render() {

      this.$template.css({ 'color': '#' + this.utils.orbitColors[this.app.systems.length].toString(16) });

      $('#labels').append(this.$template);
    }
  }, {
    key: 'initEvents',
    value: function initEvents() {

      this.$template.on('click', function (e) {

        var $btn = $(e.currentTarget);

        console.log('load planet data');
      });

      this.$template.on('mouseover', function (e) {

        console.log('planet mouseover');
      });

      this.$template.on('mouseout', function (e) {

        console.log('planet mouseout');
      });
    }
  }, {
    key: 'remove',
    value: function remove() {

      this.$template.remove();
    }
  }, {
    key: 'updatePosition',
    value: function updatePosition(object) {

      //let pos = window.utils.getPosition2D( mesh.parent.parent, self.camera, self.projector);
      var pos = this.utils.toScreenPosition(object, this.app.camera);

      this.$template.css({
        'left': pos.x + 'px',
        'top': pos.y + 'px'
      });
    }
  }]);

  return Label;
}(_view2.default);

exports.default = Label;
});

;require.register("src/js/views/template.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _utils = require('../app/utils');

var _utils2 = _interopRequireDefault(_utils);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Template = function () {
	function Template() {
		var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

		_classCallCheck(this, Template);

		this.utils = new _utils2.default();
		this.templates = [];

		this.data = options.data;
		this.template = options.template;

		this.templates['tooltipStarTemplate'] = $('\n\n\t\t\t<div class="headline">' + this.data.pl_hostname + '</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Type</span></div>\n\t\t\t  <div class="value"><span>' + this.data.type + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Distance (Parsec)</span></div>\n\t\t\t  <div class="value"><span>' + this.data.dist + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Distance (Light Years)</span></div>\n\t\t\t  <div class="value"><span>' + (this.data.dist * this.utils.PC).toFixed(2) + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Mass (Sun Masses)</span></div>\n\t\t\t  <div class="value"><span>' + this.data.mass + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Radius (Sun Radii)</span></div>\n\t\t\t  <div class="value"><span>' + this.data.radius + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Planets</span></div>\n\t\t\t  <div class="value"><span>' + this.data.pl_num + '</span></div>\n\t\t\t</div>\n\n\t\t\t<div class="property">\n\t\t\t  <div class="label"><span>Habitable Planets</span></div>\n\t\t\t  <div class="value"><span>' + this.data.habitable + '</span></div>\n\t\t\t</div>\n\n\t\t');
	}

	_createClass(Template, [{
		key: 'render',
		value: function render() {

			return this.templates[this.template];
		}
	}]);

	return Template;
}();

exports.default = Template;
});

;require.register("src/js/views/tooltip.js", function(exports, require, module) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _view = require('../app/view');

var _view2 = _interopRequireDefault(_view);

var _template = require('./template');

var _template2 = _interopRequireDefault(_template);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Tooltip = function (_View) {
  _inherits(Tooltip, _View);

  function Tooltip() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, Tooltip);

    var _this = _possibleConstructorReturn(this, (Tooltip.__proto__ || Object.getPrototypeOf(Tooltip)).call(this));

    _this.template = options.template ? options.template : 'default';
    _this.$template = $('<div id="tooltip"></div>');
    _this.render();
    return _this;
  }

  _createClass(Tooltip, [{
    key: 'render',
    value: function render() {

      if (this.template) console.log(this.template);

      $('body').append(this.$template);
    }
  }, {
    key: 'setData',
    value: function setData(data) {

      var template = new _template2.default({
        template: 'tooltipStarTemplate',
        data: data
      });

      this.$template.html(template.render());
    }
  }, {
    key: 'updatePosition',
    value: function updatePosition(pos) {

      this.$template.css({
        left: pos.x + 18,
        top: pos.y
      });
    }
  }, {
    key: 'remove',
    value: function remove() {

      this.$template.remove();
    }
  }, {
    key: 'show',
    value: function show() {

      this.$template.show();
    }
  }, {
    key: 'hide',
    value: function hide() {

      this.$template.hide();
    }
  }]);

  return Tooltip;
}(_view2.default);

exports.default = Tooltip;
});

;require.alias("process/browser.js", "process");process = require('process');require.register("___globals___", function(exports, require, module) {
  
});})();require('___globals___');


//# sourceMappingURL=app.js.map