<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/dao/Dao.php';

class User_lib extends Dao {

    function __construct() {

        parent::__construct('user');

    }

    public function verifyCredentials($name, $pass) {
        $res = $this->db->get_where($this->table, ['user_name' => $name, 'pass' => $pass]);
        $v = $res->result_array();
        return sizeof($v);
    }

    public function getSessionData($name, $pass) {
        $sql = '';
        $sql .= 'select user_id, user_type ';
        $sql .= 'from user ';
        $sql .= 'where user_name = "'.$name.'" and pass = "'.$pass.'"';
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function getDataById ($id) {
        $res = $this->db->get_where($this->table, ['user_id' => $id]);
    }

    public function listUser () {

        $sql = '';
        $sql .= 'select user_id, user_type, user_name, balance ';
        $sql .= 'from user';

        $res = $this->db->query($sql);

        return $res->result_array();

    }

    public function getUserByID ($id) {

        $sql = '';
        $sql .= 'select user_type, user_name, pass, balance ';
        $sql .= 'from user ';
        $sql .= 'where user_id = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function getRentalsByID ($id) {

        $sql = '';
        $sql .= 'select active_rentals ';
        $sql .= 'from user ';
        $sql .= 'where user_id = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function getUserTypeByID ($id) {

        $sql = '';
        $sql .= 'select user_type ';
        $sql .= 'from user ';
        $sql .= 'where user_id = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function getUserBalanceByID ($id) {

        $sql = '';
        $sql .= 'select balance ';
        $sql .= 'from user ';
        $sql .= 'where user_id = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function updateAddRentals($offset, $id) {

        $rentalsValue = $this->getRentalsByID($id);

        $v = $rentalsValue[0]['active_rentals'] + $offset;

        $this->db->set('active_rentals', $v);
        $this->db->where('user_id', $id);
        $this->db->update('user');


    }

    public function updateRemRentals($offset, $id) {

        $this->load->library('rental_lib');

        $userID = $this->rental_lib->getuserIdByRentalId($id);

        $rentalsValue = $this->getRentalsByID($userID[0]['user_id']);

        $v = $rentalsValue[0]['active_rentals'] - $offset;

        $this->db->set('active_rentals', $v);
        $this->db->where('user_id', $userID[0]['user_id']);
        $this->db->update('user');


    }

}