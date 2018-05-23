
    <form action="/index.php/auth/update" method="post">
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
         <button type="submit" class="btn btn-primary">회원정보수정</button>
       </div>
    </form>
