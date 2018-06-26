<article class="container">
          <div class="page-header">
              <div class="col-md-5 col-md-offset-1 col-xs-5 col-xs-offset-1">
                <h3>비밀번호찾기</h3>
              </div>
          </div>
          <div class="col-sm-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
              <form action="<?=base_url("auth/pwsearchsubmit")?>" method="post" class="form-inline">
              <!-- <form role="form" action="<?=base_url("auth/register")?>" method="post"> -->
                  <div class="form-group">
                      <?=form_error('email'); ?>
                      <input type="text" class="form-control" id="email" name="email" placeholder="이메일주소를 입력해 주세요"  value="<?=set_value('email'); ?>">
                  </div>
                  <div class="form-group">
                      <?=form_error('tel'); ?>
                      <input type="text" class="form-control" id="tel" name="tel" placeholder="휴대폰번호('-'표시제외)를 입력해 주세요"  value="<?=set_value('tel'); ?>">
                  </div>
                  <div class="row form-group text-center">
                      <button type="submit" id="join-submit" class="btn btn-primary">
                          비밀번호를 이메일로 전송 <i class="fa fa-check spaceLeft"></i>
                      </button>
                      <a type="button" href="<?=base_url("auth/login")?>" class="btn btn-default">
                      <i class="fa fa-times spaceLeft"></i>취소</a>
                  </div>
                </form>
            </div>
</article>
