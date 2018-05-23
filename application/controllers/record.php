<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Record extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('record_model');
     }
     function index()
     {
        log_message('debug', 'index 시작');
// 로그인 필요
// 로그인 되어 있지 않으면
        if(!$this->session->userdata('is_login'))
        {
          log_message('debug', '로그인이 되어 있지 않습니다. ');
          $this->load->helper('url');
          redirect('/auth/login');
        }
// 로그인 되어 있으면
        //$authentication = $authentication = $this->config->item('authentication');
        //$lv_id = '[record.php]id는 ' . $authentication['id'];
        //log_message('debug', '로그인되었습니다. ');
        //log_message('debug',$lv_id);
         $this->_head();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('record_date', '날짜', 'required');
         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view('record');
         }
         else
         {
            // print "<script type=\"text/javascript\">alert('Some text');</script>";
            $record_id = $this->record_model->add($this->input->post('record_date'), $this->input->post('record_time'),  $this->input->post('milk'), $this->input->post('rice'));
            $this->load->helper('url');
            redirect('/record/record_list');
         }
         $this->_footer();
      }
      function get($id)
      {
        //print "<script type=\"text/javascript\">alert('some_text');</script>";
          $this->_head();
          $record = $this->record_model->get($id);
          $this->load->view('index', array('record'=>$record));
          $this-> _footer();
      }

      function record_list()
      {
         //print "<script type=\"text/javascript\">alert('Some text');</script>";
          //$this->_head($this->router->fetch_method());
          $this->_head();
          $record = $this->record_model->gets();
          $this->load->view('record_list', array('record'=>$record));
          $this-> _footer();
      }

}
?>
