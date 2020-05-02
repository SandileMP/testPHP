<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BrowserError extends CI_Controller
{
    public function index()
    {
        $this->load->view('browser_error');
    }
}