<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('user_model');
     }

     function login()
     {
       //log_message('debug', "로그인페이지시작");
       $this->_head_nochk();
       $this->load->view('login');
       $this->_footer();
     }

     function logout()
     {
       $this->session->sess_destory();
       $this->load->helper('url');
       redirect('/auth/login/');
     }

     function authentication()
     {
          log_message('debug', 'authentication  시작');
          $this->load->model('user_model');
          $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
          //var_dump($user);
          log_message('debug','getByEmail 실행완료');
          if(!function_exists('password_hash'))
          {
              $this->load->helper('password');
          }
          $log = 'email: ' .$user['email'] .' pw: ' .$user['password'];
           log_message('debug',$log);
           // log_message('debug',$user['password']);
           log_message('debug',$this->input->post('email'));
           log_message('debug',$this->input->post('password'));
          if( $this->input->post('email') == $user['email'] &&
              password_verify($this->input->post('password'), $user['password']))
          {
          log_message('debug', '로그인 성공');
          //var_dump($user);
              $this->session->set_userdata('is_login', true);
              $this->session->set_userdata('nickname', $user['nickname']);
              $this->session->set_userdata('email', $user['email']);
              $this->session->set_userdata('baby_id', $user['baby_id']);
              $this->session->set_userdata('birthday', $user['birthday']);
              $this->session->set_userdata('babyname', $user['babyname']);

              //$this->session->set_userdata('password', $user->password']);
              $this->load->helper('url');
              redirect("/record/record_list");
          }else
          {   log_message('debug', '로그인 실패');
              //echo $user;
              //log_message('debug',$user);
              $this->session->set_flashdata('message', '이메일 또는 비밀번호가 잘못되었습니다.');
              $this->load->helper('url');
              redirect('/auth/login');
          }
      }


     function register()
     {
         $this->load->model('user_model');
         $this->_head_nochk();
         $this->load->library('form_validation');

         $this->form_validation->set_rules('email', 'ID', 'required|is_unique[user.email]');
         $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[2]|max_length[20]');
         $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[3]|max_length[30]|matches[re_password]');
         $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');

         if($this->form_validation->run() === false){
             $this->load->view('register');
         }else
         {
             if(!function_exists('password_hash'))
             {
               log_message('debug', 'password_hash 존재하지 않음');
                 $this->load->helper('password');
             }

             $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
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

      function member()
      {
        $log = '회원정보는 email: ' .$this->session->userdata('email');
        log_message('debug', $log);
        $this->load->model('user_model');
        $userinfo = $this->user_model->get($this->session->userdata('email'));
        log_message('debug',print_r($userinfo,TRUE));

        $this->_head();
        $this->load->view('member', array('userinfo' => $userinfo));
        $this->_footer();
      }

      function update()
      {
        log_message('debug', '회원정보수정');
        $this->load->model('user_model');
        $this->_head();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[2]|max_length[20]');
        //var_dump(empty($this->input->post('password')));
      //  log_message('debug', 'afdfsdfsf');
        if($this->form_validation->run() === false)
        {
             $this->load->view('member');
        }else
        {
        //  비밀번호를 수정했을 경우
            if(!empty($this->input->post('password')))
            {
                 $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
                 $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');

                 if(!function_exists('password_hash'))
                 {
                      $this->load->helper('password');
                 }
                $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $array = array(
                      'email'=>$this->input->post('email'),
                      'password'=>$hash,
                      'nickname'=>$this->input->post('nickname'),
                      'baby_id'=>$this->input->post('baby_id'),
                      'babyname'=>$this->input->post('babyname'),
                      'birthday'=>$this->input->post('birthday')
                    );
            }else  //비밀번호를 수정하지 않았을 경우
            {
            log_message('debug', 'email은 ')   ;
            log_message('debug', $this->input->post('email'));
                $array = array(
                      'email'=>$this->input->post('email'),
                      'baby_id'=>$this->input->post('baby_id'),
                      'nickname'=>$this->input->post('nickname'),
                      'babyname'=>$this->input->post('babyname'),
                      'birthday'=>$this->input->post('birthday')
                      );

          }
              $this->user_model->update($array);
              $this->session->set_flashdata('message', '회원정보가 수정되었습니다.');
              $this->load->helper('url');
              redirect('record/index');
        }
        $this->_footer();
      }

      function directlogin($email, $password)
        {
             log_message('debug', '직접 접속함');
             $this->load->model('user_model');
             $user = $this->user_model->getByEmail(array('email'=>$email));
             //var_dump($user);
             log_message('debug','getByEmail 실행완료');
             if(!function_exists('password_hash'))
             {
                 $this->load->helper('password');
             }
             $log = 'email: ' .$user['email'] .' pw: ' .$user['password'];
              log_message('debug',$log);
              // log_message('debug',$user['password']);
              log_message('debug',$email);
              log_message('debug',$password);
             if($email == $user['email'] &&
                 password_verify($password, $user['password']))
             {
             log_message('debug', '로그인 성공');
             //var_dump($user);
                 $this->session->set_userdata('is_login', true);
                 $this->session->set_userdata('nickname', $user['nickname']);
                 $this->session->set_userdata('email', $user['email']);
                 $this->session->set_userdata('baby_id', $user['baby_id']);
                 $this->session->set_userdata('birthday', $user['birthday']);
                 $this->session->set_userdata('babyname', $user['babyname']);

                 //$this->session->set_userdata('password', $user->password']);
                 $this->load->helper('url');
                 redirect("/record/record_list");
             }else
             {   log_message('debug', '로그인 실패');
                 //echo $user;
                 //log_message('debug',$user);
                 $this->session->set_flashdata('message', '이메일 또는 비밀번호가 잘못되었습니다.');
                 $this->load->helper('url');
                 redirect('/auth/login');
             }
         }

}
?>
