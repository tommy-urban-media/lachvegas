<?php

/**
 * Class ContentTypeController
 *
 * Define Content Types and Taxonomies here.
 * Also add content type specific content
 */
class ContentTypeController {

  private $options = array();


  public function __construct () {

    add_action('init', array( &$this, 'registerContentTypes'));

  }


  public function registerContentTypes() {

    register_post_type('news',
        array(
            'labels' => array(
                'name' => __( 'News' ),
                'singular_name' => __( 'News' ),
                'add_new' => __( 'News eintragen' ),
                'add_new_item' => __( 'neue News anlegen' ),
                'edit_item' => __( 'News bearbeiten' ),
                'new_item' => __( 'neue News' ),
                'view_item' => __( 'News anschauen' ),
                'search_items' => __( 'News suchen' ),
                'not_found' => __( 'News nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'news'
            )
        )
    );

    add_post_type_support( 'news', array('title', 'editor', 'custom-fields', 'thumbnail') );



    register_post_type('statistic',
        array(
            'labels' => array(
                'name' => __( 'Statistiken' ),
                'singular_name' => __( 'Statistik' ),
                'add_new' => __( 'Statistik eintragen' ),
                'add_new_item' => __( 'neue Statistik anlegen' ),
                'edit_item' => __( 'Statistik bearbeiten' ),
                'new_item' => __( 'neue Statistik' ),
                'view_item' => __( 'Statistik anschauen' ),
                'search_items' => __( 'Statistik suchen' ),
                'not_found' => __( 'Statistik nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'statistik'
            )
        )
    );

    add_post_type_support( 'statistic', array('title', 'editor', 'custom-fields', 'thumbnail') );



    register_post_type('saying',
        array(
            'labels' => array(
                'name' => __( 'Sprüche' ),
                'singular_name' => __( 'Spruch' ),
                'add_new' => __( 'Spruch eintragen' ),
                'add_new_item' => __( 'neue Spruch anlegen' ),
                'edit_item' => __( 'Spruch bearbeiten' ),
                'new_item' => __( 'neue Spruch' ),
                'view_item' => __( 'Spruch anschauen' ),
                'search_items' => __( 'Spruch suchen' ),
                'not_found' => __( 'Spruch nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'spruch'
            )
        )
    );

    add_post_type_support( 'saying', array('title', 'editor', 'custom-fields', 'thumbnail') );


    register_post_type('guide',
        array(
            'labels' => array(
                'name' => __( 'Ratgeber' ),
                'singular_name' => __( 'Ratgeber' ),
                'add_new' => __( 'Ratgeber eintragen' ),
                'add_new_item' => __( 'neue Ratgeber anlegen' ),
                'edit_item' => __( 'Ratgeber bearbeiten' ),
                'new_item' => __( 'neue Ratgeber' ),
                'view_item' => __( 'Ratgeber anschauen' ),
                'search_items' => __( 'Ratgeber suchen' ),
                'not_found' => __( 'Ratgeber nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'ratgeber'
            )
        )
    );

    add_post_type_support( 'guide', array('title', 'editor', 'custom-fields', 'thumbnail') );


    register_post_type('job',
        array(
            'labels' => array(
                'name' => __( 'Stellenangebote' ),
                'singular_name' => __( 'Stellenangebot' ),
                'add_new' => __( 'Stellenangebot eintragen' ),
                'add_new_item' => __( 'neue Stellenangebot anlegen' ),
                'edit_item' => __( 'Stellenangebot bearbeiten' ),
                'new_item' => __( 'neue Stellenangebot' ),
                'view_item' => __( 'Stellenangebot anschauen' ),
                'search_items' => __( 'Stellenangebot suchen' ),
                'not_found' => __( 'Stellenangebot nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('post_tag'),
            'rewrite' => array(
              'slug' => 'job'
            )
        )
    );

    add_post_type_support('job', array('title', 'editor', 'custom-fields', 'thumbnail') );


    register_taxonomy(
        'job_categories',
        array(
            'job'
        ),
        array(
            'label' => __('Job Kategorien'),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'job-kategorien')
        ) 
    );

    register_taxonomy(
        'job_places',
        array(
            'job'
        ),
        array(
            'label' => __('Job Orte'),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'job-places')
        ) 
    );

    register_taxonomy(
        'job_features',
        array(
            'job'
        ),
        array(
            'label' => __('Job Features'),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'job-features')
        ) 
    );




    register_post_type('poem',
        array(
            'labels' => array(
                'name' => __( 'Gedichte' ),
                'singular_name' => __( 'Gedicht' ),
                'add_new' => __( 'Gedicht eintragen' ),
                'add_new_item' => __( 'neue Gedicht anlegen' ),
                'edit_item' => __( 'Gedicht bearbeiten' ),
                'new_item' => __( 'neue Gedicht' ),
                'view_item' => __( 'Gedicht anschauen' ),
                'search_items' => __( 'Gedicht suchen' ),
                'not_found' => __( 'Gedicht nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'gedicht'
            )
        )
    );

    add_post_type_support( 'poem', array('title', 'editor', 'custom-fields', 'thumbnail') );



    register_post_type('quiz',
        array(
            'labels' => array(
                'name' => __( 'Quizze' ),
                'singular_name' => __( 'Quiz' ),
                'add_new' => __( 'Quiz eintragen' ),
                'add_new_item' => __( 'neue Quiz anlegen' ),
                'edit_item' => __( 'Quiz bearbeiten' ),
                'new_item' => __( 'neue Quiz' ),
                'view_item' => __( 'Quiz anschauen' ),
                'search_items' => __( 'Quiz suchen' ),
                'not_found' => __( 'Quiz nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'quiz'
            )
        )
    );

    add_post_type_support( 'quiz', array('title', 'editor', 'custom-fields', 'thumbnail') );



    register_taxonomy(
        'people',
        array(
            'guide',
            'news',
            'poem',
            'post',
            'saying',
            'statistic',
            'quiz'
        ),
        array(
            'label' => __( 'Personen' ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'personen' )
        ) 
    );

    // add some post settings
    register_taxonomy(
        'post_settings',
        array(
            'guide',
            'news',
            'poem',
            'post',
            'saying',
            'statistic',
            'quiz'
        ),
        array(
            'label' => __( 'Post Settings' ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'hierarchical' => true,
            'rewrite' => false
        ) 
    );




    register_post_type('poll',
        array(
            'labels' => array(
                'name' => __( 'Umfragen' ),
                'singular_name' => __( 'Umfrage' ),
                'add_new' => __( 'Umfrage eintragen' ),
                'add_new_item' => __( 'neue Umfrage anlegen' ),
                'edit_item' => __( 'Umfrage bearbeiten' ),
                'new_item' => __( 'neue Umfrage' ),
                'view_item' => __( 'Umfrage anschauen' ),
                'search_items' => __( 'Umfrage suchen' ),
                'not_found' => __( 'Umfrage nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'umfragen'
            )
        )
    );

    add_post_type_support( 'poll', array('title', 'editor', 'custom-fields', 'thumbnail') );



  }


}
