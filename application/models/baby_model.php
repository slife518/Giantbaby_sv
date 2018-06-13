<?php
class Baby_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getfollowerlist($option){
    log_message('debug', "getbabylist 시작");
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
      log_message('debug', "changeApproval 시작");
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

    function registerbaby($option){
        $this->db->insert('baby', $option);
        $baby_id = $this->db->insert_id('baby_id');
        $relationinfo = array('baby_id'=>$baby_id, 'email'=>$option['owner'], 'approval'=>'1'); // 1 : 승인
        $result = $this->db->insert('relation', $relationinfo);
        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result, TRUE));
        return $baby_id;


    }
  }
