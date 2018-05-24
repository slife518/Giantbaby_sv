<div class="modal show modal-fullscreen">
  <div class="modal-dialog">
    <form action="/index.php/auth/authentication" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">로그인</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">이메일주소</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력하세요">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">비밀번호</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력하세요">
            </div>
            <div class="form-group">
            <?php
              if($this->session->flashdata('message')){
              ?><?=$this->session->flashdata('message');?>
            <?php  }?>
            </div>
        </div>


        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="로그인">
          <a href="/index.php/auth/register" class="btn btn-default">회원가입</a>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
