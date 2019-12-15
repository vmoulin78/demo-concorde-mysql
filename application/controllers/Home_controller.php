<?php
defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
    public function index() {
        $this->load->view('Home_index');
    }
}
