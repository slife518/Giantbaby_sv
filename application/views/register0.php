<form action="<?php echo base_url("auth/register")?>" method="post" class="form-inline">
    <div class="container">
        <div class="row">
          <h4>회원가입</h4>
        </div>
        <div class="row">
            <div class="form-group">
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="아이디" >
            </div>
            <div class="form-group">
              <?php echo form_error('nickname'); ?>
              <input class="form-control" type="text" id="nickname" name="nickname" value="<?php echo set_value('nickname'); ?>"  placeholder="닉네임">
            </div>
            <div class="form-group">
              <?php echo form_error('password'); ?>
              <input class="form-control" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>"   placeholder="비밀번호">
            </div>
            <div class="form-group">
              <?php echo form_error('re_password'); ?>
              <input class="form-control" type="password" id="re_password" name="re_password" value="<?php echo set_value('re_password'); ?>"   placeholder="비밀번호 확인">
            </div>
            <div class="form-group">
              <p id="error"></p>
            </div>
        </div>
        <div class="row">
          <a type="button" href="<?php echo base_url("auth/login")?>" class="btn btn-default"><i class="fas fa-ban"></i>취소</a>
          <button type="submit" class="btn btn-default"><i class="far fa-handshake"></i>회원가입</button>
        </div>
    </div><!-- /.modal-content -->
</form>
