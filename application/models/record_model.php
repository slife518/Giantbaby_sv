<?php
class Record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets(){
          // $this->db->select('*');
          // $this->db->from('record');
          // $this->db->join('user', 'record.author = user.email');
          // $result = $this->db->get();
          // var_dump($this->db->last_query());
          // return $result;
        return $this->db->query("SELECT * FROM record AS a join user AS b on a.author = b.email ORDER BY record_date DESC, record_time DESC")->result();   //result_array 로도 가능
      //  var_dump($this->db->last_query());
    }

    function get($record_id){
        return $this->db->get_where('record', array('id'=>$record_id))->row();
    }

    function add($option){
        $this->db->set('created', 'NOW()', false);
        var_dump($option);
        $this->db->insert('record',$option);
        $result = $this->db->insert_id();
        return $result;
    }

    function checkid($id, $password){
      log_message('debug', 'id check start');
      return $this->db->get_where('user', array('id'=>$id, 'password'=>$password))->row();

    }
}

?>
