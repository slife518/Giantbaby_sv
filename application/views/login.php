<article class="container">
    <div class="page-header">
        <div class="col-md-5 col-md-offset-1 col-xs-5 col-xs-offset-1">
          <h3>로그인</h3>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
    <!-- <form action="/index.php/auth/authentication" method="post"> -->
    <form action="<?php echo base_url("auth/authentication")?>" method="post">
      <div class="form-group">
          <h5><label for="InputEmail">아이디</label></h5><?=form_error('email'); ?>
          <input type="text" class="form-control input-lg" id="email" name="email" placeholder="아이디 입력" value="<?php echo set_value('email'); ?>">
      </div>
      <div class="form-group">
          <h5><label for="inputPassword">비밀번호</label></h5><?=form_error('password'); ?>
          <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호 입력" value="<?php echo set_value('password'); ?>">
      </div>
            <?php
              if($this->session->flashdata('message')){
              ?><?=$this->session->flashdata('message');?>
            <?php  }?>
      <div class="row form-group text-center">
        <a href="<?php echo base_url("auth/register")?>" class="btn btn-default">회원가입 <i class="fa fa-check spaceLeft"></i></a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check spaceLeft"></i> 로그인</button>
      </div>
    </form>

    <br>
    <!-- <div class="col-xs-10 col-xs-offset-1"> -->
        <div class="row form-group text-center">
          <a href="<?=base_url("auth/pwsearch")?>"><h6>아이디찾기</h6></a>
          <a href="<?=base_url("auth/pwsearch")?>"><h6>비밀번호찾기</h6></a>
        </div>
    <!-- </div> -->
  </div>
</article>
