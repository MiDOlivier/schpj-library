<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/dao/Dao.php';

class Book_lib extends Dao {

    function __construct() {

        parent::__construct('book');

    }

    public function listBook () {

        $sql = '';
        $sql .= 'select book.book_code, book.book_name, book.book_desc, book.book_cover ';
        $sql .= 'from book';

        $res = $this->db->query($sql);

        return $res->result_array();

    }

    public function getBookByID ($id) {

        $sql = '';
        $sql .= 'select book.book_name, book.book_desc, book.book_cover ';
        $sql .= 'from book ';
        $sql .= 'where book.book_code = '.$id.'';

        $res = $this->db->query($sql);
        return $res->result_array();
    }

}