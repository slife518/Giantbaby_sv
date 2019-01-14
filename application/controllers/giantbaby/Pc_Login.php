<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pc_login extends My_Controller {
     function __construct(){
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_user_model');
          $this->load->library('form_validation');
          // $this->load->library('my_form_validation');   //뭔가 설정이 더 필요한 거 같다..
     }

     function signin(){
        log_message('debug', "로그인페이지시작");
          $email = $this->input->post('email');
          $password = $this->input->post('password');
          $user = $this->db->get_where('user', array('email'=>$email))->row_array();
          if(!function_exists('password_hash')){
              $this->load->helper('password');
          }
           $log = 'email: ' .$user['email'] .' password: ' .$user['password'];
          if( $email == $user['email'] && password_verify($password, $user['password'])){
                $output = json_encode($user);;   //맴버정보
                echo $output;
          }else{
            // $output = '{"result": "false"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
            echo $output;
          }
      }

     function register_Member(){
        log_message('debug', "newMember 호출 ");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', '아이디', 'required|is_unique[user.email]');

        if ($this->form_validation->run() == FALSE){   //DB 조회와 관련된 유효성 체크만 여기서 함.
                log_message('debug', "기존 이메일 존재함. ");
                echo "이미 등록된 이메일이 있습니다.";
                return false;
        }

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
                    'tel'=>$this->input->post('mobile')
                );
        $result = $this->db->insert('user', $data);
        log_message('debug', $this->db->last_query());
        if($result){
            echo $result;

            //메일발송을 실행하면 회원등록 function 이 다시 실행되는 오류가 있어서 일단 메일 인증을 하지 않기로 함.
            // $result = $this->send_auth_email($this->input->post('email'));   //이메일 인증 후 로그인 가능
        }else{
            echo $result;
        }

      }

      function addresspost(){   //우편번호로 주소 찾기
        $this->load->view('addresspost');
      }


      function save_customer_info(){
         $data = array(
                     'email'=>$this->input->post('email'),
                     'nickname'=>$this->input->post('name'),
                     'birthday'=>$this->input->post('birthday'),
                     'address1'=>$this->input->post('address1'),
                     'address2'=>$this->input->post('address2'),
                     'tel'=>$this->input->post('tel')
                 );
         $result = $this->pc_user_model->update($data);
         echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  //결과값 보내기

       }

        function save_customer_pw(){
            // $user = $this->pc_user_model->getByEmail($this->input->post('email'));          // 기존 비밀번호 확인
            $user = $this->db->get_where('user', array('email'=>$this->input->post('email')))->row_array();
            if(!function_exists('password_hash'))
            {
                $this->load->helper('password');
            }
            $log = 'email: ' .$user['email'] .' password: ' .$user['password'];
            log_message('debug',$log);
            log_message('debug', $this->input->post('oldpassword'));
            if( $this->input->post('email') == $user['email'] && password_verify($this->input->post('oldpassword'), $user['password']))
            {  //기준 비밀번호 맞음.
            }else{    //기준비밀번호 맞지 않음.

                $result = array("result"=>"기존 비밀번호가 맞지 않습니다.");
                echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                exit;
            }
            $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $data = array(
                        'email'=>$this->input->post('email'),
                        'password'=>$hash
                    );
            $result = $this->pc_user_model->update($data);
            echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  //결과값 보내기
        }

       function select_customer_info()  //고객정보 조회
       {

         $email = $this->input->post('email');
         $result = $this->db->get_where('user', array('email'=>$email))->row_array();
         // $result = $this->pc_user_model->getByEmail($email);
         log_message('debug',print_r($result,TRUE));

         echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

       }


       // 메일인증번호 생성함수
       function _coupon_generator(){
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




       function send_auth_email($toEmail){   //가입인증메일 보내기

                 //    $toEmail = $this->input->post('email');
                // $toEmail = "slife705@naver.com";

                $register_email_code=$this->_coupon_generator();   //이메일 인증키 생성하기

                //이메일 인증키 업데이트 하기
                $arrayData=array( 'register_email_code'=>$register_email_code);
                $where=array('email'=>$toEmail) ;
                $result=$this->db->update('user', $arrayData, $where);

                if(!$result){  //인증키 업데이트 실패스
                    echo '이메일인증 메일 발송 실패';
                    exit;
                }

                //운영
                //$emailText="<h2><a href='http://slife705.cafe24.com/index.php/pc_login/email_auth?email=".$toEmail."authcode=".$register_email_code."'>이메일 인증을 위해 여기를 클릭바랍니다.</a></h2> ";

                //개발
                $emailText="<h2><a href='http://localhost/dev.php/pc_login/email_auth?email=".$toEmail."&authcode=".$register_email_code."'>이메일 인증을 위해 여기를 클릭바랍니다.</a></h2> "; ;

                $to=$toEmail;   //받는 이메일 주소
                $from="자이언트베이비";   //보내는 사람 이름
                $subject="이메일인증";    //제목
                $body=$emailText;    //내용

                $result = $this->sendmail($to, $from, $subject, $body);


                return $result;
                // if(!$result){
                //     var_dump($result);
                //     echo '<br />';
                //     echo $this->email->print_debugger();
                //     echo '이메일 발송 실패';
                //     exit;
                // }

                // alert('회원가입을 축하드립니다. 로그인하려면 이메일 인증이 필요합니다.' , '/');
       }

       //이메일 인증
    public function email_auth(){

        $email=$this->input->get('email', TRUE);
        $authcode=$this->input->get('authcode', TRUE);
        $sql="select * from user  where email = ? and register_email_code =? and register_auth_code= 0";
        $query=$this->db->query($sql, array('0'=>$email, '1'=>$authcode));
        log_message('debug', $this->db->last_query());


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

       echo "true";
    }


    function sendmail($to, $from, $subject, $body){

        // include "Sendmail.php";
        $this->load->library('Sendmail');

        $sendmail = new Sendmail();

        // $to="slife705@naver.com";   //받는 이메일 주소
        // $from="신용협동조합";   //보내는 사람 이름
        // $subject="테스트메일발송";    //제목
        // $body="첨부파일이 추가되었습니다.";    //내용
        $cc_mail="";   //참조
        $bcc_mail="";  //참조

        $result = $sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail);

        log_message('debug', $result);
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);


    }

    function find_user(){
        log_message('debug' , 'find_user 시작');
        $email = $this->input->post('email');
        $tel = $this->input->post('tel');
        log_message('debug', $email);
        log_message('debug', $$tel);
        if(!empty($email)){
            $result = $this->db->get_where('user', array('email'=>$email))->result_array();
        }else{
            $result = $this->db->get_where('user', array('tel'=>$tel))->result_array();
        }

        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result, TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        // echo json_encode(array("result"=>$result));   // 1을 넘기면 true Boolean 으로 넘어간다.


    }

    function send_mail_pw(){

        $toEmail = $this->input->post('email');

        log_message('debug' , 'send_mail_pw 시작' .$toEmail );


        $new_password = 't12345!';
        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        $data = array('password'=>$hash);

        $this->db->set('updated', 'NOW()', false);
        $this->db->where('email',  $toEmail);
        $result = $this->db->update('user', $data);   //update(테이블, 데이터, where)  결과가 1 이면 성공
        $emailText="<h2>비밀번호가 " . $new_password . " 로 초기화 되었습니다.</h2> ";

        $to=$toEmail;   //받는 이메일 주소
        $from="자이언트베이비";   //보내는 사람 이름
        $subject="비밀번호초기화";    //제목
        $body=$emailText;    //내용


        $result = $this->sendmail($to, $from, $subject, $body);

        log_message('debug' , 'send_mail_pw 끝 '  . $result);

        echo json_encode(array("result"=>"true"),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        // echo false;


    }
}
