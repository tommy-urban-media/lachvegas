<?php

class Import {


  public function __construct() {

    // var_dump($_REQUEST);

		add_action( 'wp_ajax_nopriv_import_job', array( &$this, 'importJob') );
    add_action( 'wp_ajax_import_job', array( &$this, 'importJob') );

	}


  public function importJob() {

		if (true) {

		} else {
			echo 'No Data was given or no request was fired';
		}

	}

}