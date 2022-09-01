<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/util/CI_Object.php';

class minhas_globais extends CI_Object{

    protected $user_id = 0;
    protected $user_type = 0;

    public function setUserId ($id) {
        $this->user_id = $id;
    }

    public function getUserId () {
        return $this->user_id;
    }

    public function setUserType ($id) {
        $this->user_type = $id;
    }

    public function getUserType () {
        return $this->user_type;
    }

}