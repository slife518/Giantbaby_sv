<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pc_Baby extends My_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_baby_model');
          $this->load->library('form_validation');
     }


    function index($index)
    {

    }

    function get_baby_info(){
      $email = $this->input->post('email');
      log_message('debug', print_r($email, TRUE));      
      $result = $this->pc_baby_model->getbabylist($email);
      log_message('debug',print_r($result,TRUE));
      echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    function get_baby_info_detail(){
      $email = $this->input->post('email');
      $baby_id = $this->input->post('baby_id');
      log_message('debug', $baby_id);      

      $result = $this->pc_baby_model->getbabydetail(array("email"=>$email,"baby_id"=>$baby_id));
      log_message('debug',print_r($result,TRUE));
      echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}
?>
