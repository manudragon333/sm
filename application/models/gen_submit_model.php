<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gen_submit_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save_form($data, $table) {
        // $this->my_db_lib->save_record($post,$table);
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $this->db->where('id', $id);
            return $this->db->update($table, $data);
        } else {
            return $this->db->insert($table, $data);
        }
    }

}

?>
