<?php
class Baby_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getfollowerlist($option){
    log_message('debug', "getbabylist 시작");
    log_message('debug',print_r($option, TRUE));
      // $this->db->where($option);

      $this->db->SELECT('u.email, u.nickname, r.approval, r.level');
      $this->db->from('user as u');
      $this->db->join('relation as r', 'r.email = u.email');
      $this->db->where('u.email', $option['email']);
      $result = $this->db->get()->result_array();
  log_message('debug', $this->db->last_query());
  log_message('debug',print_r($result, TRUE));

      return $result;
    }

    function changeApproval($option){
      log_message('debug', "changeApproval 시작");
      log_message('debug',print_r($option, TRUE));
      $data = array(
                     'baby_id' => $option['baby_id'],
                     'email' => $option['email']
                  );

      $this->db->where($data);
      $this->db->update('relation', array('approval'=>$option['approval']));

    }
  }
