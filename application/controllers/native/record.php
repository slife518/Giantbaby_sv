<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Record extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('record_model');
     }


     function index($index)
     {
        log_message('debug', 'index 시작');
// 로그인 필요
// 로그인 되어 있지 않으면
        // if(!$this->session->userdata('is_login'))
        // {
        //   log_message('debug', '로그인이 되어 있지 않습니다. ');
        //   $this->load->helper('url');
        //   redirect('/auth/login');
        // }
// 로그인 되어 있으면
        //$authentication = $authentication = $this->config->item('authentication');
        //$lv_id = '[record.php]id는 ' . $authentication['id'];
        //log_message('debug', '로그인되었습니다. ');
        //log_message('debug',$lv_id);
         $this->_native_head();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('record_date', '날짜', 'required');

         if($index > 0){    //리스트에서 상세화면 조회시
           log_message('debug', '리스트에서 상세화면 조회');
             $recordinfo = $this->record_model->get($index);
             $this->load->view('record', array('recordinfo'=>$recordinfo));

         }elseif($this->form_validation->run() == FALSE)  //신규 추가
         {
           log_message('debug', '신규 추가');
            $this->load->view('record');
         }else{
           log_message('debug', '저장 또는 수정');
           $array = array(
                   'baby_id'=>$this->session->userdata('baby_id'),
                   'record_date'=>$this->input->post('record_date'),
                   'record_time'=>$this->input->post('record_time'),
                   'milk'=>$this->input->post('milk'),
                   'rice'=>$this->input->post('rice'),
                   'description'=>$this->input->post('description'),
                   'author'=>$this->session->userdata('email')
             );
          log_message('debug', print_r($array, TRUE));

           if(empty($this->input->post('id')))
           {   //신규 저장
             log_message('debug', '신규 저장');
             $record_id = $this->record_model->add($array);
           }else
           {  //기존 데이터 변경
             log_message('debug', '기존 데이터 변경');
              $array =  array_merge($array, array('id'=>$this->input->post('id')));
               log_message('debug', print_r($array, TRUE));
               unset($array['author']);
               $record_id = $this->record_model->update($array);
           }
           $this->load->helper('url');
           redirect('/native/record/record_list');
         }

         $this->_footer();
      }


      function newRecord()
     {       
         $this->_native_head();
         $this->load->view('record');
         $this->_footer();
      }

      function get($id)
      {
        //print "<script type=\"text/javascript\">alert('some_text');</script>";
          $this->_native_head();
          $record = $this->record_model->get($id);
          $this->load->view('index', array('record'=>$record));
          $this-> _footer();
      }

      function record_list()
      {
         //print "<script type=\"text/javascript\">alert('Some text');</script>";
          //$this->_head($this->router->fetch_method());
          $this->_native_head();
          $record = $this->record_model->gets( array( $this->session->userdata('email')));
          $this->load->view('native/record_list', array('record'=>$record));
          $this-> _footer();
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

      function chk_relation(){

      }

}
?>
