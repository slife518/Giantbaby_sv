<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends My_Controller {
     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('record_model');
     }


     function index()
     {
         $this->_head();
         //
         // $this->load->library('form_validation');
         // $this->form_validation->set_rules('from_date', '시작일자', 'required');
         // $this->form_validation->set_rules('to_date', '종료일자', 'required');
         //
         // if($this->form_validation->run() == FALSE){
         //   $to_date = date("Y-m-d");
         //   $timestamp = strtotime("-7 day", strtotime($to_date));
         //   $from_date = date("Y-m-d", $timestamp);
         // }else{
         //   $from_date = $this->input->post('from_date');
         //   $to_date = $this->input->post('to_date');
         // }
         //
         // $array = array(
         //         'baby_id'=>$this->session->userdata('baby_id'),
         //         'from_date'=>$from_date,
         //         'to_date'=>$to_date
         //   );
         //
         // $result = $this->record_model->getReportInfo($array);
         // $record_date = array(); $milk = array(); $rice = array(); $sum = array();
         //
         // foreach ($result as $key => $value) {
         // //   log_message('debug', print_r($value, TRUE));
         //    array_push($record_date, $value['record_date']);
         //    array_push($milk, $value['milk']);
         //    array_push($rice, $value['rice']);
         //    $lv_sum = $value['milk'] + $value['rice'];
         //    array_push($sum, $lv_sum);
         // }
         //
         // $record['record_date'] =  $record_date;
         // $record['milk'] =  $milk;
         // $record['rice'] =  $rice;
         // $record['sum'] =  $sum;
         //
         // log_message('debug', print_r($record, TRUE));
         // // $this->load->view('report', array('record'=>$record));
         // $this->load->view('report', $record);
         $this->load->view('report');

         $this-> _footer();
     }


     function reportInfo()
     {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('from_date', '시작일자', 'required');
       $this->form_validation->set_rules('to_date', '종료일자', 'required');

       if($this->form_validation->run() == FALSE){
          echo validation_errors();
       }else{
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
       }

       $array = array(
               'baby_id'=>$this->session->userdata('baby_id'),
               'baby_id2'=>$this->session->userdata('baby_id'),
               'from_date'=>$from_date,
               'to_date'=>$to_date
         );

       $result = $this->record_model->getReportInfo($array);
       $record_date = array(); $milk = array(); $rice = array(); $sum = array();

       foreach ($result as $key => $value) {
       //   log_message('debug', print_r($value, TRUE));
          array_push($record_date, $value['record_date']);
          array_push($milk, $value['milk']);
          array_push($rice, $value['rice']);
          $lv_sum = $value['milk'] + $value['rice'];
          array_push($sum, $lv_sum);
       }

       $record['record_date'] =  $record_date;
       $record['milk'] =  $milk;
       $record['rice'] =  $rice;
       $record['sum'] =  $sum;

       echo json_encode($record);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.

     }



     function timeCountInfo()
     {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('from_date', '시작일자', 'required');
       $this->form_validation->set_rules('to_date', '종료일자', 'required');

       if($this->form_validation->run() == FALSE){
          echo validation_errors();
       }else{
         $from_date = $this->input->post('from_date');
         $to_date = $this->input->post('to_date');
       }

       $array = array(
               'baby_id'=>$this->session->userdata('baby_id'),
               'from_date'=>$from_date,
               'to_date'=>$to_date
         );

       $result = $this->record_model->getTimeCount($array);
       $xx = array(); $milk = array(); $rice = array(); $sum = array();

       foreach ($result as $key => $value) {
       //   log_message('debug', print_r($value, TRUE));
          array_push($xx, $value['time']);
          array_push($milk, $value['milk']);
          array_push($rice, $value['rice']);
          $lv_sum = $value['milk'] + $value['rice'];
          array_push($sum, $lv_sum);
       }

       $record['xx'] =  $xx;  //x측 의 값
       $record['milk'] =  $milk;
       $record['rice'] =  $rice;
       $record['sum'] =  $sum;

       echo json_encode($record);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.

     }


}
