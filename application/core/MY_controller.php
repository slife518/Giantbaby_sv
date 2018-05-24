<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
    }


    function _head()
    {
      var_dump($this->session->all_userdata());
      //var_dump($this->session->userdata('session_test'));
      //$this->session->set_userdata('session_test', 'userbane@naver.com');
      //$l_msg = $f_name s. '__실행';
      //log_message('debug', $l_msg);
      $this->load->view('record_head');
    }
    function _footer()
    {
      $this->load->view('record_footer');
    }
}
