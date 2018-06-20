  <article class="container">
            <div class="page-header">
                <div class="col-md-5 col-md-offset-1 col-xs-5 col-xs-offset-1">
                <h3>회원가입</h3>
                </div>
            </div>
            <div class="col-sm-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <form action="<?php echo base_url("auth/register")?>" method="post" class="form-inline">
                <!-- <form role="form" action="<?php echo base_url("auth/register")?>" method="post"> -->
                    <div class="form-group">
                        <label for="inputName">성명</label><?=form_error('nickname'); ?>
                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="이름을 입력해 주세요"  value="<?php echo set_value('nickname'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">아이디</label><?=form_error('email'); ?>
                        <input type="text" class="form-control" id="email" name="email" placeholder="자기만의 아이디를 입력해주세요"  value="<?php echo set_value('email'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">비밀번호</label><?=form_error('password'); ?>
                        <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호(4자리 이상)를 입력해주세요"  value="<?php echo set_value('password'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordCheck">비밀번호 확인</label><?=form_error('re_password'); ?>
                        <input type="password" class="form-control" id="re_password" name="re_password" placeholder="비밀번호 확인을 위해 다시한번 입력"  value="<?php echo set_value('re_password'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputMobile">휴대폰번호('-'표시제외)</label><?=form_error('tel'); ?>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="휴대폰번호를 입력해 주세요"  value="<?php echo set_value('tel'); ?>">
                    </div>
                    <!--<div class="form-group">
                        <label for="inputtelNO">사무실 번호</label>
                        <input type="tel" class="form-control" id="inputtelNO" placeholder="사무실번호를 입력해 주세요">
                    </div> -->

                    <!-- <div class="form-group">
                    <label>약관 동의</label>
                    <div data-toggle="buttons">
                    <label class="btn btn-primary active">
                  <span class="fa fa-check"></span>
                    <input id="agree" type="checkbox" autocomplete="off" checked>
                    </label>
                    <a href="#">이용약관</a>에 동의합니다.
                    </div>
                    </div> -->

                    <div class="row form-group text-center">
                        <button type="submit" id="join-submit" class="btn btn-primary">
                            회원가입 <i class="fa fa-check spaceLeft"></i>
                        </button>
                        <a type="button" href="<?php echo base_url("auth/login")?>" class="btn btn-default">
                          <i class="fa fa-times spaceLeft"></i>가입취소</a>
                    </div>
          </form>
      </div>
  </article>
