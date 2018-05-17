<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Records extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('records_model');
    }
     function index(){
       $this->load->view('head');
       $this->load->view('records');
       $this->load->view('footer');
      }
      function get($id){
          $this->load->view('head');
          $topics = $this->records_model->gets();
          $this->load->view('records_list', array('records'=>$records));
          $topic = $this->records_model->get($id);
          $this->load->view('get', array('topic'=>$records));
          $this->load->view('footer');
      }
}
?>
