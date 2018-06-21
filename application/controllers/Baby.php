<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Baby extends My_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('baby_model');
          $this->load->library('form_validation');
     }


     function index($index)
     {

      }

      function registerBaby(){
log_message('debug','register 시작');
log_message('debug',$this->session->userdata('email'));
        $array = array(
              'owner'=>$this->session->userdata('email'),
              'babyname'=>$this->input->post('newbabyname'),
              'birthday'=>$this->input->post('newbirthday'),
              'mother'=>$this->input->post('newmother'),
              'father'=>$this->input->post('newfather'),
              'sex'=>$this->input->post('newsex')
            );
      log_message('debug',print_r($array, TRUE));
         $baby_id = $this->baby_model->registerBaby($array);
         array_merge($array, array('baby_id'=>$baby_id));


         $this->set_babysession($baby_id, $array['birthday'], $array['babyname'] );
         echo json_encode($array);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
      }


      function registerRelation(){  //아기찾기를 통해 등록 한 경우 관계만 넣어준다.
        $array = array(
              'baby_id'=>$this->input->post('baby_id'),
              'email'=>$this->session->userdata('email')
            );

         log_message('debug',print_r($array, TRUE));
         $result = $this->baby_model->registerRelation($array);

         $returnArray = array(
               'baby_id'=>$this->input->post('baby_id'),
               'babyname'=>$this->input->post('babyname'),
               'birthday'=>$this->input->post('birthday'),
               'sex'=>$this->input->post('sex'),
               'mother'=>$this->input->post('mother'),
               'father'=>$this->input->post('father'),
               'owner'=>$this->input->post('owner')
             );

         log_message('debug',print_r($returnArray, TRUE));
         $this->set_babysession($returnArray['baby_id'], $array['birthday'], $array['babyname'] );
         echo json_encode($returnArray);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
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
                'baby_id'=>$this->input->post('baby_id'),
                'email'=>$this->session->userdata('email')
          );
          $result = $this->baby_model->getfollowerlist($array);

          log_message('debug',print_r($result, TRUE));
          echo json_encode($result);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
      }

      function changeApproval($index){

      //  log_message('debug', print_r($this->input->post(), TRUE));
          $array = array(
                'email'=> $this->input->post('email'),
                'baby_id'=>$this->input->post('baby_id'),
                'approval'=> $this->input->post('approval')
          );
        log_message('debug',$array);
          $this->baby_model->changeApproval($array);
          $result = array_merge(array('index'=>$index), array('approval'=> $this->input->post('approval')));

          log_message('debug',print_r($result, TRUE));
          echo json_encode($result);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
      }



      function update()
      {
        log_message('debug', '아기정보수정');
        $this->load->model('baby_model');

      //  $this->load->library('form_validation');

      log_message('debug', '아기이름은 ' . $this->input->post('babyname')  );
        $this->form_validation->set_rules('father', '아빠이름', 'required');
        $this->form_validation->set_rules('mother', '엄마이름', 'required');
        $this->form_validation->set_rules('birthday', '생년월일', 'required');
        $this->form_validation->set_rules('babyname', '아기이름', 'required');
        //var_dump(empty($this->input->post('password')));
      //  log_message('debug', 'afdfsdfsf');
        if($this->form_validation->run() === false)
        {
            log_message('debug', validation_errors())   ;
            $this->_head();
            $this->load->view('member');
            $this->_footer();
        }else
        {
            log_message('debug', '아기정보저장 중')   ;
            log_message('debug', $this->input->post('email'));
              $array = array(
                      'baby_id'=>$this->input->post('baby_id'),
                      'mother'=>$this->input->post('mother'),
                      'father'=>$this->input->post('father'),
                      'babyname'=>$this->input->post('babyname'),
                      'sex'=>$this->input->post('sex'),
                      'birthday'=>$this->input->post('birthday')
                      );
              log_message('debug', print_r($array, 'TRUE'));
              $this->baby_model->update($array);
              // $this->session->set_flashdata('message', '아기정보가 수정되었습니다.');
              $this->set_babysession($array['baby_id'], $array['birthday'], $array['babyname'] );

              echo json_encode('아기정보가 수정되었습니다.');
              // $this->load->helper('url');


            //  redirect('auth/member');
        }
        //
      }



      function findbaby(){
      //  log_message('debug', 'findbaby 시작');
      //  $this->load->library('form_validation');
        $this->form_validation->set_rules('findbabyname', '아기이름', 'required');
        $this->form_validation->set_rules('findmother', '엄마이름', 'required');

        if($this->form_validation->run() == FALSE){
          log_message('debug','유효성 실패');
           echo validation_errors();
        }else{
           log_message('debug','유효성 통과');
          $babyname = $this->input->post('findbabyname');
          $mother = $this->input->post('findmother');
          $father = $this->input->post('findfather');
        //  log_message('debug', $mother);
        }

        $array = array(
                'babyname'=>$babyname,
                'mother'=>$mother
          );

        log_message('debug', print_r($array, TRUE));
        if(!empty($mother)){
          array_merge($array, array('mother'=>$mother));
        }
        if(!empty($father)){
          array_merge($array, array('father'=>$father));
        }

        //log_message('debug', print_r($array));
        //$this->load->model('user_model');
        $result = $this->baby_model->getbabylist($array);

        log_message('debug',print_r($result, TRUE));
        echo json_encode($result);  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.
        //echo $result;  //json 형식으로 보내고 json 을 받아서 화면에서 배열로 세팅한다.

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


      function set_babysession($baby_id, $babybirthday, $babyname){
        $this->session->set_userdata('baby_id', $baby_id);
        $birthday = '20' .substr($babybirthday, 0,2) .'년' .substr($babybirthday, 2,2) .'월' .substr($babybirthday, 4,6) .'일';
        log_message($birthday);
        $this->session->set_userdata('birthday', $birthday);
        $this->session->set_userdata('babyname', $babyname);
      }



}
?>
