<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pc_board extends My_Controller {

     function __construct(){
          parent::__construct();
          $this->load->database();
        //  $this->load->model('pc_baby_model');
          $this->load->library('form_validation');
     }

    function sendAsk(){

              log_message('debug' , 'send_ask 시작' .$toEmail );

              $to= "slife705@naver.com";   //받는 이메일 주소
              $from="자이언트베이비";   //보내는 사람 이름
              $subject=$this->input->post('title');;    //제목

              $body= $this->input->post('contents') . "  보낸 사람 메일주소는 "  .$this->input->post('email');;  // ㄴㅐ용

              $this->sendMail($to, $from, $subject, $body);

              log_message('debug' , 'send_ask 끝 '.$body);

              echo json_encode(array("result"=>"true"),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
              // echo false;

        }

      function sendMail($to, $from, $subject, $body){

          // include "Sendmail.php";
          $this->load->library('Sendmail');
          $sendmail = new Sendmail();
          $sendmail->send_mail($to, $from, $subject, $body);
      }

}
?>
