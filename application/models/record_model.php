<?php
class Record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets(){
        return $this->db->query("SELECT * FROM aaa_record  ORDER BY record_date DESC, record_time DESC")->result();   //result_array 로도 가능
    }

    function get($record_id){
        return $this->db->get_where('aaa_record', array('id'=>$record_id))->row();
    }

    function add($record_date, $record_time, $milk, $rice){
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('aaa_record',array(
            'record_date'=>$record_date,
            'record_time'=>$record_time,
            'milk'=>$milk,
            'rice'=>$rice
        ));
        return $this->db->insert_id();
    }

    function checkid($id, $password){
      log_message('debug', 'id check start');
      return $this->db->get_where('user', array('id'=>$id, 'password'=>$password))->row();

    }
}

?>
