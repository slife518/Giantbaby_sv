<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pc_Baby extends My_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('pc_baby_model');
          $this->load->library('form_validation');
     }

    function get_baby_info(){
          $email = $this->input->post('email');
          log_message('debug', print_r($email, TRUE));

          $result = $this->db->get_where('baby', array('owner'=>$email))->result_array();

          //$result = $this->pc_baby_model->getbabylist($email);
          log_message('debug',print_r($result,TRUE));
          echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }

        function get_baby_info_detail(){
          $email = $this->input->post('email');
          $baby_id = $this->input->post('baby_id');
          log_message('debug', $baby_id);

          // $result = $this->pc_baby_model->getbabydetail(array("owner"=>$email,"baby_id"=>$baby_id));
          $result = $this->db->get_where('baby', array("owner"=>$email,"baby_id"=>$baby_id))->result_array();

          log_message('debug',print_r($result,TRUE));
          echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }


    function modifyBaby(){

          log_message('debug', 'modifyBaby 시작');
          $baby_id = $this->input->post('baby_id');
          $array = array(
            'owner'=>$this->input->post('owner'),
            'babyname'=>$this->input->post('babyname'),
            'birthday'=>$this->input->post('birthday'),
            'sex'=>$this->input->post('sex')
          );

          if(empty($baby_id)){    //신규등록

            $this->db->insert('baby', $array);
            $baby_id = $this->db->insert_id('baby_id');
            $relationinfo = array('baby_id'=>$baby_id, 'email'=>$array['owner'], 'approval'=>'1'); // 1 : 승인            
            $result = $this->db->insert('relation', $relationinfo);
            $this->db->where('email', $array['owner']);
            $this->db->update('user', array('baby_id'=>$baby_id));  // 성공이면 1 

          }else{    //기존 아기정보 변경 

            $this->db->where('baby_id', $baby_id);
            $result = $this->db->update('baby', $array);  // 성공이면 1 
              
          }

          echo json_encode(array("result"=>$result),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);   // 1을 넘기면 true Boolean 으로 넘어간다.

    }

    function deleteBaby(){
          log_message('debug', 'deleteBaby start');
          $baby_id = $this->input->post('baby_id');
          $email = $this->input->post('email');

          //기록된 정보가 있는 지 확인 하고 기록된 정보가 있으면 삭제 불가 
          $recordCondition = array(
            'baby_id' => $baby_id,
            'author' => $email
          );

          $this->db->where($recordCondition);
          $result = $this->db->count_all_results('record');

          if($result > 0){
            echo json_encode("기록된 정보가 있는 아이는 삭제 할 수 없습니다.",JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);  
            exit;
          }

          $condition = array(
            'baby_id' => $baby_id,
            'email' => $email
          );     

          $this->db->where($condition);
          $result = $this->db->delete('relation');
        
          $babyCondition = array(
            'baby_id' => $baby_id,
            'owner' => $email
          );

          $this->db->where($babyCondition);
          $result = $this->db->delete('baby');
          echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}
?>
