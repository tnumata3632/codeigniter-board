<?php

class Message_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->dbutil();
    }
    
    public function get_all()
    {
        $query = $this->db->order_by('id', 'desc')->get('message');
        return $query->result_array();
    }
    
    public function get_csv()
    {
        $query = $this->db->order_by('id', 'desc')->get('message');
        return $this->dbutil->csv_from_result($query);
    }
    
    public function set_message()
    {
        $data = array(
            'view_name' => $this->input->post('view_name'),
            'message' => $this->input->post('message'),
            'post_date' => date("Y-m-d H:i:s"),
        );
        
        return $this->db->insert('message', $data);
    }
    
}