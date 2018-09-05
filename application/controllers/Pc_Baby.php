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

      $result = $this->pc_baby_model->getbabydetail(array("owner"=>$email,"baby_id"=>$baby_id));
      log_message('debug',print_r($result,TRUE));
      echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }


    function registerBaby(){
      log_message('debug','register 시작');
      log_message('debug',$this->input->post('email'));
              $array = array(
                    'owner'=>$this->input->post('email'),
                    'babyname'=>$this->input->post('babyname'),
                    'birthday'=>$this->input->post('birthday'),
                    'mother'=>$this->input->post('mother'),
                    'father'=>$this->input->post('father'),
                    'sex'=>$this->input->post('sex')
                  );
            log_message('debug',print_r($array, TRUE));
               $baby_id = $this->pc_baby_model->registerBaby($array);
               array_merge($array, array('baby_id'=>$baby_id));
               echo json_encode($array);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
    }


    function update(){
      // $object = json_decode(file_get_contents('php://input', true));
      // $array = json_decode(json_encode($object), True);      
      $array = json_decode(json_encode(json_decode(file_get_contents('php://input', true))), True); //\오프젝트로 반환된 것을 array 로 변환 
      $result = $this->pc_baby_model->update($array);                        
      echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}
?>
