<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/component/Table.php';
include_once APPPATH.'libraries/util/ButtonGenerator.php';

class RentalModel extends CI_Model {

    function __construct () {
        $this->load->library('Book_lib');
        $this->load->library('Stock_lib');
        $this->load->library('User_lib');
        $this->load->library('Rental_lib');
    }

    public function listAll () {
        $data = $this->rental_lib->listRental();

        foreach ($data as $key => $row) {

            if ($data[$key]['is_returned'] == 0) {

            $data[$key]['btn'] = ButtonGenerator::updateHandler($row['rental_id']);

            } else {$data[$key]['btn'] = '<p>Returned</p>';}

        }

        $label = ['Rental Code', 'User ID', 'Book ID', 'Base Cost', 'Is Returned', 'Rent Date', 'Confirm Paid'];
        $table = new Table($data, $label);
        return $table->getHTML();
    }

    public function manageRental ($id = null) {

        $base = base_url();
        $base .= 'rental';

        $errorNotif = base_url();
        $errorNotif .= 'rental/error';
        

        if ($id == null) {

            if (sizeof($_POST) == 0) {
                return;
            } else {
    
                $data = $this->readPostData();

                $rentalValue = $this->user_lib->getRentalsByID($data['user_id']);
                $userType = $this->user_lib->getUserTypeByID($data['user_id']);

                $permit = $this->checkIfLimit($userType[0]['user_type'], $rentalValue[0]['active_rentals']);

                if ($permit == true) {
                
                    $sendBookOver['user_id'] = $data['user_id'];
                    $sendBookOver['book_id'] = $data['book_id'];
        
                    $insert_id = $this->rental_lib->create($sendBookOver);

                    $this->user_lib->updateAddRentals(1, $data['user_id']);

                    redirect($base);

                } else {

                    redirect($errorNotif);

                }
            }

        }
    }

    private function checkIfLimit($type, $value) {

        if ($type == 1) {
            return 1;
        }
        if ($type == 2 && $value < 7) {
            return 1;
        } else return 0;
        if ($type == 3 && $value < 10) {
            return 1;
        } else return 0;
        if ($type == 4 && $value < 14) {
            return 1;
        } else return 0;


    }

    private function readPostData() {

        $data['user_id'] = $this->input->post('user_id');
        $data['book_id'] = $this->input->post('book_id');

        return $data;

    }

    public function update ($id) {
        
        $this->rental_lib->updateRental($id);

        $this->user_lib->updateRemRentals(1, $id);

        redirect(base_url('rental'));
    }

}