<div class="modal show modal-fullscreen">
  <div class="modal-dialog">
    <!-- <form action="/index.php/auth/authentication" method="post"> -->
    <form action="<?php echo base_url("auth/authentication")?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">로그인</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control input-lg" id="email" name="email" placeholder="아이디를 입력하세요">
            </div>
            <div class="form-group">              
              <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호를 입력하세요">
            </div>
            <div class="form-group">
            <?php
              if($this->session->flashdata('message')){
              ?><?=$this->session->flashdata('message');?>
            <?php  }?>
            </div>
        </div>


        <div class="modal-footer">
          <a href="<?php echo base_url("auth/register")?>" class="btn btn-default">회원가입</a>
          <input type="submit" class="btn btn-primary" value="로그인">
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
