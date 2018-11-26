<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }

     function login()
     {
         if(!$this->session->userdata('is_login')){
           log_message('debug', "로그인페이지시작");
           $this->_head_nochk();
           $this->load->view('login');
           $this->_footer();
         }else{
           redirect('/record/record_list');
         }

     }

     function pwsearch()
     {
       //log_message('debug', "로그인페이지시작");
       $this->_head_nochk();
       $this->load->view('pwsearch');
       $this->_footer();
     }

     function logout()
     {
       $this->load->library('session');
       $this->session->sess_destroy();
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
              $birthday = '20' .substr($user['birthday'], 0,2) .'년' .substr($user['birthday'], 2,2) .'월' .substr($user['birthday'], 4,6) .'일';
            //   log_message($birthday);
              $this->session->set_userdata('birthday', $birthday);
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
        // $this->load->library('form_validation');

         $this->form_validation->set_rules('email', '아이디', 'required|is_unique[user.email]');
         $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[2]|max_length[20]');
         $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[4]|max_length[30]|matches[re_password]');
         $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
         $this->form_validation->set_rules('tel', '휴대폰번호', 'required');

         if($this->form_validation->run() === false){
             $this->_head_nochk();
             $this->load->view('register');
             $this->_footer();
         }else
         {
             if(!function_exists('password_hash'))
             {
               log_message('debug', 'password_hash 존재하지 않음');
                 $this->load->helper('password');
             }

             $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
             $data = array(
                           'email'=>$this->input->post('email'),
                           'password'=>$hash,
                           'nickname'=>$this->input->post('nickname'),
                           'tel'=>$this->input->post('tel')
                       );
             log_message('debug', print_r($data,TRUE));
             $this->user_model->add($data);
             $this->session->set_flashdata('message', '회원가입에 성공했습니다.');
             $this->load->helper('url');
             redirect('record/index');
           }
      }

      function member()
      {
        $log = '회원정보는 email: ' .$this->session->userdata('email');
        log_message('debug', $log);
        //$this->load->model('user_model');
        $userinfo = $this->user_model->get($this->session->userdata('email'));
        log_message('debug',print_r($userinfo,TRUE));

        $this->_head_notop();
        $this->load->view('member', array('userinfo' => $userinfo));
        $this->_footer();
      }

      function update()
      {
        log_message('debug', '회원정보수정');
    //    $this->load->model('user_model');
      //  $this->_head();
    //    $this->load->library('form_validation');

        $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('tel', '연락처', 'required|min_length[10]|max_length[11]');
        //var_dump(empty($this->input->post('password')));
      //  log_message('debug', 'afdfsdfsf');
        if($this->form_validation->run() === false)
        {
          //  log_message('debug', validation_errors());
          //  echo validation_errors();
          //   $this->load->view('member');
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
                      'tel'=>$this->input->post('tel')
                    );
            }else  //비밀번호를 수정하지 않았을 경우
            {
            log_message('debug', 'email은 ')   ;
            log_message('debug', $this->input->post('email'));
                $array = array(
                      'email'=>$this->input->post('email'),
                      'nickname'=>$this->input->post('nickname'),
                      'tel'=>$this->input->post('tel')
                      );

          }
              $this->user_model->update($array);
              //$this->session->set_flashdata('message', '회원정보가 수정되었습니다.');
              // echo json_encode($array);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
              echo  json_encode('수정되었습니다.');  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
              // $this->load->helper('url');
            //  redirect('auth/member');
        }
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
                 $birthday = '20' .substr($user['birthday'], 0,2) .'년' .substr($user['birthday'], 2,2) .'월' .substr($user['birthday'], 4,6) .'일';
                 $this->session->set_userdata('birthday', $birthday);
                 $this->session->set_userdata('babyname', $user['babyname']);

                 //$this->session->set_userdata('password', $user->password']);
                 $this->load->helper('url');
                 redirect("/native/record/record_list");
             }else
             {   log_message('debug', '로그인 실패');
                 //echo $user;
                 //log_message('debug',$user);
                 $this->session->set_flashdata('message', '이메일 또는 비밀번호가 잘못되었습니다.');
                 $this->load->helper('url');
                 redirect('/auth/login');
             }
         }



         public function pwsearchsubmit()
        {

                $this->form_validation->set_rules("email", '이메일', 'required|valid_email|callback_email_exists');
                if($this->form_validation->run()==FALSE)
                {

                }else
                { //폼 검증 성공 했을 경우

                    //랜덤 비말번호 12자리 생성
                    $random=$this->_GenerateString(12);

                    log_message('debug', "폼 검증성공");
                    log_message('debug', $random);



                    //비밀 번호 암호화
                    if(!function_exists('password_hash')){
                        $this->load->helper('password');
                    }
                    $hash=password_hash($random, PASSWORD_BCRYPT);
                    $email=$this->input->post('email', true);

                    //암호화된 비밀 번호 데이터베이스 업데이트
                    $this->load->model('user_model');
                    $result=$this->user_model->alterpw($hash, $email);

                    //변경된 비밀번호 이메일로 발송
                if($result){
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from('slife518@gmail.com', 'slife518@gmail.com');
                    $this->email->to($email);
                    $this->email->subject('자이언트 베이비 비밀번호 변경');
                    $html="<h3>변경된 비밀번호 : " .$random . "<h3>";
                    $this->email->message($html);
                    if(!$this->email->send()){
                        echo $this->email->print_debugger();
                        log_message('debug', '이메일전송실패');
                        // alert("이메일 발송에 실패 하였습니다.", "/");
                        $this->session->set_flashdata('message', '이메일 발송에 실패 하였습니다.');
                        exit;
                    }else{
                        log_message('debug', '이메일전송성공');
                        $this->session->set_flashdata('message', '이메일로  전송 했습니다.');
                        // alert("이메일로  전송 했습니다.", "/");
                    }
                }
            }
        }

            //랜덤 문자열 생성
       function _GenerateString($length) {
           $characters = "0123456789";
           $characters .= "abcdefghijklmnopqrstuvwxyz";
           $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
           $string_generated = "";
           $nmr_loops = $length;
           while ($nmr_loops--) {
               $string_generated .= $characters[mt_rand(0, strlen($characters))];
           }
           return $string_generated;
       }



           function email_exists($email)
              {
                 $this->load->database();
                  if($email)
                  {
                      $result=array();
                      $sql="select email from user where email = ?";
                      $query=$this->db->query($sql, array('email'=>$email));
                      $result=@$query->row();

                      if(!$result)
                      {
                          $this->form_validation->set_message('email_exists', $email.' 은 존재하지 않는 이메일입니다.');
                          return FALSE;
                      }else
                      {
                          return TRUE;
                      }

                  }else{
                      return FALSE;
                  }
              }



}
?>
