<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index() {
		$this->load->model('userModel', 'login');
        $v['error'] = $this->login->verify();
        
        $html = $this->load->view('form/loginForm', $v, true);
        $this->show($html, false);
    }

}
