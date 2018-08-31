<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Baby extends My_Controller {

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
      $result = $this->pc_baby_model->getbabylist($email);
      log_message('debug',print_r($result,TRUE));  
      echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
    }

}
?>
