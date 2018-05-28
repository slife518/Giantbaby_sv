<div class="modal show modal-fullscreen">
  <div class="modal-dialog">
    <form action="/index.php/auth/register" method="post" class="form-inline">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">회원가입</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label" for="inputEmail">이메일</label>
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="이메일" >
            </div>
            <div class="form-group">
              <label class="control-label" for="nickname">닉네임</label>
              <?php echo form_error('nickname'); ?>
              <input class="form-control" type="text" id="nickname" name="nickname" value="<?php echo set_value('nickname'); ?>"  placeholder="닉네임">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">비밀번호</label>
              <?php echo form_error('password'); ?>
              <input class="form-control" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>"   placeholder="비밀번호">
            </div>
            <div class="form-group">
              <label class="control-label" for="re_password">비밀번호 확인</label>
              <?php echo form_error('re_password'); ?>
              <input class="form-control" type="password" id="re_password" name="re_password" value="<?php echo set_value('re_password'); ?>"   placeholder="비밀번호 확인">
            </div>
            <div class="form-group">
              <p id="error"></p>
            </div>
        </div>
        <div class="modal-footer">
          <a type="button" href="/index.php/auth/login" class="btn btn-primary">취소</a>
          <input type="submit" class="btn btn-primary" value="회원가입" />
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
