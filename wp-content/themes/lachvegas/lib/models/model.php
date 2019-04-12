<?php


class SModel {

    protected $_ID;
    protected $_data;
    protected $_post_type;


	/**
	 * Model constructor.
	 * @param array $data
	 */
    public function __construct($data = []) {
        $this->set('_data', $data);
    }

	/**
	 * @param $property
	 * @param $value
	 */
    public function set($property, $value) {
        if (isset($value))
            $this->{$property} = $value;
    }

	/**
	 * Retrieve Record by unique import id
	 * @param int $id
	 */
    public function get($id = null) {
        if ($id) {
            get_post([
                'ID' => $id,
                'post_type' => $this->_post_type
            ]);
        }
    }

	/**
	 * @param $categories
	 * @param string $tax
	 */
	public function saveRelation($categories, $tax = 'category') {
		if ($this->_ID) {
			if (stristr($categories, '.')) {
				$categories = explode('.', $categories);
			}
			wp_set_object_terms( $this->_ID, $categories, $tax );
		}
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function saveField($key, $value) {
		if ($this->_ID) {
			update_post_meta($this->_ID, $key, $value);
		}
	}

}