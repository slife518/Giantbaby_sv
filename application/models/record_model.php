<?php
class Record_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function gets(){
        return $this->db->query("SELECT * FROM aaa_record")->result();   //result_array 로도 가능
    }

    function get($record_id){
        return $this->db->get_where('aaa_record', array('id'=>$record_id))->row();
    }

    function add($record_date, $title, $description){
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('aaa_record',array(
            'record_date'=>$record_date,
            'milk'=>$milk,
            'rice'=>$rice
        ));
        return $this->db->insert_id();
    }
}

?>