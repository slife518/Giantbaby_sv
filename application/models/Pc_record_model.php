<?php
class Pc_record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function gets($email){
      log_message('debug', "gets 시작");
      log_message('debug',print_r($option, TRUE));
      $this->db->order_by("record_date", "desc");
      $this->db->order_by("record_time", "desc");
      $result = $this->db->get_where('record', array('baby_id'=>$option))->result_array();

      $result =  $this->db->query("SELECT a.record_date,
                                             a.record_time,
                                             milk,mothermilk, rice, description, a.id, b.nickname as author
                                       FROM record AS a join user AS b on a.author = b.email
                                       WHERE a.baby_id = ( select baby_id
                                                             from user
                                                            WHERE email = ?)
                                         AND a.author in ( select email
                                                             from relation
                                                            where baby_id = ( select baby_id
                                                                                  from user
                                                                                 WHERE email = ?)
                                                              and approval = 1 )
                                       ORDER BY record_date DESC, record_time DESC, a.created DESC", array($email, $email))->result_array();   //result_array 로도 가능

      log_message('debug', $this->db->last_query());
    // log_message('debug',print_r($result, TRUE));
      return $result;
      }


    function getChartData($option){

      log_message('debug',print_r($option, TRUE));
      $result = $this->db->query("SELECT record_date, sum(milk) as milk,sum(mothermilk) as mothermilk, sum(rice) as rice from record
                                  where baby_id = ( select baby_id
                                                             from user
                                                            WHERE email = ?)
                                    group by record_date order by record_date desc", $option)->result_array();
      log_message('debug', $this->db->last_query());
      // log_message('debug',print_r($result, TRUE));
      return $result;

    }

    function addRecord($option, $id){    //신규기록 저장 또는 수정
      $this->db->set('created', 'NOW()', false);
    //  var_dump($option);
      $option['record_time'] = $option['record_time'] .':00';   //시간:분 까지만 받고 있기 때문에 db 입력시 초를 00 으로 넣어준다.

      if(empty($id)){
      $this->db->insert('record',$option);
      $result = $this->db->insert_id();
      }else{
        $this->db->set('updated', 'NOW()', false);
        $this->db->where('id', $id);
        $result = $this->db->update('record',$option);
      }

      log_message('debug', $this->db->last_query());

      return $result;
  }


  function deleteRecord($option)
  {
    //$this->db->set('updated', 'NOW()', false);
    log_message('debug', print_r($option,'TRUE'));
     $this->db->where('id', $option['id']);
     $this->db->delete('record');
    //$this->db->delete('record', $option['id']);
  //  var_dump($this->db->last_query());
    log_message('debug', $this->db->last_query());
    return $result;
  }

}
?>
