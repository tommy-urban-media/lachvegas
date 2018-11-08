//import THREE from 'three.js';

export var __useDefault = true;


/**
 * Utility class to be used for global functions
 */

export default class Utils {

	constructor() {}


	getParam (param){

   	if (param = (new RegExp('[?&]'+encodeURIComponent(param)+'=([^&]*)')).exec(location.search))
      return decodeURIComponent(param[1]);

	}

	isIframe () {

		return !(parent.location == self.location);

	}


	url ( path, cacheBust = false ) {

		if (appConfig.root) {

			let url = appConfig.root + path;

			if (cacheBust)
				return url + '?time=' + Math.random();

			else
				return url;

		}

	}


	// derived from: https://github.com/mrdoob/three.js/blob/master/examples/js/Detector.js
  isWebGLSupported() {

    try {

      let canvas = document.createElement("canvas");
      return !! window.WebGLRenderingContext && (canvas.getContext("webgl") || canvas.getContext("experimental-webgl"));

    } catch(e) { return false; }

  }


  debug(txt) {

  	if (window.isDevelopmentMode)
  		console.log(txt);

  }


	loadAsynch (url, params, callback = {}) {

		$.ajax({
			url: url,
			dataType: 'json',
			data: params,
			method: 'post',
			success: function(data) {
				console.log(data);

				if (callback) {
					callback();
				}
			}
		});


	}


}
