<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/dao/Dao.php';

class Rental_lib extends Dao {

    function __construct() {

        parent::__construct('rental');
        $this->load->library('User_lib');

    }

    public function getDataByUserId ($id) {
        $res = $this->db->get_where($this->table, ['user_id' => $id]);
    }

    public function getDataByBookId ($id) {
        $res = $this->db->get_where($this->table, ['book_id' => $id]);
    }

    public function getuserIdByRentalId ($id) {
        
        $sql = 'select user_id from rental where rental_id = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }


    public function returnDate ($id) {

        $sql = '';
        $sql .= 'select rented_date ';
        $sql .= 'from rental where rental_id = '.$id.'';

        $res = $this->db->query($sql);

        return $res->result_array();

    }

    public function listRental () {

        $sql = '';
        $sql .= 'select rental_id, user_id, book_id, book_cost, is_returned, rented_date ';
        $sql .= 'from rental';

        $res = $this->db->query($sql);

        return $res->result_array();

    }

    public function updateRental ($id) {

        $v = $this->returnDate($id);
        $retDate = $v[0]['rented_date'];
        $u = $this->getuserIdByRentalId($id);
        $userId = $u[0]['user_id'];

        $x = $this->user_lib->getUserTypeByID($userId);
        $userType = $x[0]['user_type'];

        $currentDate = date('Y-m-d');

        $returnDateO = date_create($retDate);
        $currentDateO = date_create($currentDate);

        $interval = $returnDateO->diff($currentDateO);

        $diffD = $interval->format('%d');
        $diffM = $interval->format('%m');
        $diffY = $interval->format('%y');

        $diff = $diffD + ($diffM * 30) + ($diffY * 365);

        $cash = $this->returnBalance($userType, $diff);

        $this->db->set('is_returned', true);
        $this->db->set('book_cost', $cash);
        $this->db->where('rental_id', $id);
        $this->db->update($this->table);

        /*$sql = '';
        $sql .= 'update rental set is_returned = '.'1'.', book_cost = ''.$cash.' where rental_id = '.$id.';';
        $res = $this->db->query($sql);


        $sql2 = 'update user set balance -= '.$cash.' where user_id = '.$userId.';';

        $res = $this->db->query($sql2);
        */

        $curBalance = $this->user_lib->getUserBalanceByID($userId);
        $curBalanceValue = $curBalance[0]['balance'];

        $finalbalance = $curBalanceValue - $cash;

        $this->db->set('balance', $finalbalance);
        $this->db->where('user_id', $userId);
        $this->db->update('user');

    }

    private function returnBalance($utype, $diff) {

        switch ($utype) {
            case 1:
                return 0;
                break;
            case 2:
                if ($diff >= 22) {
                    return $this->returnCash($diff-21);
                }
                break;
            case 3:
                if ($diff >= 31) {
                    return $this->returnCash($diff-30);
                }
                break;
            case 4:
                if ($diff >= 15) {  
                    return $this->returnCash($diff-14);
                }
                break;
            default:
                return 0;
                break;
        }

    }

    private function returnCash($diff) {
        if ($diff == 0 ) {
            return 0;
        }
        if ($diff > 0 && $diff < 2 ) {
            return 1;
        }
        if ($diff > 1 && $diff < 6 ) {
            return 1.5;
        }
        if ($diff > 5 && $diff < 11 ) {
            return 2.5;
        }
        if ($diff > 10) {
            return 4;
        }
    }

}