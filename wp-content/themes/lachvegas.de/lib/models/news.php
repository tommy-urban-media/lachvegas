<?php

include_once __DIR__ . '/model.php';

class News extends SModel {

    protected $_ID;
    protected $_data;
    protected $_post_type = 'news';
    protected $_post_status = 'future';

    public function __construct($data = []) {
		parent::__construct($data);

        if (!isset($this->_data->date) || empty($this->_data->date)) {
            //$this->_data->date = date('Y-m-d');

            $min = strtotime('2019-01-01');
            $max = strtotime('2019-12-31');

            $date = rand($min, $max);

            //if ($date <= time()) {
                $this->_post_status = 'publish';
            //}

            $this->_data->date = date('Y-m-d', $date);
        }
    }

    public function save() {

        if (empty($this->_data->title)) {
            return;
        }

        $arr = [
            'post_date' => date('Y-m-d', strtotime($this->_data->date)),
            'post_title' => $this->_data->title,
            'post_content' => $this->_data->content,
            'post_type' => $this->_post_type,
            'post_status' => $this->_post_status
        ];

        $p = get_posts(
            array(
				'post_status' => 'any',
				'post_type' => $this->_post_type,
				'meta_query' => array(
                	array(
						'key' => 'news_id',
						'value' => $this->_data->id,
						'compare' => '=='
                    )
                )
            )
        );

        if (is_array($p)) {
            // check if there is a post with a give saying_id already stored
            if (!isset($p[0]->ID)) {
                $this->_ID = wp_insert_post($arr);
            }
            else {
                $arr['ID'] = $p[0]->ID;
                $this->_ID = $p[0]->ID;
                wp_update_post($arr);
                update_post_meta($this->_ID, 'import_update', date('Y-m-d H:i:s'));
            }
        }

        $postSettings = '';
        if ($this->_data->repeatable == '1') {
            $postSettings .= 'repeatable';
        }

        if ($this->_data->teasable == '1') {
            if ($postSettings) {
                $postSettings .= '.teasable';
            } else {
                $postSettings .= 'teasable';
            }
        }

        $this->saveRelation($this->_data->categories);
        $this->saveRelation($this->_data->tags, 'post_tag');
        $this->saveRelation($this->_data->person, 'people');

        $this->saveRelation($postSettings, 'post_settings');

        $this->saveField('news_id', $this->_data->id);
        $this->saveField('subtitle', $this->_data->subtitle);

        //var_dump($this->_data);

        // @TODO try to save a given image from url to media library
        if (isset($this->_data->image) && !empty($this->_data->image)) {
            $q = new WP_Query(array(
                'posts_per_page' => 1,
                'post_type' => 'attachment',
                'name' => $this->_data->image
            ));

            if ($q && isset($q->posts[0])) {
                //var_dump('image');
                //var_dump($q->posts[0]);
                set_post_thumbnail($this->_ID, $q->posts[0]->ID);
            }

        }

        return $this->_ID;
    }

}