<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/dao/Dao.php';

class Stock_lib extends Dao {

    function __construct() {

        parent::__construct('stock');

    }

}