<?php
class Pc_baby_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getfollowerlist($option){
    log_message('debug', "getfollowerlist 시작");
    log_message('debug',print_r($option, TRUE));
      $result =  $this->db->query("SELECT `u`.`email`, `u`.`nickname`, `r`.`approval`, `r`.`level`
                                      FROM `user` as `u`
                                      JOIN `relation` as `r` ON `r`.`email` = `u`.`email`
                                      WHERE `r`.`baby_id` = ? AND u.email in
                                        (SELECT r.email FROM relation AS r JOIN baby as b on r.baby_id = b.baby_id
                                          where r.email != b.owner)", $option['baby_id'])->result_array();

  log_message('debug', $this->db->last_query());
  log_message('debug',print_r($result, TRUE));

      return $result;
    }

    function changeApproval($option){
      log_message('debug', "changeApproval 모델 시작");
      log_message('debug',print_r($option, TRUE));
      $data = array(
                     'baby_id' => $option['baby_id'],
                     'email' => $option['email']
                  );

      $this->db->where($data);
      $result =  $this->db->update('relation', array('approval'=>$option['approval']));
      log_message('debug', $this->db->last_query());
      log_message('debug',print_r($result, TRUE));
      return $result;
    }

    function registerBaby($option){
        $this->db->insert('baby', $option);
        $baby_id = $this->db->insert_id('baby_id');
        $relationinfo = array('baby_id'=>$baby_id, 'email'=>$option['owner'], 'approval'=>'1'); // 1 : 승인
        $result = $this->db->insert('relation', $relationinfo);
        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result, TRUE));
        return $baby_id;


    }

    function registerRelation($option){   //아기찾기를 통해 등록 한 경우 관계만 넣어준다.
        $result = $this->db->replace('relation', $option);
        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result, TRUE));
        return $result;
    }


    function getbabylist($option){
    log_message('debug', "getbabylist 시작");
    log_message('debug',print_r($option, TRUE));
      // $this->db->where($option);
      // $this->db->SELECT('baby_id, babyname, birthday, mother, father');

      $result = $this->db->get_where('baby', array('owner'=>$option))->result_array();

  log_message('debug', $this->db->last_query());
  // log_message('debug',print_r($result, TRUE));

      return $result;
    }

    function getbabydetail($option){
        log_message('debug', "getbabylist 시작");
        log_message('debug',print_r($option, TRUE));
          // $this->db->where($option);
          // $this->db->SELECT('baby_id, babyname, birthday, mother, father');
    
          $result = $this->db->get_where('baby', $option)->result_array();
    
      log_message('debug', $this->db->last_query());
      // log_message('debug',print_r($result, TRUE));
    
          return $result;
        }

        

    function update($option) // 아기 정보 변경
      {
        $id = $option['baby_id'];
        unset($option['baby_id']);
                  $this->db->where('baby_id', $id);
        $result = $this->db->update('baby', $option);  // 성공이면 1 
        return $result;
      }

      function disconnectbaby($option)
      {
      $result = $this->db->delete('relation', $option);   //관계정보를 지운다
      log_message('debug', $result);
      log_message('debug', $this->db->last_query());
      return $result;

      }




  }
