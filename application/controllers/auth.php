<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('user_model');
     }
     function login()
     {
       log_message('debug', "로그인페이지시작");
       $this->_head();
       $this->load->view('login');
       $this->_footer();
     }

     function logout(){
       $this->session->sess_destory();
       $this->load->helper('url');
       redirect('/auth/login');
     }

     function authentication(){
          log_message('debug', 'authentication  시작');
          $this->load->model('user_model');
          $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
          log_message('debug','getByEmail 실행완료');
          if(!function_exists('password_hash')){
              $this->load->helper('password');
          }
          if(
              $this->input->post('email') == $user->email &&
              password_verify($this->input->post('password'), $user->password)
          ) {
          log_message('debug', '로그인 성공');
              $this->session->set_userdata('is_login', true);
              $this->load->helper('url');
              redirect("/record/index");
          } else {
            //  echo "불일치";
              $this->session->set_flashdata('message', '로그인에 실패 했습니다.');
              $this->load->helper('url');
              redirect('/auth/login');
          }
      }


     function register(){
         $this->load->model('user_model');
         $this->_head();

         $this->load->library('form_validation');

         $this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[user.email]');
         $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[2]|max_length[20]');
         $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
         $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');

         if($this->form_validation->run() === false){
             $this->load->view('register');
         } else {
             if(!function_exists('password_hash')){
               log_message('debug', 'password_hash 존재하지 않음');
                 $this->load->helper('password');
             }

             $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
             $this->load->model('user_model');
             $this->user_model->add(array(
                 'email'=>$this->input->post('email'),
                 'password'=>$hash,
                 'nickname'=>$this->input->post('nickname')
             ));

                  log_message('debug', 'eeeeee');

             $this->session->set_flashdata('message', '회원가입에 성공했습니다.');
             $this->load->helper('url');
             redirect('record/index');
           }


        $this->_footer();
      }

     function _head()
     {
        $this->load->view('record_head');
     }
     function _footer()
     {
        $this->load->view('record_footer');
     }

}
?>
