<?php

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->helper('html');
        
        date_default_timezone_set('Asia/Tokyo');
    }
    
    public function index()
    {
        $data['message_array'] = $this->message_model->get_all();
        
        $this->load->view('board.php', $data);
    }
    
}