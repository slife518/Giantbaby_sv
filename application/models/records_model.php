<?php
class Records_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets(){
        return $this->db->query("SELECT * FROM records")->result();   //result_array 로도 가능
    }

    function get($record_id){
        return $this->db->get_where('records', array('id'=>$record_id))->row();
    }
    function save($record){
      return $this->db->insert('records', $record);
    }
}

?>
