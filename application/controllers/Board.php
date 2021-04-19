<?php

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->helper('html');
        $this->load->helper('form');
        
        date_default_timezone_set('Asia/Tokyo');
    }
    
    public function index()
    {
        // POSTのときは投稿データをDBに登録
        if ($this->input->method() == 'post') {
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('view_name', '表示名', 'required');
            $this->form_validation->set_rules('message', 'ひと言メッセージ', 'required');
            $this->form_validation->set_message('required', '{field}を入力してください。');
            
            if ($this->form_validation->run()) {
                $this->message_model->set_message();
                $this->session->success_message = 'メッセージを書き込みました。';
                $this->session->mark_as_flash('success_message');
                
                // セッション保存
                $this->session->view_name = $this->input->post('view_name');
                
                // 自動リダイレクト
                header('Location: ./');
            } else {
                $data['error_message'] =  $this->form_validation->error_array();
            }
        }
        
        $data['message_array'] = $this->message_model->get_all();
        
        $this->load->view('board.php', $data);
    }
    
}