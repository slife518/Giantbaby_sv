<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pc_record extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('Pc_record_model');
     }


     function save_record(){
      log_message('debug', "save_record 시작 ");
      $array = array(
        'baby_id'=>$this->input->post('baby_id'),
        'record_date'=>$this->input->post('record_date'),
        'record_time'=>$this->input->post('record_time'),
        'milk'=>$this->input->post('milk'),
        'rice'=>$this->input->post('rice'),
        'description'=>$this->input->post('description'),
        'author'=>$this->input->post('email')      
      );
      $record_id = $this->Pc_record_model->addRecord($array, $this->input->post('record_id'));
      echo json_encode(array("result"=>$record_id),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);   // 1을 넘기면 true Boolean 으로 넘어간다. 

    }

    function delete_record(){
      log_message('debug', "save_record 시작 ");
      $array = array(        
        'id'=>$this->input->post('record_id')      
      );
      $record_id = $this->Pc_record_model->deleteRecord($array);
      echo json_encode(array("result"=>$record_id),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);   // 1을 넘기면 true Boolean 으로 넘어간다. 

    }
    function get($id)
    {  
        $result = $this->record_model->get($id);     
        log_message('debug',print_r($result,TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
    } 

    function record_list()    // 앱에서 사용 
    {
        //print "<script type=\"text/javascript\">alert('Some text');</script>";
        //$this->_head($this->router->fetch_method());
        $email= $this->input->post('email');
        $result = $this->Pc_record_model->gets($email);
        $chartdata = $this->Pc_record_model->getChartData($email);

        log_message('debug',print_r($chartdata,TRUE));
        echo json_encode(array("chartData"=>$chartdata, "result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
        // echo json_encode(array("chartdata"=>$chartdata),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  

    }

    function chk_relation(){

    }

}
?>
