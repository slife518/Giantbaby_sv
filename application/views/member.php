
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
            <div class="col-md-4 col-xs-4">
              <label class="control-label">아기이름</label>
            </div>
            <div class="col-md-4 col-xs-4">
              <label class="control-label" for="nickname">아기생년월일</label>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-4 col-xs-4">
              <input class="form-control input-lg" type="text" style = "ime-mode : active" id="babyname" name="babyname" placeholder="아기이름" value="<?=$userinfo->babyname?>" >
            </div>
            <div class="col-md-4 col-xs-4">
              <input class="form-control input-lg" type="text" id="birthday" name="birthday"  placeholder="180801" value="<?=$userinfo->birthday?>">
            </div>
            <div class="col-md-4 col-xs-4">
              <input type="button" name="findbaby" id="findbaby" class="btn btn-warning"  data-toggle="modal" data-target="#findbabyModal" value="찾기">
            </div>
          </div>
          <div class="row">
              <div class="col-md-4 col-xs-4">
                  <label for="exampleInputPassword1">비밀번호</label>
              </div>
              <div class="col-md-4 col-xs-4">
                  <label for="re_password">비밀번호 확인</label>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-md-4 col-xs-4">
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호">
              </div>
              <div class="col-md-4 col-xs-5">
                <input type="password" class="form-control input-lg" id="re_password" name="re_password" placeholder="비밀번호 확인">
              </div>
          </div>
          <div class="row">
            <div class="col-sm-3" style="text-align:center;">
                <button id="save" name="save" class="btn btn-primary">회원정보수정</button>
            </div>
          </div>
       </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="findbabyModal" tabindex="-1" role="dialog" aria-labelledby="findbabyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="findbabyModal">우리아기 찾기</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <label>아기이름</label>
              </div>
              <div class="col-md-4 col-xs-4">
                <label>엄마이름</label>
              </div>

            </div>
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="findbabyname" name="findbabyname">
              </div>
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="findmother" name="findmother">
              </div>
            </div>
            <input type="button" class="btn btn-primary pull-right" name="search" id="search" value="검색">
          </div>
          <div class="modal-footer">
            <div>
              <table class="table" id="baby_list" data-row-style="rowStyle"></table>
            </div>

          </div>
        </div>
      </div>
    </div>


    </form>

    <script>


				function ajaxExecute(){
					$.ajax({
							 url:'<?=base_url("auth/findbaby")?>',
							 method: 'post',
							 data: $('form').serialize(),
							 dataType: 'json',
							 success: function(response){
                 console.log(response);
										 var babyinfo = response;
                     console.log(babyinfo);

										 search(babyinfo);
							 }
					 });
				}

				$('#search').on("click", function(e){
			     ajaxExecute()
				});

    var data;

    function search(babyinfo){
      data = babyinfo;
      $('#baby_list').bootstrapTable('resetView');
    }



    $('#baby_list').bootstrapTable({
      data: data,
      // striped: true,
      pagination: true,
      pageSize: 10,
      paginationVAlign :'bottom',
      paginationHAlign: 'right',
      clickToSelect: true,
      // showRefresh:true,
      onClickRow: function (row, element, field) {
        // row: the record corresponding to the clicked row,
        // $element: the tr element,
        // field: the field name corresponding to the clicked cell.
        //var url = "<?php echo base_url("record/index/")?>" + row.id ;
            console.log(element);
        location.href = url;
         },
      columns: [{
          field: 'babyname',
          title: '아기이름',
          //'class': 'w100'
      }, {
          field: 'birthday',
          title: '아기생년월일'
          // 'class': 'w100',
            // 'class': 'col-xs-3 .col-md-2'
      }, {
          field: 'mother',
          title: '엄마이름'
          // 'class': 'w100',
          // 'class': 'col-xs-2 .col-md-2'
      }, {
          field: 'father',
          title: '아빠이름'
          // 'class': 'w100',
          // 'class': 'col-xs-3 .col-md-2'
      }, {
          field: 'baby_id',
          visible:false
      }]
    });

    $('#save').on("click",function(){
      location.href="<?php echo base_url("auth/update")?>";
    });

    </script>
