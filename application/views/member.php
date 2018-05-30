
    <!-- <form action="/index.php/auth/update" method="post"> -->
    <form action="<?php echo base_url("auth/update")?>" method="post">
    <div class="main">
      <div class="container tim-container">
        <div class="form-group">
           <label for="exampleInputEmail1">아이디</label>
           <input type="email" class="form-control input-lg" id="email" name="email" value="<?=$userinfo->email?>"  readonly>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">닉네임</label>
            <input type="text" style = "ime-mode : active" class="form-control input-lg" id="nickname" name="nickname" value="<?=$userinfo->nickname?>">
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-5">
              <label class="control-label">아기이름</label>
            </div>
            <div class="col-md-2 col-xs-5">
              <label class="control-label" for="nickname">아기생년월일</label>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-2 col-xs-5">
              <input class="form-control input-lg" type="text" style = "ime-mode : active" id="babyname" name="babyname" placeholder="아기이름" value="<?=$userinfo->babyname?>" >
            </div>
            <div class="col-md-2 col-xs-5">
              <input class="form-control input-lg" type="text" id="birthday" name="birthday"  placeholder="180801" value="<?=$userinfo->birthday?>">
            </div>
          </div>
          <div class="row">
              <div class="col-md-2 col-xs-5">
                  <label for="exampleInputPassword1">비밀번호</label>
              </div>
              <div class="col-md-2 col-xs-5">
                  <label for="re_password">비밀번호 확인</label>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-md-2 col-xs-5">
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호">
              </div>
              <div class="col-md-2 col-xs-5">
                <input type="password" class="form-control input-lg" id="re_password" name="re_password" placeholder="비밀번호 확인">
              </div>
          </div>
          <div class="row">
            <div class="col-sm-3" style="text-align:center;">
                <button type="submit" class="btn btn-primary">회원정보수정</button>
            </div>
          </div>
       </div>
    </div>
    </form>
