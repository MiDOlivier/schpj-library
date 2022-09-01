<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/component/Table.php';
include_once APPPATH.'libraries/util/ButtonGenerator.php';

class BookModel extends CI_Model {

    function __construct () {
        $this->load->library('Book_lib');
        $this->load->library('Stock_lib');
    }

    public function listAll () {
        $data = $this->book_lib->listBook();

        foreach ($data as $key => $row) {

            $url = base_url('book/manage/');
            $url .= $row['book_code'];
            $delUrl = base_url('book/delete/');
            $delUrl .= $row['book_code'];

            $data[$key]['btn'] = ButtonGenerator::editHandler($url);
            $data[$key]['btn'] .= ButtonGenerator::deleteHandler($delUrl);
        }

        $label = ['', 'Name', 'Description', 'Cover', 'Actions'];
        $table = new Table($data, $label);
        return $table->getHTML();
    }

    public function manageBook ($id = null) {

        $base = base_url();
        $base .= 'book';
        

        if ($id == null) {

            if (sizeof($_POST) == 0) {
                return;
            } else {
    
                $data = $this->readPostData();
    
                $sendBookOver['book_name'] = $data['book_name'];
                $sendBookOver['book_desc'] = $data['book_desc'];
                $sendBookOver['book_cover'] = $data['book_cover'];
    
                $insert_id = $this->book_lib->create($sendBookOver);
    
                $sendStockOver['book_code'] = $insert_id;
    
                $this->stock_lib->create($sendStockOver);

                redirect($base);
            }

        } else {

            if (sizeof($_POST) == 0) {
                $data = $this->book_lib->getBookByID($id);
                return $data;
            } else {

                $data = $this->readPostData();
    
                $sendBookOver['book_name'] = $data['book_name'];
                $sendBookOver['book_desc'] = $data['book_desc'];
                $sendBookOver['book_cover'] = $data['book_cover'];

                $this->book_lib->update($sendBookOver, ['book_code' => $id]);

                redirect($base);

            }
        }
    }

    private function readPostData() {

        $data['book_name'] = $this->input->post('book_name');
        $data['book_desc'] = $this->input->post('book_desc');
        $data['book_cover'] = $this->input->post('book_cover');

        return $data;

    }

    private function convertToNoID ($data) {
        $return['book_name'] = $data['book_name'];
        $return['book_desc'] = $data['book_desc'];
        $return['book_cover'] = $data['book_cover']; 

        return $return;
    }

    public function deleteBook ($id) {
        
        $this->book_lib->delete(['book_code' => $id]);

        redirect(base_url('book'));
    }

}