<?php


class SModel {

    protected $_ID;
    protected $_data;
    protected $_post_type = 'saying';

    public function __construct($data = []) {
        $this->set('_data', $data);
    }

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
    
    public function saveRelation($category, $taxonomy = 'category') {
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