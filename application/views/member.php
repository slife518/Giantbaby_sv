
    <!-- <form action="/index.php/auth/update" method="post"> -->
<form id="form_member" method="post">
    <div class="main">
      <div class="container tim-container">
        <div class="form-group">
           <label for="exampleInputEmail1">아이디</label>
           <input type="email" class="form-control input-lg" id="email" name="email" value="<?=$userinfo->email?>"  readonly>
         </div>
         <div class="form-group">
            <label for="exampleInputEmail1">닉네임</label><?php echo form_error('nickname'); ?>
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
                <?php echo form_error('password'); ?>
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호">
              </div>
              <div class="col-md-4 col-xs-5">
                <input type="password" class="form-control input-lg" id="re_password" name="re_password" placeholder="비밀번호 확인">
              </div>
          </div>

          <div class="row">
            <div class="col-sm-3" style="text-align:center;">
                <button type='button' id="save" name="save" class="btn btn-primary">회원정보수정</button>
            </div>
          </div>
       </div>

</form>
<form id="form_baby" method="post">
       <div class="container bs-docs-container">
         <div class="row">
             <div class="bs-docs-section">
               <h1 id="js-overview" class="page-header">Baby info</h1>
             </div>
         </div>
         <div class="row">
          <div class="col-md-9" role="main">
      <?php if(empty($userinfo->babyname)){   //등록된 아기가 없으면  ?>
            <div class="row">
              <div class="col-md-6 col-xs-6">
                <input type="button" name="newbaby" id="newbaby" class="btn btn-warning"  data-toggle="modal" data-target="#newbabyModal" value="우리아기등록">
              </div>
              <div class="col-md-6 col-xs-6">
                <input type="button" name="findbaby" id="findbaby" class="btn btn-warning"  data-toggle="modal" data-target="#findbabyModal" value="우리아기찾기">
              </div>
            </div>
      <?php }else{  //등록된 아기가 있으면  ?>
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
                <input class="form-control input-lg" type="text" style = "ime-mode : active" id="babyname" name="babyname" placeholder="아기이름"  readonly value="<?=$userinfo->babyname?>" >
              </div>
              <div class="col-md-4 col-xs-4">
                <input class="form-control input-lg" type="text" id="birthday" name="birthday"  placeholder="생년월일(6자리)" value="<?=$userinfo->birthday?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <label class="control-label">아빠이름</label>
              </div>
              <div class="col-md-4 col-xs-4">
                <label class="control-label">엄마이름</label>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4 col-xs-4">
                <input class="form-control input-lg" type="text" style = "ime-mode : active" id="father" name="father" placeholder="아빠이름"  readonly value="<?=$userinfo->father?>" >
              </div>
              <div class="col-md-4 col-xs-4">
                <input class="form-control input-lg" type="text" id="mother" name="mother"  placeholder="엄마이름" value="<?=$userinfo->mother?>" readonly>
              </div>
            </div>
        <?php }?>
          <?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>
            <div class="row">
              <div class="col-sm-3" style="text-align:center;">
                  <button type='button' id="babyinfoUpdate" name="babyinfoUpdate" class="btn btn-primary">아기정보수정</button>
              </div>
            </div>
          <?php }?>
            <div>
              <input type="hidden" id="baby_id" name="baby_id"  value="<?=$userinfo->baby_id?>"/>
              <input type="hidden" id="owner" name="owner"  value="<?=$userinfo->owner?>"/>
            </div>
</form>
<form id="form_love" method="post">
            <?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>
                <div class="bs-docs-section">
                  <h1 id="js-overview" class="page-header">우리아기사랑</h1>
                </div>
                <div>
                  <table class="table" id="follower_list" data-row-style="rowStyle"></table>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>


    </div>


    <!-- 우리아기찾기 Modal -->
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


    <!-- 우리아기등록 Modal -->
    <div class="modal fade" id="newbabyModal" tabindex="-1" role="dialog" aria-labelledby="newbabyModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newbabyModal">우리아기 등록하기</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <label>아기이름</label>
              </div>
              <div class="col-md-6 col-xs-6">
                <label>아기생년월일(6자리)</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="newbabyname" name="newbabyname">
              </div>
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="newbirthday" name="newbirthday">
              </div>
              <!--Radio group-->
              <div class="form-check col-md-4 col-xs-4">
                  <input class="form-check-input" name="group100" type="radio" id="girl">
                  <label class="form-check-label" for="girl">여자</label>
              </div>
              <div class="form-check col-md-4 col-xs-4">
                  <input class="form-check-input" name="group100" type="radio" id="boy" checked>
                  <label class="form-check-label" for="boy">남자</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <label>아빠이름</label>
              </div>
              <div class="col-md-4 col-xs-4">
                <label>엄마이름</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="newfather" name="father">
              </div>
              <div class="col-md-4 col-xs-4">
                <input type="text" class="form-control input-lg" id="newmother" name="mother">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-primary pull-right" name="registerbaby" id="registerbaby" value="아기등록">
          </div>
        </div>
      </div>
    </div>
</form>

<script>
$( function(){

		init();

		function init(){

<?php if($userinfo->email = $userinfo->owner){   //우리아기 책임자이면 ?>
      var url = '<?=base_url("baby/follower_list")?>';
      var data = $('#form_love').serialize();
      var callBack = reloadFollower;
      var errorMsg = "follower_list";
    //   url, data, callBack, errorMsg
      ajaxExecute(url, data, callBack, errorMsg);
<?php }?>

    }

    function reloadFollower(data){
       $('#follower_list').bootstrapTable('load', data);
    }


//아기찾기 검색
    $('#search').on("click", function(e){
      var url = '<?=base_url("baby/findbaby")?>';
      var data = $('#form_love').serialize();
      console.log(data);
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
            field: 'babyname',  //모달 테이블의 아기 이름
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

      //아기등록 검색
      $('#registerbaby').on("click", function(e){
            var url = '<?=base_url("baby/register")?>';
            var data = $('form').serialize();
            console.log(data);
            var callBack =  registerbaby;
            var errorMsg = "아기등록";
          //   url, data, callBack, errorMsg
             ajaxExecute(url, data, callBack, errorMsg);
          });

      function registerbaby(babyinfo){
          console.log(babyinfo);
          var data = babyinfo;
          $('#babyname').val(babyinfo.babyname);
          $('#birthday').val(babyinfo.birthday);
          $('#baby_id').val(babyinfo.baby_id);
          $('#newbabyModal').modal('hide')
      }


    $('#save').on("click",function(){  //회원정보수정

      //location.href="<?php echo base_url("Auth/update")?>";
      var url = '<?=base_url("Auth/update")?>';
      var data = $('#form_member').serialize();
      console.log(data);
      var callBack =  reload;
      var errorMsg = "회원정보수정";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);

    });


    $('#babyinfoUpdate').on("click",function(){
      var url = '<?=base_url("baby/update")?>';
      var data = $('#form_baby').serialize();
      console.log(data);
      var callBack =  reload;
      var errorMsg = "아기정보수정";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);
    });

    function reload(message){
      alert(message);
      location.href="<?php echo base_url("auth/member")?>";
    }

<?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>
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
      }]
    });



 //우리아기사랑 끝
          <?php }  ?>
});    //$(function(){}) 끝


<?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>

     window.operateEvents = {
        'click .like': function (e, value, row, index) {
            //var approval;
            if(row.approval == "0"){
                row.approval = '1';
            }else{
                row.approval = '0';
            }
          console.log(row);
          changeApprovalData(row, index);
          // $('#follower_list').bootstrapTable('updateRow', {
          //      index: index,
          //      row: {
          //          approval : approval
          //      }
          //  });
        }
      };


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


         function changeApprovalData(row, index){
           // var url = '<?=base_url("baby/changeApproval")?>/' + data.email + '/' + data.approval;
           var url = '<?=base_url("baby/changeApproval")?>/' + index;
           var data = row;
           var callBack =  changeApproval;
           var errorMsg = "승인여부";
           console.log('changeApprovalData의 인자는' + url);
         //   url, data, callBack, errorMsg
            ajaxExecute(url, data, callBack, errorMsg);
         }

         function changeApproval(result){
           console.log(result);
           $('#follower_list').bootstrapTable('updateRow', {
                index: result.index,
                row: {
                    approval : result.approval
                }
            });
         }

         <?php }?>
    </script>
