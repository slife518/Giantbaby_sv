<?php
class Record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets($email){

      // $this->db->select('*');
      // $this->db->from('record');
      // $this->db->join('user', 'record.author = user.email');
      //
      // $result = $this->db->get_where('');
       // var_dump($this->db->last_query());
       // return $result;
        $result =  $this->db->query("SELECT  DATE_FORMAT(a.record_date, '%m-%d') as record_date, DATE_FORMAT(a.record_time, '%H:%i') as record_time, milk,rice, description, a.id, b.nickname
                FROM record AS a join user AS b on a.author = b.email WHERE a.baby_id =
              ( select baby_id from relation WHERE email = ?)
                ORDER BY record_date DESC, record_time DESC", $email)->result_array();   //result_array 로도 가능

        return json_encode($result);
      //  var_dump($this->db->last_query());
    }

    function get($record_id){
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
