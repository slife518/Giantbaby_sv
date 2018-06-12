<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Baby extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('baby_model');
     }


     function index($index)
     {

      }



      function get($id)
      {
        //print "<script type=\"text/javascript\">alert('some_text');</script>";
          $this->_head();
          $record = $this->record_model->get($id);
          $this->load->view('index', array('record'=>$record));
          $this-> _footer();
      }

      function follower_list()
      {
        log_message('debug','follower_list controler 시작');
          $array = array(
                'email'=>$this->session->userdata('email')
          );
          $result = $this->baby_model->getfollowerlist($array);

          log_message('debug',print_r($result, TRUE));
          echo json_encode($result);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
      }

      function changeApproval($requester, $approval){
        log_message('debug','changeApproval 시작' + $data);
          $array = array(
                'email'=>$requester,
                'baby_id'=>$this->session->userdata('baby_id'),
                'approval'=>$approval
          );
        log_message('debug',$array);
          $result = $this->baby_model->changeApproval($array);
          log_message('debug',print_r($result, TRUE));
          echo json_encode($result);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
      }

      function delete($id)
      {
        //print "<script type=\"text/javascript\">alert('some_text');</script>";
        $msg = '삭제쿼리 실행전 ' .$id;
        log_message('debug', $msg);
          $data['id']= $id;
          $record = $this->record_model->delete($data);
          $this->load->helper('url');
          redirect('/record/record_list');
          $this-> _footer();
      }


}
?>
