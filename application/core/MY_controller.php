<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
    }


    function _head()
    {
      //var_dump($this->session->all_userdata());  //html 을 무시하고 제일 앞에 찍힌다.
      //var_dump($this->session->userdata('session_test'));
      //$this->session->set_userdata('session_test', 'userbane@naver.com');
      //$l_msg = $f_name s. '__실행';
      //log_message('debug', $l_msg);
      if(!$this->session->userdata('is_login'))
      {
        log_message('debug', '로그인이 되어 있지 않습니다. ');
        $this->load->helper('url');
        redirect('/auth/login');
      }

      $this->load->view('record_head');
    }

    function _head_notop()  // 로그인 상태여부는 체크하고 탑메뉴는 안보인다. 
    {
      if(!$this->session->userdata('is_login'))
      {
        log_message('debug', '로그인이 되어 있지 않습니다. ');
        $this->load->helper('url');
        redirect('/auth/login');
      }

      $this->load->view('record_head_nobody');
    }

    function _head_nochk()  //로그인상태여부를 체크하지 않는다. 즉 로그인 하지 않고 조회가능한 화면은 이 헤드를 사용해야 한다.
    {
      $this->load->view('record_head_nobody');
    }


    function _footer()
    {
      $this->load->view('record_footer');
    }

}
