<?php

class Message_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_all()
    {
        $query = $this->db->order_by('id', 'desc')->get('message');
        return $query->result_array();
    }
    
}