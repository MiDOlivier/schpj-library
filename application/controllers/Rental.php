<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends MY_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model('rentalModel');

    }
    
    public function index () {

            $v['table'] = $this->rentalModel->listAll();
            $v['location'] = '<a href="./'.'rental'.'/manage"><button type="button" class="btn btn-primary">Add '.'Rental'.'</button></a>';
            $html = $this->load->view('common/table', $v, true);
            $html .= $this->load->view('common/new', $v, true);
            $this->show($html);

    }

    public function manage() {
        
                $this->rentalModel->manageRental();
                $html = $this->load->view('form/RentalForm', null, true);
                $this->show($html);

    }

    public function update($id){

            $this->rentalModel->update($id);

    }

    public function error() {
            $html = $this->load->view('common/error', null, true);
            $this->show($html);
    }

}