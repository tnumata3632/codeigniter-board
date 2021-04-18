<?php

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        
        date_default_timezone_set('Asia/Tokyo');
    }
    
    public function index()
    {
        $this->load->view('board.php');
    }
    
}