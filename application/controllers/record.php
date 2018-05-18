<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Record extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('record_model');
    }
     function index()
     {
         $this->_head();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('record_date', '날짜', 'required');
         print "<script type=\"text/javascript\">alert('Some text');</script>";
         if ($this->form_validation->run() == FALSE)
         {
            $this->load->view('record');
         }
         else
         {
            //function add($record_date, $title, $description)
            $record_id = $this->record_model->add($this->input->post('record_date'), $this->input->post('milk'), $this->input->post('rice'));
            $this->load->helper('url');
            redirect('/index.php/record_list');
         }
         $this->_footer();
      }
      function get($id)
      {
          $this->_head();
          $record = $this->records_model->get($id);
          $this->load->view('record_list', array('record'=>$record));
          $this-> _footer();
      }

      function record_list()
      {
          $this->_head();
          $record = $this->records_model->gets();
          $this->load->view('record_list', array('record'=>$record));
          $this-> _footer();
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
