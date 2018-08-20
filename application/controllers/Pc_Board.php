<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pc_Board extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }

      function getBoardData(){
          $result = $this->pc_user_model->getBoardData();
          echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  //{"rs":[{"id":"1","writer":"관리자","title":"테스트 중입니다. ","content":"동해물과"}]"}
      }
}
