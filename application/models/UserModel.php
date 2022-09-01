<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/component/Table.php';
include_once APPPATH.'libraries/util/ButtonGenerator.php';

class UserModel extends CI_Model{

    function __construct () {
        $this->load->library('Book_lib');
        $this->load->library('Stock_lib');
        $this->load->library('User_lib');
    }

    public function verify() {
        if(sizeof($_POST) == 0) return 0;
        $user = $this->input->post('user_name');
        $pass = $this->input->post('pass');

        $k = $this->user_lib->verifyCredentials($user, $pass);
        
        if ($k) {
            $r = $this->user_lib->getSessionData($user, $pass);
            $v = get_object_vars($r[0]);

            setcookie('user_id', 0);
            setcookie('user_type', 0);

            setcookie('user_id', $v['user_id']);
            setcookie('user_type', $v['user_type']);

            redirect(base_url('book'));
        } else return 1;
    }

    public function listAll () {
        $data = $this->user_lib->listUser();

        foreach ($data as $key => $row) {

            $url = base_url('user/manage/');
            $url .= $row['user_id'];
            $delUrl = base_url('user/delete/');
            $delUrl .= $row['user_id'];

            $data[$key]['btn'] = ButtonGenerator::editHandler($url);
            $data[$key]['btn'] .= ButtonGenerator::deleteHandler($delUrl);
        }

        $label = ['', 'Type', 'Name', 'Balance', 'Actions'];
        $table = new Table($data, $label);
        return $table->getHTML();
    }

    public function manageUser ($id = null) {

        $base = base_url();
        $base .= 'user';
        

        if ($id == null) {

            if (sizeof($_POST) == 0) {
                return;
            } else {
    
                $data = $this->readPostData();
    
                $sendOver['user_type'] = $data['user_type'];
                $sendOver['user_name'] = $data['user_name'];
                $sendOver['pass'] = $data['pass'];
                $sendOver['balance'] = $data['balance'];
    
                $insert_id = $this->user_lib->create($sendOver);

                redirect($base);
            }

        } else {

            if (sizeof($_POST) == 0) {
                $data = $this->user_lib->getUserByID($id);
                return $data;
            } else {

                $data = $this->readPostData();
    
                $sendOver['user_type'] = $data['user_type'];
                $sendOver['user_name'] = $data['user_name'];
                $sendOver['pass'] = $data['pass'];
                $sendOver['balance'] = $data['balance'];

                $this->user_lib->update($sendOver, ['user_id' => $id]);

                redirect($base);

            }
        }
    }

    private function readPostData() {

        $data['user_type'] = $this->input->post('user_type');
        $data['user_name'] = $this->input->post('user_name');
        $data['pass'] = $this->input->post('pass');
        $data['balance'] = $this->input->post('balance');

        return $data;

    }

    public function deleteUser ($id) {
        
        $this->user_lib->delete(['user_id' => $id]);

        redirect(base_url('user'));
    }

}