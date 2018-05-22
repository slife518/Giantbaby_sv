<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM user")->result();
    }

    function get($option)
    {
        $result = $this->db->get_where('user', array('email'=>$option['email']))->row();
        var_dump($this->db->last_query());
        return $result;
    }

    function add($option)
    {
      log_message('debug', 'aa회원가입정보저장시');
        $this->db->set('email', $option['email']);
        $this->db->set('password', $option['password']);
        $this->db->set('nickname', $option['nickname']);
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('user', $data);

   log_message('debug', 'add_dddddd');
        $result = $this->db->insert_id();
    log_message('debug', 'add_ccecece');
        return $result;
    }

    function getByEmail($option){
      log_message('debug', $option );
      $result = $this->db->get_where('user', array('email'=>$option['email']))->row();
      return $result;
    }
  }
