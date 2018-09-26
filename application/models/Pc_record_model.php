<?php
class Pc_record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets($option){
      log_message('debug', "gets 시작");
      log_message('debug',print_r($option, TRUE));
      $result = $this->db->get_where('record', array('baby_id'=>$option))->result_array();
      log_message('debug', $this->db->last_query());
    // log_message('debug',print_r($result, TRUE));
      return $result;
      }
}
?>
