<?php
class Pc_user_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM user")->result();
    }

    function add($option)
    {
        // $this->db->set('email', $option['email']);
        // $this->db->set('password', $option['password']);
        // $this->db->set('nickname', $option['nickname']);
        // $this->db->set('created', 'NOW()', false);
        $this->db->insert('user', $option);
        log_message('debug', $this->db->last_query());
        $result = $this->db->insert_id();
        return $result;
    }

    function update($option)
    {
      //  $this->db->set('email', $option['email']);
        // $this->db->set('nickname', $option['nickname']);
        // $this->db->set('updated', 'NOW()', false);
        // if(!empty($option['password']))
        // {
        //   $this->db->set('password', $option['password']);
        // }
        $email =  $option['email'];
        unset($option['email']);

        $this->db->set('updated', 'NOW()', false);
        $this->db->where('email',  $email);
        $result = $this->db->update('user', $option);   //update(테이블, 데이터, where)  결과가 1 이면 성공   
        

        log_message('debug', $this->db->last_query());
        log_message('debug', $result);     
        return $result;
    }

    function update_visit($email)
    {
      //  $this->db->set('email', $option['email']);
        // $this->db->set('nickname', $option['nickname']);
        // $this->db->set('updated', 'NOW()', false);
        // if(!empty($option['password']))
        // {
        //   $this->db->set('password', $option['password']);
        // }
       
        $this->db->set('lastvisit', 'NOW()', false);
        $this->db->set('visitcount', 'visitcount + 1', false);
        $this->db->where('email',  $email);
        $result = $this->db->update('user', $option);   //update(테이블, 데이터, where)  결과가 1 이면 성공   
        

        log_message('debug', $this->db->last_query());
        log_message('debug', $result);     
        return $result;
    }

    // function getByEmail($email){
    // //     log_message('debug', 'getByEmail 시작 ');
    // //   $result = $this->db->get_where('user', array('email'=>$email))->row_array();
    // //   log_message('debug', $this->db->last_query());

    // //   return $result;

      
    // //   $userinfo = $this->db->get_where('user', array('email'=>$email))->row_array();
    //   $this->db->select('*');
    //   $this->db->from('baby');
    //   $this->db->join('user', 'baby.baby_id = user.baby_id');
    //   $this->db->where('user.email', $email);
    //   $result = $this->db->get()->row_array();   //->row_array 결과값을 한줄의 array 행태로 리턴 .. 참고 http://codeigniter-kr.org/user_guide_2.1.0/database/results.html
    //   log_message('debug', $this->db->last_query());
    // //   if(empty($babyinfo)){
    // //     log_message('debug','$babyinfo는 비어 있다.');
    // //     $result = $userinfo;
    // //   }else{
    // //   //  log_message('debug',print_r($array2));
    // //     $result = array_merge($userinfo,$babyinfo);   // 두개의 배열을 합치기
    // //   };
      
    //   return $result;

    // }


    function alterpw($pw, $email){
        $update=array('password'=>$pw);
        $where=array('email'=>$email);
        $result=@$this->db->update('user', $update, $where);
      log_message('debug', $this->db->last_query());
      log_message('debug', $result);
        return $result;
    }


    function buyItem($option){
        $this->db->insert('buy', $option);
        log_message('debug', $this->db->last_query());
        $result = $this->db->insert_id();
        return $result;
    }
    
    function getBoardData(){
        $rs = $this->db->query("SELECT * FROM board")->result_array();   

        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($rs, TRUE));
        $data["rs"] = $rs;    
        return $data;  //{"rs":{"id":"1","writer":"관리자","title":"테스트 중입니다. ","content":"동해물과"}"}
    }

  }
