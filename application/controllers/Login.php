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
           $log = 'email: ' .$user['email'] .' password: ' .$user['password'];
           log_message('debug',$log);

           log_message('debug',$this->input->post('email'));
           log_message('debug',$this->input->post('password'));
          if( $this->input->post('email') == $user['email'] &&
              password_verify($this->input->post('password'), $user['password']))
          {   log_message('debug', '로그인 성공');
            $output = json_encode($user);;   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
            echo $output;
          }else
          {   log_message('debug', '로그인 실패');
            $output = '{"result": "false"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
            echo $output;
          }
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

      function addresspost(){
        $this->load->view('addresspost');
      }


       // 메일인증번호 생성함수
       function _coupon_generator()
       {
           log_message('debug', '_coupon_generator 시작') ;
           $len = 32;
           $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
       
           srand((double)microtime()*1000000);
       
           $i = 0;
           $str ='';
           while(true){
                
                   while ($i < $len) {
                       $num = rand() % strlen($chars);
                       $tmp = substr($chars, $num, 1);
                       $str .= $tmp;
                       $i++;
                   }
                   $str = preg_replace('/([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})/', '\1-\2-\3-\4', $str);
                   //DB에 중복 코드 존재 하는지 확인
                   
                   $sql="select * from user where register_email_code =? " ;
                   $query=$this->db->query($sql, array('0' => $str));
                   if($query->num_rows() ==0)break;
           }             
            
           return $str; 
       }


       function send_auth_email(){
                        
                
                // $config['useragent']        = 'PHPMailer';
                // $config['protocol'] = 'mail';
                // // $config['smtp_host']        = 'ssl://smtp.gmail.com';
                // $config['smtp_host']        = 'mw-002.cafe24.com';
                // $config['smtp_user']        = 'slife705';
                // $config['smtp_pass']        = 'minjuni0801!';
                // $config['mailpath'] = '/usr/sbin/sendmail';
                // $config['charset'] = 'UTF-8';
                // $config['wordwrap'] = TRUE;
                // $config['smtp_port']        = 465;
                // $config['smtp_timeout']     = 30; 

                // $this->email->initialize($config);

                
                $toEmail = 'slife705@naver.com';
                $register_email_code=$this->_coupon_generator();

                log_message('debug', $register_email_code);
                $this->load->library('email');   
                $this->email->from('slife518@gmail.com', 'slife518', 'slife518@gmail.com');
                $this->email->to('slife705@naver.com');
                
                $this->email->subject('이메일 인증');
                
                $emailText="<h2><a href='http://slife705.cafe24.com/index.php/user/register/email_auth?authcode=".$register_email_code."'>이메일 인증</a></h2> "; ;

                $this->email->message($emailText);
                $result=$this->email->send();

                if(!$result){
                    var_dump($result);
                    echo '<br />';
                    echo $this->email->print_debugger();
                    echo '이메일 발송 실패';
                    exit;
                }
            
                alert('회원가입 되었습니다. 로그하려면 이메일 인증이 필요합니다.' , '/'); 
       }

       //이메일 인증
    public function email_auth()
    {
     
        $authcode=$this->input->get('authcode', TRUE);    
        $sql="select * from user  where register_email_code =? and register_auth_code= 0";
        $query=$this->db->query($sql, array('0'=>$authcode));
         
               
        $message['authcode']=$authcode;
        if($query->num_rows() >0){ //인증 대기 상태  코드 존재
   
                $message['message']="인증에 실패 하였습니다."; 
            
               //register_auth_code 를 1 로 업데이트       
                $arrayData=array( 'register_auth_code'=>'1'); 
               $where=array('register_email_code'=>$authcode) ;
               $result=$this->db->update('user', $arrayData, $where);
               
               if($result){
                 $message['message']="인증에 성공 하였습니다.";    
               }else{
                   $message['message']="인증에 실패 하였습니다.";
               }
   
        }else{
           $message['message']="잘못된 접근입니다."; 
        }
       
        $this->load->view('welcome',$message);    
    }


    function testmail(){
        $this->load->library('email');

        $subject = 'This is a test';
        $message = '<p>This message has been sent for testing purposes.</p>';

        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                        <title>' . html_escape($subject) . '</title>
                        <style type="text/css">
                            body {
                                font-family: Arial, Verdana, Helvetica, sans-serif;
                                font-size: 16px;
                            }
                        </style>
                    </head>
                    <body>
                        ' . $message . '
                    </body>
                    </html>';
        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $result = $this->email
            ->from('slife518@gmail.com')
            ->reply_to('slife0@hotmail.com')    // Optional, an account where a human being reads.
            ->to('slife705@naver.com')
            ->subject($subject)
            ->message($body)
            ->send();

        var_dump($result);
        echo '<br />';
        echo $this->email->print_debugger();

        exit;
    }
}

