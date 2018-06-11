<?php
class Baby_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getbabylist($option){
    //  log_message('debug', "getbabylist 시작");
    //  log_message('debug',print_r($option, TRUE));
      // $this->db->where($option);

      $this->db->SELECT('u.email, u.name, r.approval, r.authority');
      $this->db->from('user as u');
      $this->db->join('relation as r', 'r.email = u.email');
      $this->db->where('u.email', $option['email']);
      $result = $this->db->get()->result_array();
  log_message('debug', $this->db->last_query());
  log_message('debug',print_r($result, TRUE));

      return $result;
    }
  }
