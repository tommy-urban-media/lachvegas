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



    register_post_type('person',
        array(
            'labels' => array(
                'name' => __( 'Personen' ),
                'singular_name' => __( 'Person' ),
                'add_new' => __( 'Person eintragen' ),
                'add_new_item' => __( 'neue Person anlegen' ),
                'edit_item' => __( 'Person bearbeiten' ),
                'new_item' => __( 'neue Person' ),
                'view_item' => __( 'Person anschauen' ),
                'search_items' => __( 'Person suchen' ),
                'not_found' => __( 'Person nicht gefunden' ),
                'not_found_in_trash' => __( 'kein Eintrag im Papierkorb gefunden' )
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'capability_type' => 'post',
            'taxonomies' => array('category', 'post_tag'),
            'rewrite' => array(
              'slug' => 'person'
            )
        )
    );

    add_post_type_support( 'person', array('title', 'editor', 'custom-fields', 'thumbnail') );



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

  }


}
