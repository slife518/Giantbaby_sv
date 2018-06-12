
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
          <div>
            <input type="hidden" id="baby_id" name="baby_id"  value="<?=$userinfo->baby_id?>"/>
          </div>
       </div>

       <div class="container bs-docs-container">
        <div class="row">
          <div class="col-md-9" role="main">

            <div class="bs-docs-section">
              <h1 id="js-overview" class="page-header">Baby info</h1>
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


            <div class="bs-docs-section">
              <h1 id="js-overview" class="page-header">Followers</h1>
            </div>
            <div>
              <table class="table" id="follower_list" data-row-style="rowStyle"></table>
            </div>
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

    <?php

    if($this->session->flashdata('message')) {
    $message = $this->session->flashdata('message');
    ?>
    <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

    </div>
    <?php
    }

    ?>

    </form>

<script>
$( function(){

		init();

		function init(){

      var url = '<?=base_url("baby/follower_list")?>';
      var data = $('form').serialize();
      var callBack = reload;
      var errorMsg = "follower_list";
    //   url, data, callBack, errorMsg
      ajaxExecute(url, data, callBack, errorMsg);


      // $.ajax({
      //      url:'<?=base_url("baby/follower_list")?>',
      //      method: 'post',
      //      data: $('form').serialize(),
      //      //dataType: 'json',
      //      success: function(response){
      //            var data = JSON.parse(unescape(replaceAll(response, "\\", "%")));  //유니코드를 한글로 변경
      //            console.log(data);
      //           $('#follower_list').bootstrapTable('load', data);   //데이터 reload
      //
      //      },
      //      error: function(error){
      //        console.log(error);
      //      },
      //      complete:function(){
      //      }
      //
      //  });

    }

    function reload(data){
       $('#follower_list').bootstrapTable('load', data);
    }


//아기찾기 검색
    $('#search').on("click", function(e){
      var url = '<?=base_url("auth/findbaby")?>';
      var data = $('form').serialize();
      var callBack =  search;
      var errorMsg = "아기찾기검색";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);
    });



    function search(babyinfo){
        var data = babyinfo;
          $('#baby_list').bootstrapTable('load', data);   //데이터 reload

    }

      // 아기찾기
      $('#baby_list').bootstrapTable({
        // data: data, //데이터    '{"baby_id":"1","babyname":"조민준","birthday":"180801","mother":"배윤지","father":"조정국"}',
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
              //console.log(row.);
              $('#babyname').val(row.babyname);
              $('#birthday').val(row.birthday);
              $('#baby_id').val(row.baby_id);
              $('#findbabyModal').modal('hide')
            //{baby_id: "5", babyname: "조민준", birthday: "180501", mother: "배윤지", father: "윤이상"}

      //    location.href = url;
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



    var data = <?=$follower_list?>
    // follower_list
    $('#follower_list').bootstrapTable({
      data: data, //데이터    '{"baby_id":"1","babyname":"조민준","birthday":"180801","mother":"배윤지","father":"조정국"}',
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
            //console.log(row.);
            $('#babyname').val(row.babyname);
            $('#birthday').val(row.birthday);
            $('#baby_id').val(row.baby_id);
            $('#findbabyModal').modal('hide')
          //{baby_id: "5", babyname: "조민준", birthday: "180501", mother: "배윤지", father: "윤이상"}

    //    location.href = url;
         },
      columns: [{
          field: 'email',
          title: '아이디',
          //'class': 'w100'
      }, {
          field: 'nickname',
          title: '요청자이름'
          // 'class': 'w100',
            // 'class': 'col-xs-3 .col-md-2'
      }, {
          field: 'approval',
          title: '승인여부',
          align: 'center',
          events: operateEvents,
          formatter: operateFormatter
          // 'class': 'w100',
          // 'class': 'col-xs-2 .col-md-2'
      }, {
          field: 'level',
          title: '권한'
          // 'class': 'w100',
          // 'class': 'col-xs-3 .col-md-2'
      }]
    });
  });    //$(function(){}) 끝

  function operateFormatter(value, row, index) {
        console.log('value는 '+value);
          var approval;
          if(value==0){
            approval = '<i class="glyphicon glyphicon-remove-sign"></i>';
          }else{
            approval = '<i class="glyphicon glyphicon-heart"></i>';
          }
         return [
             '<a class="like" href="javascript:void(0)" title="Like">',
             , approval ,
             '</a>'
         ].join('');
     }

     window.operateEvents = {
        'click .like': function (e, value, row, index) {
            //var approval;
            if(row.approval == "0"){
                row.approval = '1';
            }else{
                row.approval = '0';
            }
          console.log(row);
          changeApprovalData(row);
          // $('#follower_list').bootstrapTable('updateRow', {
          //      index: index,
          //      row: {
          //          approval : approval
          //      }
          //  });
        }
      };

      function changeApprovalData(data){
        var url = '<?=base_url("baby/changeApproval")?>/' + data.email + '/' + data.approval;
        //var data = data;
        var callBack =  changeApproval;
        var errorMsg = "승인여부";
        console.log('changeApprovalData의 인자는' + url);
      //   url, data, callBack, errorMsg
         ajaxExecute(url, data, callBack, errorMsg);
      }

      function changeApproval(result){
        $('#follower_list').bootstrapTable('updateRow', {
             index: index,
             row: {
                 approval : result
             }
         });
      }

    </script>
