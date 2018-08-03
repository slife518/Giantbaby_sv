<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BuyTransation extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }

     function buyItem()
     {
          log_message('debug','buyItem 실행완료');
          log_message('debug',$this->input->post('email'));
          log_message('debug',$this->input->post('buyItem'));

          $data = array(
            'email'=>$this->input->post('email'),            
            'itemCode'=>$this->input->post('itemCode')            
        );
        log_message('debug', print_r($data,TRUE));
        $result = $this->pc_user_model->buyItem($data);  
        if($result==0){
            $output = '{"result": "true"} '; 
            echo $output;
        }else{
            echo $result;
        }

      }

      function getBoardData(){
          $result = $this->pc_user_model->getBoardData();
          echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  //{"rs":[{"id":"1","writer":"관리자","title":"테스트 중입니다. ","content":"동해물과"}]"}               
      }
}