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
    {   $userinfo = $this->db->get_where('user', array('email'=> $email))->row();
        log_message('debug', $this->db->last_query());

        $this->db->select('*');
        $this->db->from('baby');
        $this->db->join('relation', 'baby.baby_id = relation.baby_id');
        $this->db->where('relation.email',  $email);
        $babyinfo = $this->db->get()->row();   //->row_array 결과값을 한줄의 array 행태로 리턴 .. 참고 http://codeigniter-kr.org/user_guide_2.1.0/database/results.html
  log_message('debug', $this->db->last_query());
        if(empty($babyinfo)){
          log_message('debug','$babyinfo는 비어 있다.');
          $result = $userinfo;
        }else{
        //  log_message('debug',print_r($array2));
          $result = (object)array_merge((array)$userinfo,(array)$babyinfo);   // 두개의 배열을 합치기
        };
        return $result;
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
        $this->db->update('user', $option);   //update(테이블, 데이터, where)
        $this->session->set_userdata('nickname', $option['nickname']);

        //아기 관계 등록
        // $array_baby_id = $this->db->query('SELECT baby_id from baby where baby_id = ?', $option['baby_id'])->row_array();
        //$array_user_id = $this->db->query('SELECT user_id from user where email = ?', $option['email'])->row_array();
log_message('debug', $this->db->last_query());

      //  if(is_null($array_baby_id['baby_id'])){
            // 최초 아기등록은 우리아기사랑에서 등록해야 합니다.

    //    }else{  //아기 정보 변경
        //  $this->db->where('baby_id', $option['baby_id']);
          // $this->db->where('email', $option['email']);
          // $result = $this->db->delete('relation');   //관계된 정보를 지우고 다시 등록
          // log_message('debug', $this->db->last_query());
          //
          // $this->db->set('baby_id',$option['baby_id']);
          // $this->db->set('email', $option['email']);
          // $result = $this->db->insert('relation');
          // log_message('debug', $this->db->last_query());

          // $this->db->set('relation', $option['relation']);
          // $this->db->where('baby_id', $array_baby_id['baby_id']);
          // $this->db->where('email', $option['email']);
          // $result = $this->db->update('relation');
          // log_message('debug', $this->db->last_query());

    //    }

        return $result;
    }

    function create($option){
        $array_baby_id = $this->db->query('SELECT a.baby_id from baby as a left outer join relation as b on a.baby_id = b.baby_id where b.email = ?', $option['email'])->row_array();
        //$array_user_id = $this->db->query('SELECT user_id from user where email = ?', $option['email'])->row_array();
        log_message('debug', $this->db->last_query());

        if(is_null($array_baby_id['baby_id'])){
            // 최초 아기 등록
            $this->db->set('babyname', $option['babyname']);
            $this->db->set('birthday', $option['birthday']);
            $this->db->set('mother', $option['mother']);
            $this->db->set('father', $option['father']);
            $result = $this->db->insert('baby');
            $baby_id = $this->db->insert_id();

            log_message('debug', $this->db->last_query());

            $this->db->set('baby_id', $baby_id);
            $this->db->set('email', $option['email']);
            $result = $this->db->insert('relation');
            log_message('debug', $this->db->last_query());

        }else{  //아기 정보 변경
          $this->db->set('babyname', $option['babyname']);
          $this->db->set('birthday', $option['birthday']);
          $this->db->set('mother', $option['mother']);
          $this->db->set('father', $option['father']);
          $this->db->where('baby_id', $array_baby_id['baby_id']);
          $result = $this->db->update('baby');

          log_message('debug', $this->db->last_query());

        }

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

      $userinfo = $this->db->get_where('user', array('email'=>$option['email']))->row_array();
      log_message('debug', $this->db->last_query());

    //  $relationinfo = $this->db->get_where('user', array('email'=>$email))->row_array();
    //  $user_id = $relationinfo['user_id'];
      $this->db->select('*');
      $this->db->from('baby');
      $this->db->join('relation', 'baby.baby_id = relation.baby_id');
      $this->db->where('relation.email', $option['email']);
      $babyinfo = $this->db->get()->row_array();   //->row_array 결과값을 한줄의 array 행태로 리턴 .. 참고 http://codeigniter-kr.org/user_guide_2.1.0/database/results.html
log_message('debug', $this->db->last_query());

      if(empty($babyinfo)){
        log_message('debug','$babyinfo는 비어 있다.');
        $result = $userinfo;
      }else{
      //  log_message('debug',print_r($array2));
        $result = array_merge($userinfo,$babyinfo);   // 두개의 배열을 합치기
      };


      return $result;
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
