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
      // $array1 = $this->db->get_where('user', array('email'=>$option['email']))->row();
      // $this->db->select('*');
      // $this->db->from('baby');
      // $this->db->join('relation', 'baby.baby_id = relation.baby_id');
      // $this->db->where('relation.email',  $option['email']);
      // $array2 = $this->db->get();
      //
      // select * from user as e left outer join
      // ( select a.baby_id, a.birthday, a.babyname, a.sex, b.email, b.relation from baby as a left outer join relation as b
      //   on a.baby_id = b.baby_id ) as c on e.email = c.email where e.email =


      // $sql = "SELECT e.email, e.password, e.nickname, c.baby_id, c.birthday, c.babyname, c.sex, c.relation from user as e left outer join ( SELECT a.baby_id, a.birthday, a.babyname, a.sex, b.email, b.relation FROM baby AS a LEFT OUTER JOIN relation AS b ON a.baby_id = b.baby_id ) AS c ON e.email = c.email WHERE e.email = ? ";
      // log_message('debug', '조회시작');
      // $result =  $this->db->query($sql, array($option['email']))->result(); ;
      // log_message('debug', $this->db->last_query());
      //   foreach ($result as $entry => $entry) {
      //       log_message('debug', print_r($entry));
      //   }
      // return $result;

      $array1 = $this->db->get_where('user', array('email'=>$option['email']))->row_array();
      log_message('debug', $this->db->last_query());

      $this->db->select('*');
      $this->db->from('baby');
      $this->db->join('relation', 'baby.baby_id = relation.baby_id');
      $this->db->where('relation.email',  $option['email']);
      $array2 = $this->db->get()->row_array();   //->row_array 결과값을 한줄의 array 행태로 리턴 .. 참고 http://codeigniter-kr.org/user_guide_2.1.0/database/results.html

      $results = array_merge($array1,$array2);   // 두개의 배열을 합치기 

      return $results;
      //log_message('debug', $this->db->last_query());
      //$array2 = $this->db->query("select * from baby as a left outer join relation as b on a.baby_id = b.baby_id where b.email = " $option['email']) -> result();
      // log_message('debug', $array1);
      // log_message('debug', $array2);
      // log_message('debug', $this->db->last_query());
      // //var_dump($result);
      // $result = $array1 + $array2;
      // return $result;
    }
  }
