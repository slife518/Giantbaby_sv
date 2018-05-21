<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
     function __construct()
     {
          parent::__construct();

     }
     function login(){
       // echo "로그인페이지";
       $this->_head();
       $this->load->view('login');
       $this->_footer();
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
