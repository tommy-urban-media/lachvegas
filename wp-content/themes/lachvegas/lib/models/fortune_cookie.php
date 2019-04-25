<?php

include_once __DIR__ . '/model.php';

class FortuneCookie extends SModel {

    protected $_ID;
    protected $_data;
    protected $_post_type = 'fortune_cookie';

    protected $_scheme = [
        'id' => 'ID',
        'title' => 'post_title'
    ];

    public function __construct($data = []) {
    	parent::__construct($data);

        if (!isset($this->_data->date)) {
            $this->_data->date = date('Y-m-d');
        }
    }

    public function save() {

        $arr = [
            'post_date' => date('Y-m-d', strtotime($this->_data->date)),
            'post_title' => $this->_data->title,
            'post_content' => $this->_data->title,
            'post_type' => $this->_post_type,
            'post_status' => 'publish'
        ];

        $p = get_posts(
            array(
				'post_status' => 'any',
				'post_type' => $this->_post_type,
				'meta_query' => array(
                	array(
						'key' => 'import_id',
						'value' => $this->_data->id,
						'compare' => '=='
                    )
                )
            )
        );

        if (is_array($p)) {
            // check if there is a post with a give job_id already stored
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

        $this->saveRelation($this->_data->categories, 'fortune_cookie_categories');
        $this->saveRelation($this->_data->tags, 'post_tag');
        $this->saveField('job_id', $this->_data->id);

        return $this->_ID;
    }

}