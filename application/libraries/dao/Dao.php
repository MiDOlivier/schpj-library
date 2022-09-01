<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/util/CI_Object.php';

class Dao extends CI_Object {

    protected $table = '';

    function __construct ($table) {

        $this->table = $table;

    }

    public function create($data) {
        //
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();

    }

    public function getById($id) {

        $v['id'] = $id;
        $rs = $this->db->get_where($this->table, $v);

        return $rs->row_array();

    }

    
    public function getByUserId($id) {

        $v['id_pessoa'] = $id;
        $rs = $this->db->get_where($this->table, $v);

        return $rs->row_array();

    }

    public function update($data, $condition) {
        $this->db->update($this->table, $data, $condition);
    }

    public function delete($condition) {
        $this->db->delete($this->table, $condition);
    }
    
}