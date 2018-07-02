<?php
class Record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets($email){    //리스트 조회

      // $this->db->select('*');
      // $this->db->from('record');
      // $this->db->join('user', 'record.author = user.email');
      //
      // $result = $this->db->get_where('');
       // var_dump($this->db->last_query());
       // return $result;
        $result =  $this->db->query("SELECT  DATE_FORMAT(a.record_date, '%m-%d') as record_date,
                                             DATE_FORMAT(a.record_time, '%H:%i') as record_time,
                                             milk,rice, description, a.id, b.nickname
                                       FROM record AS a join user AS b on a.author = b.email
                                       WHERE a.baby_id = ( select baby_id
                                                             from relation
                                                            WHERE email = ?)
                                         AND a.author in ( select email
                                                             from relation
                                                            where baby_id = ( select baby_id
                                                                                  from relation
                                                                                 WHERE email = ?)
                                                              and approval = 1 )
                                       ORDER BY record_date DESC, record_time DESC", array($email, $email))->result_array();   //result_array 로도 가능

        log_message('debug',$this->db->last_query());
        return json_encode($result);

    }

    function getReportInfo($option){
      log_message('debug',print_r($option, TRUE));
      $result = $this->db->query("SELECT SUBSTR(record_date,6,5) as record_date, sum(milk) as milk, sum(rice) as rice from record
                                  where baby_id = ?
                                    and author in ( select email from relation where baby_id = ? and approval = 1 )
                                    and record_date BETWEEN ? and ? group by record_date order by record_date", $option)->result_array();
      log_message('debug', $this->db->last_query());

      log_message('debug',print_r($result, TRUE));

      return $result;
    }

    function getTimeCount($option){
      log_message('debug',print_r($option, TRUE));
      $result = $this->db->query("SELECT SUBSTRING(record_time,1, 2) AS time , sum(milk) as milk, sum(rice) as rice FROM `record` where baby_id = ?
      and record_date BETWEEN ? and ? group by time order by time", $option)->result_array();
      log_message('debug', $this->db->last_query());

      log_message('debug',print_r($result, TRUE));

      return $result;
    }

    function get($record_id){   //상세데이터 조회
      return $this->db->query("SELECT id, record_date, DATE_FORMAT(record_time, '%H:%i') as record_time, milk,rice, description
                        FROM record WHERE id = ? ", $record_id )->row();
        // return $this->db->get_where('record', array('id'=>$record_id))->row();
    }

    function add($option){
        $this->db->set('created', 'NOW()', false);
      //  var_dump($option);
        $option['record_time'] = $option['record_time'] .':00';   //시간:분 까지만 받고 있기 때문에 db 입력시 초를 00 으로 넣어준다.
        $this->db->insert('record',$option);
        log_message('debug', $this->db->last_query());
        $result = $this->db->insert_id();
        return $result;
    }

    function update($option)
    {
      $this->db->set('updated', 'NOW()', false);
      $this->db->where('id', $option['id']);
      $this->db->update('record',$option);
    //  var_dump($this->db->last_query());
      log_message('debug', $this->db->last_query());
      return $result;
    }

    function delete($option)
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

    function checkid($id, $password){
      log_message('debug', 'id check start');
      return $this->db->get_where('user', array('id'=>$id, 'password'=>$password))->row();

    }
}

?>
