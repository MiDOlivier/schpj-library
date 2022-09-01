<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model('userModel', 'userModel');

    }
    
    public function index () {

            $v['table'] = $this->userModel->listAll();
            $v['location'] = '<a href="./'.'user'.'/manage"><button type="button" class="btn btn-primary">Add '.'user'.'</button></a>';
            $html = $this->load->view('common/table', $v, true);
            $html .= $this->load->view('common/new', $v, true);
            $this->show($html);

    }

    public function manage($id = null) {
        
            if ($id == null) {

                $this->userModel->manageUser();
                $html = $this->load->view('form/userForm', null, true);
                $this->show($html);

            } else {
                
                $data = $this->userModel->manageUser($id);
                $link = 'form/editUserForm';
                $html = $this->load->view($link, $data[0], true);
                $this->show($html);

            }

    }

    public function delete($id) {

            $location = 'user';
            $v['buttons'] = ButtonGenerator::deleteButton($id, $location);
            $html = $this->load->view('common/confirmDelete', $v, true);
            $this->show($html);
        
    }

    public function confirm($id){

            $this->userModel->deleteUser($id);

    }

    public function logout() {

        setcookie('user_id', 0);
        setcookie('user_type', 0);
        
        redirect(base_url());
        
    }

}