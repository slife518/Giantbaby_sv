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

    function get($email)
    {
        // $result = $this->db->get_where('user', array('email'=>$option['email']))->row();
        $this->db->where('email', $email);
        $result = $this->db->get('user')->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    function add($option)
    {
        $this->db->set('email', $option['email']);
        $this->db->set('password', $option['password']);
        $this->db->set('nickname', $option['nickname']);
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('user', $data);
        $result = $this->db->insert_id();
        return $result;
    }

    function update($option)
    {
        $this->db->set('email', $option['email']);
        $this->db->set('nickname', $option['nickname']);
        $this->db->set('updated', 'NOW()', false);
        if(!empty($option['password']))
        {
          $this->db->set('password', $option['password']);
        }
        $this->db->where('email',  $option['email']);
        $this->db->update('user', $data);   //update(테이블, 데이터, where)
        $this->session->set_userdata('nickname', $option['nickname']);
        //var_dump($this->db->last_query());
      //  $result = $this->db->update_id();

        return $result;
    }

    function getByEmail($option){
      //log_message('debug', $option );
      $array1 = $this->db->get_where('user', array('email'=>$option['email']))->row();
      $array2 = $this->db->query("select * from 'baby' as a left outer join relation as b on a.baby_id = b.baby_id where b.email = " $option['email']) -> result();
      //log_message('debug', '사용자정보조회');
      //log_message('debug', $this->db->last_query());
      //var_dump($result);
      $result = $array1 + $array2;
      return $result;
    }
  }
