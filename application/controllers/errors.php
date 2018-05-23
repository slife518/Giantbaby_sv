<?php
class Errors extends My_Controller {
    public function notfound(){
        $this->load->view('head');
        $this->load->view('errors/404');
        $this->load->view('footer');
    }
}
