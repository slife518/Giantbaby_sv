<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }



     function index(){
        log_message('debug', 'index 시작');
        $this->authentication();

     }
     function signin()
     {
          log_message('debug', 'authentication  시작');
          log_message('debug', $this->input->post('email'));

          $this->load->model('pc_user_model');
          $user = $this->pc_user_model->getByEmail(array('email'=>$this->input->post('email')));
          //var_dump($user);
          log_message('debug','getByEmail 실행완료');
          if(!function_exists('password_hash'))
          {
              $this->load->helper('password');
          }
           $log = 'email: ' .$user['email'] .' pw: ' .$user['password'];
           log_message('debug',$log);
           
           log_message('debug',$this->input->post('email'));
           log_message('debug',$this->input->post('pw'));
          if( $this->input->post('email') == $user['email'] &&
              password_verify($this->input->post('pw'), $user['password']))
          {   log_message('debug', '로그인 성공');          
            $output = json_encode($user);;   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
            echo $output;
          }else
          {   log_message('debug', '로그인 실패');
            $output = '{"result": "false"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
            echo $output;
          }
      }



}