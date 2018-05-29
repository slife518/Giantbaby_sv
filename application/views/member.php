
    <!-- <form action="/index.php/auth/update" method="post"> -->
    <form action="<?php echo base_url("auth/update")?>" method="post">      
      <div class="container tim-container">
        <div class="form-group">
           <label for="exampleInputEmail1">이메일 주소</label>
           <input type="email" class="form-control" id="email" name="email" value="<?=$userinfo->email?>"  readonly>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">닉네임</label>
            <input type="nickname" class="form-control" id="nickname" name="nickname" value="<?=$userinfo->nickname?>">
          </div>
         <div class="form-group">
           <label for="exampleInputPassword1">비밀번호</label>
           <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호">
         </div>
         <div class="form-group">
           <label for="re_password">비밀번호 확인</label>
           <input type="password" class="form-control" id="re_password" name="re_password" placeholder="비밀번호 확인">
         </div>
         <div class="form-group">
           <label class="control-label">아기이름</label>
           <input class="form-control" type="text" id="babyname" name="babyname" placeholder="아기이름" value="<?=$userinfo->babyname?>" >
         </div>
         <div class="form-group">
           <label class="control-label" for="nickname">아기생년월일</label>
           <input class="form-control" type="text" id="birthday" name="birthday"  placeholder="180801" value="<?=$userinfo->birthday?>">
         </div>

         <button type="submit" class="btn btn-primary center">회원정보수정</button>
       </div>
    </form>
