<?php

// 管理ページのログインパスワード
define('PASSWORD', 'adminPassword');

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('url');
        
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
                $data['error_message'] = $this->form_validation->error_array();
            }
        }
        
        $data['message_array'] = $this->message_model->get_all();
        $this->load->view('board.php', $data);
    }
    
    public function admin()
    {
        if ($this->input->method() == 'post') {
            if ($this->input->post('admin_password') == PASSWORD) {
                $this->session->admin_login = 'true';
            } else {
                $data['error_message'][] = 'ログインに失敗しました。';
            }
        }
        
        $data['message_array'] = $this->message_model->get_all();
        $this->load->view('board_admin.php', $data);
    }
    
    public function download()
    {
        $this->load->helper('download');
        
        $limit = null;
        if ($this->input->get('limit') == '10') $limit = 10;
        if ($this->input->get('limit') == '30') $limit = 30;
        
        $data = $this->message_model->get_csv($limit);
        force_download('メッセージデータ.csv', mb_convert_encoding($data, "SJIS"));
    }
}