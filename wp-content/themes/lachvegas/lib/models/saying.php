<?php

include_once __DIR__ . '/model.php';

class Saying {

    protected $_ID;
    protected $_data;
    protected $_post_type = 'saying';

    public function __construct($data = []) {
        $this->set('_data', $data);
    }

    /**
     * 
     */
    public function set($property, $value) {
        if (isset($value))
            $this->{$property} = $value;
    }
    
    /**
     * Retrieve Record by id 
     * $id - WordPress Post ID
     */
    public function get($id = null) {
        if ($id) {
            get_post([
                'ID' => $id,
                'post_type' => $this->_post_type
            ]);
        }
    }

    public function save() {

        $arr = [
            'post_date' => date('Y-m-d', strtotime($this->_data['date'])),
            'post_title' => $this->_data['title'],
            'post_content' => $this->_data['description'],
            'post_type' => $this->_post_type,
            'post_status' => 'publish'
        ];

        $p = get_posts(
            array(
            'post_status' => 'any',
            'post_type' => $this->_post_type,
            'meta_query' => array(
                array(
                    'key' => 'saying_id',
                    'value' => $this->_data['id'],
                    'compare' => '=='
                    )
                )
            )
        );

        if (is_array($p)) {
            // check if there is a post with a give job_id already stored
            if (!isset($p[0]->ID)) {
                var_dump('save new');
                $this->_ID = wp_insert_post($arr);
            }
            else {
                var_dump('update old');
                $arr['ID'] = $p[0]->ID;
                $this->_ID = $p[0]->ID;
                wp_update_post($arr);

                update_post_meta($this->_ID, 'import_update', date('Y-m-d H:i:s'));
            }
        }

        $this->saveRelation($this->_data['category']);
        $this->saveField('saying_id', $this->_data['id']);
        //$this->saveField('job_company', $this->_data['company']);

        return $this->_ID;
    }

    public function saveRelation($category) {
        if ($this->_ID) {
            wp_set_object_terms($this->_ID, $category, 'category' );
        }
    }

    public function saveField($key, $value) {
        if ($this->_ID) {
            update_post_meta($this->_ID, $key, $value);
        }
    }

}