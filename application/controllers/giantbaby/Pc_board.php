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
              $from ="자이언트베이비";   //보내는 사람 이름
              //$subject=$this->input->post('title');;    //제목
              $subject= "공동육아 사용자 질문";    //제목

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

      function get_talklist(){
        $email = $this->input->post('email');
        log_message('debug', print_r($email, TRUE));

        $result = $this->db->query('SELECT a.id, a.email, a.title, a.contents, a.eyes, a.talk, a.good ,
                                              CASE WHEN b.email is NOT NULL THEN "true" else "false" END as goodChecked,
                                              IF (date(created) = date(now()),
                                              CASE WHEN ( HOUR(now()) - HOUR(created) ) = 0 THEN "조금전"
                                              ELSE CONCAT((HOUR(now()) - HOUR(created) ) , "시간전") END,
                                              CASE WHEN YEAR(now()) = YEAR(created)  THEN CONCAT(MONTH(created), "월 ", DAY(created) ,"일")
                                              ELSE date(created) END
                                              ) AS createDate
                                      FROM talk as a  LEFT OUTER JOIN ( SELECT id, email FROM gooder WHERE email = ?) as b ON a.id = b.id
                                      ORDER BY created DESC', $email)->result_array();

        // $result = $this->db->get()->result_array();

        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result,TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      }

      function get_talk_detail(){
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        log_message('debug', print_r($email, TRUE));

        $result = $this->db->query('SELECT a.id, a.email, a.title, a.contents, a.eyes, a.talk, a.good ,
                                              CASE WHEN b.email is NOT NULL THEN "true" else "false" END as goodChecked,
                                              IF (date(created) = date(now()),
                                              CASE WHEN ( HOUR(now()) - HOUR(created) ) = 0 THEN "조금전"
                                              ELSE CONCAT((HOUR(now()) - HOUR(created) ) , "시간전") END,
                                              CASE WHEN YEAR(now()) = YEAR(created)  THEN CONCAT(MONTH(created), "월 ", DAY(created) ,"일")
                                              ELSE date(created) END
                                              ) AS createDate
                                      FROM talk as a  LEFT OUTER JOIN ( SELECT id, email FROM gooder WHERE email = ?) as b ON a.id = b.id
                                      WHERE a.id = ?
                                      ORDER BY created DESC', $email, $id)->result_array();

        // $result = $this->db->get()->result_array();

        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result,TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      }

      function add_talk_good(){
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        log_message('debug', print_r($email, TRUE));
        $array = array( 'id' =>  $id, 'email' =>  $email);
        $result = $this->db->insert('gooder', $array);
        $this->db->query(
          'update talk
          set good = good + 1
          WHERE id = ?', $id
        );
        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result,TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      }


      function delete_talk_good(){
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        log_message('debug', print_r($email, TRUE));
        $array = array( 'id' =>  $id, 'email' =>  $email);
        $result = $this->db->delete('gooder', $array);
        $this->db->query(
          'update talk
          set good = good - 1
          WHERE id = ?', $id
        );
        log_message('debug', $this->db->last_query());
        log_message('debug',print_r($result,TRUE));
        echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      }

      function add_reply(){
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $reply_id = $this->input->post('reply_id');
        $reply_level = $this->input->post('reply_level');
        $contents = $this->input->post('$contents');

          if($reply_id == 0){ //신규 댓글
            $this->db->query('update talk set talk = talk + 1 WHERE id = ?', $id ); //댓글카운트 추가하기
            $this->db->query('INSERT INTO talk (`id`, `reply_id`, `reply_level`,`email`,`contents`)
                              VALUES (?, SELECT reply_id + 1 from talk where id = ?, ?, ?, ?)', $id, $id, $reply_level, $email, $contents);
          }else if($reply_id <> 0 && $reply_level == 0) {   //신규 대댓글
            $this->db->query('INSERT INTO talk (`id`, `reply_id`, `reply_level`,`email`,`contents`)
                              VALUES (?, ?, SELECT reply_id + 1 from talk where id = ? and reply_id = ?, ?, ?)', $id, $reply_id, $id, $reply_id, , $email, $contents);
          }else{  //기존댓글 수정
            $this->db->query('REPLACE INTO talk (`id`, `reply_id`, `reply_level`,`email`,`contents`)
                              VALUES (?, ?, ?, ?, ?)', $id, $reply_id, $reply_level, $email, $contents' );
          }

      }
}
?>
