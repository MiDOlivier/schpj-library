<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends MY_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model('bookModel', 'bookModel');

    }
    
    public function index () {

            $v['table'] = $this->bookModel->listAll();
            $v['location'] = '<a href="./'.'book'.'/manage"><button type="button" class="btn btn-primary">Add '.'Book'.'</button></a>';
            $html = $this->load->view('common/table', $v, true);
            $html .= $this->load->view('common/new', $v, true);
            $this->show($html);

    }

    public function manage($id = null) {
        
            if ($id == null) {

                $this->bookModel->manageBook();
                $html = $this->load->view('form/bookForm', null, true);
                $this->show($html);

            } else {
                
                $data = $this->bookModel->manageBook($id);
                $link = 'form/editBookForm';
                $html = $this->load->view($link, $data[0], true);
                $this->show($html);

            }

    }

    public function delete($id) {

            $location = 'book';
            $v['buttons'] = ButtonGenerator::deleteButton($id, $location);
            $html = $this->load->view('common/confirmDelete', $v, true);
            $this->show($html);
        
    }

    public function confirm($id){

            $this->bookModel->deleteBook($id);

    }

}