<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Board extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }

     function getBoardData()
     {
          log_message('debug', 'getBoardData  시작');
          $this->load->model('pc_user_model');
          $data = $this->pc_user_model->getBoardData();
          //var_dump($user);
          log_message('debug','getBoardData 실행완료');

          $output = json_encode($data);;
          echo $output;
      }





     function newMember()
     {
         $this->load->model('user_model');
        // $this->load->library('form_validation');

        $this->form_validation->set_rules('email', '아이디', 'required|is_unique[user.email]');
        $this->form_validation->set_rules('name', '이름', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[4]|max_length[30]|matches[re_password]');
        $this->form_validation->set_rules('repassword', '비밀번호 확인', 'required');
        $this->form_validation->set_rules('mobile', '휴대폰번호', 'required');

        if(!function_exists('password_hash'))
        {
        log_message('debug', 'password_hash 존재하지 않음');
            $this->load->helper('password');
        }

        $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $data = array(
                    'email'=>$this->input->post('email'),
                    'password'=>$hash,
                    'nickname'=>$this->input->post('name'),
                    'address1'=>$this->input->post('address'),
                    'tel'=>$this->input->post('mobile')
                );
        log_message('debug', print_r($data,TRUE));
        $result = $this->user_model->add($data);

        log_message('debug', $result);
        if($result==0){
            $output = '{"result": "true"} ';
            echo $output;
        }else{
            echo $result;
        }

      }

}
