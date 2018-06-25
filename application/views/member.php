
    <!-- <form action="/index.php/auth/update" method="post"> -->
<!-- <div class="main"> -->
<div class="main">
  <div class="container tim-container">
      <form id="form_member" method="post">
         <div class="form-group">
           <input type="email" class="form-control input-lg" id="email" name="email" value="<?=$userinfo->email?>"  readonly>
         </div>
         <div class="row">
           <div class="col-md-6 col-xs-6">
             <label class="control-label">닉네임</label>
           </div>
           <div class="col-md-6 col-xs-6">
             <label class="control-label">연락처</label>
           </div>
         </div>
         <div class="row form-group">
            <div class='col-md-6 col-xs-6 essential'>
              <input type="text" style = "ime-mode : active" class="form-control input-lg" id="nickname" text='닉네임' name="nickname" value="<?=$userinfo->nickname?>">
            </div>
            <div class='col-md-6 col-xs-6 essential'>
              <input type="text" style = "ime-mode : active" class="form-control input-lg" id="tel" text='연락처' name="tel" value="<?=$userinfo->tel?>">
            </div>
          </div>
          <div class="form-group row">
              <div class="col-md-6 col-xs-6">
                <?=form_error('password'); ?>
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="비밀번호">
              </div>
              <div class="col-md-6 col-xs-6">
                <input type="password" class="form-control input-lg" id="re_password" name="re_password" placeholder="비밀번호 확인">
              </div>
          </div>

          <div class="row">
            <div class="col-sm-3" style="text-align:center;">
                <button type='button' id="memberInfoModi" name="memberinfomodi" class="btn btn-default"><i class="fas fa-save"></i> 회원정보수정</button>
            </div>
          </div>
     </form>
     <form id="form_baby" method="post">
       <div class="container tim-container">
           <!-- <div class="container bs-docs-container"> -->
             <div class="row">
                 <div class="form-group bs-docs-section">
                   <h1 id="js-overview" class="page-header">아기정보</h1>
                 </div>
             </div>
             <!-- <div class="row"> -->
              <!-- <div class="col-md-9" role="main"> -->
          <?php if(empty($userinfo->babyname)){   //등록된 아기가 없으면  ?>
                <div class="row">
                  <div class="col-md-6 col-xs-6">
                    <button type='button' name="newbaby" id="newbaby" class="btn btn-default"  data-toggle="modal" data-target="#newbabyModal"><i class="fas fa-registered"></i> 아기등록</button>
                  </div>
                  <div class="col-md-6 col-xs-6">
                    <button type='button' name="findbaby" id="findbaby" class="btn btn-default"  data-toggle="modal" data-target="#findbabyModal"><i class="fas fa-search"></i> 아기찾기</button>
                  </div>
                </div>
          <?php }else{?>
                <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">아기이름</label>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">아기생년월일</label>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">성별</label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4 col-xs-4 essential">
                    <input class="form-control input-lg babyinfo" type="text" style = "ime-mode : active" id="babyname" name="babyname" text='아기이름' placeholder="아기이름"  readonly value="<?=$userinfo->babyname?>" >
                  </div>
                  <div class="col-md-4 col-xs-4 essential">
                    <input class="form-control input-lg babyinfo" type="text" id="birthday" name="birthday" text='생년월일' placeholder="생년월일" value="<?=$userinfo->birthday?>" readonly>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <!-- <select class="form-control input-lg" type="text" id="sex" name="sex"  placeholder="성별" value="<?=$userinfo->sex?>" readonly> -->
                    <select class="form-control input-lg babyinfo essential" text='성별' id="sex" name="sex" disabled required>
                      <option>성별</option>
                      <option value="1">남</option>
                      <option value="2">여</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">아빠이름</label>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">엄마이름</label>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label">보호자ID</label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4 col-xs-4 essential">
                    <input class="form-control input-lg babyinfo" type="text" style = "ime-mode : active" id="father" name="father" text='아빠이름' placeholder="아빠이름"  readonly value="<?=$userinfo->father?>" >
                  </div>
                  <div class="col-md-4 col-xs-4 essential">
                    <input class="form-control input-lg babyinfo" type="text" id="mother" name="mother" text='엄마이름' placeholder="엄마이름" value="<?=$userinfo->mother?>" readonly>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <input class="form-control input-lg" type="text" id="owner" name="owner"  placeholder="보호자" value="<?=$userinfo->owner?>" readonly>
                  </div>
                </div>
              <?php }?>
              <?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>
                <div class="row">
                  <div class="col-sm-3" style="text-align:center;">
                      <button type='button' id="babyinfoUpdate" name="babyinfoUpdate" class="btn btn-default"><i class="fas fa-save"></i> 아기정보수정</button>
                  </div>
                </div>
              <?php }?>
                <div>
                  <input type="hidden" id="baby_id" name="baby_id"  value="<?=$userinfo->baby_id?>"/>
                  <!-- <input type="hidden" id="owner" name="owner"  value="<?=$userinfo->owner?>"/> -->
                </div>
          <!-- </div> -->
        </div>
      </form>   <!-- id="form_baby"  -->
      <form id="form_findbabyModal" method="post">
                <!-- 우리아기찾기 Modal start -->
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
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="findbabyname" name="findbabyname" placeholder="아기이름" text="아기이름">
                          </div>
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="findmother" name="findmother" placeholder="엄마이름" text="엄마이름">
                          </div>
                          <div class="col-md-4 col-xs-4">
                            <button type='button' class="btn btn-default pull-right" name="search" id="search"><i class="fas fa-search"></i> 검색</button>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div>
                          <table class="table" id="baby_list" data-row-style="rowStyle"></table>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
      </form>   <!-- id="form_findbabyModal"  -->
      <form id="form_newbabyModal" method="post">
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
                          <div class="col-md-4 col-xs-4">
                            <label>생년월일(6자리)</label>
                          </div>
                          <div class="col-md-4 col-xs-4">
                            <label>성별</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="newbabyname" name="newbabyname" text='아기이름'>
                          </div>
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="newbirthday" name="newbirthday" text='아기생년월일'>
                          </div>
                          <div class="col-md-4 col-xs-4" essential>
                              <select class="form-control input-lg" id="newsex" name="newsex" text='성별'>
                                <option value="">성별</option>
                                <option value="1">남</option>
                                <option value="2">여</option>
                              </select>
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
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="newfather" name="newfather" text='아빠이름'>
                          </div>
                          <div class="col-md-4 col-xs-4 essential">
                            <input type="text" class="form-control input-lg" id="newmother" name="newmother" text='엄마이름'>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type='button' class="btn btn-default pull-right" name="registerbaby" id="registerbaby"><i class="fas fa-registered"></i> 아기등록</button>
                      </div>
                    </div>
                  </div>
                </div>
      </form>   <!-- id="form_newbabyModal"  -->
      <form id="form_love" method="post">
            <?php if($userinfo->email == $userinfo->owner){   //우리아기 책임자이면 ?>
                <div class="bs-docs-section">
                  <h1 id="js-overview" class="page-header">아기사랑</h1>
                </div>
                <div>
                  <table class="table" id="follower_list" data-row-style="rowStyle"></table>
                </div>
            <?php } ?>

      </form>
    </div>
  </div>
<script>
$( function(){

		init();

		function init(){

// value 값으로 선택
      $("#sex").val("<?=$userinfo->sex?>").prop("selected", true);
<?php if($userinfo->email == $userinfo->owner){   //우리아기 보호자이면 ?>
      $('.babyinfo').prop('readonly', false);
      $('.babyinfo').attr('disabled', false);

      var url = '<?=base_url("baby/follower_list")?>';
      // var data = $('#form_baby').serialize();
      var data = {};
      data.baby_id = $('#baby_id').val();
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
      if (!fnReqiredCheck('findbabyModal')) return;

      var url = '<?=base_url("baby/findbaby")?>';
      var data = {};
      data.findbabyname = $('#findbabyname').val();
      data.findmother = $('#findmother').val();
      var callBack =  search;
      var errorMsg = "아기찾기검색";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);
    });

    function search(babyinfo){
        var data = babyinfo;
          $('#baby_list').bootstrapTable('load', data);   //데이터 reload

    }

      // 우리아기찾기
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

              var url = '<?=base_url("baby/registerRelation")?>';
              // var data = $('#form_baby').serialize();
              var data = row;
              //console.log(data);
              var callBack =  registerbaby;
              var errorMsg = "아기찾기";


              $.confirm({
                    title: '아기등록',
                    content: '우리아기('+row.babyname  +')로 등록하시겠습니까?',
                    buttons: {
                        예: function () {
                            console.log(data);
                            ajaxExecute(url, data, callBack, errorMsg);
                            $('#findbabyModal').modal('hide')
                            reload('우리아기('+row.babyname  +')로 등록되었습니다.".')
                            // $.alert('우리아기('+row.babyname  +')로 등록되었습니다.".');
                        },
                        아니요: {
                            text: '아니요', // With spaces and symbols
                            action: function () {
                                // $('#findbabyModal').modal('hide')
                            }
                        }
                    }
                });
           },
        columns: [{
            field: 'babyname',  //모달 테이블의 아기 이름
            title: '아기이름',
        }, {
            field: 'birthday',
            title: '아기생년월일'
        }, {
            field: 'mother',
            title: '엄마이름'
        }, {
            field: 'father',
            title: '아빠이름'
        }, {
            field: 'baby_id',
            visible:false
        }]
      });

      //아기등록
      $('#registerbaby').on("click", function(e){
        if (!fnReqiredCheck('newbabyModal')) return;

            var url = '<?=base_url("baby/registerBaby")?>';
            var data = $('#form_newbabyModal').serialize();
            console.log(data);
            var callBack =  registerbaby;
            var errorMsg = "아기등록";

            $.confirm({
                  title: '아기등록',
                  content: '우리아기로 등록하시겠습니까?',
                  buttons: {
                      예: function () {
                          // $.alert('우리아기로 등록되었습니다.".');

                      //   url, data, callBack, errorMsg
                         ajaxExecute(url, data, callBack, errorMsg);
                         $('#newbabyModal').modal('hide');
                         reload('우리아기로 등록되었습니다.')

                      },
                      아니요: {
                          text: '아니요', // With spaces and symbols
                          action: function () {
                              // $('#newbabyModal').modal('hide')
                          }
                      }
                  }
              });

          });

      function registerbaby(babyinfo){
          console.log(babyinfo);
          var data = babyinfo;
          $('#mother').val(babyinfo.mother);
          $('#father').val(babyinfo.father);
          $('#babyname').val(babyinfo.babyname);
          $('#birthday').val(babyinfo.birthday);
          $("#sex").val(babyinfo.sex).prop("selected", true);
          $('#baby_id').val(babyinfo.baby_id);
          $('#newbabyModal').modal('hide')
      }


    $('#memberInfoModi').on("click",function(){  //회원정보수정
      if (!fnReqiredCheck('form_member')) return;
      var url = '<?=base_url("Auth/update")?>';
      var data = $('#form_member').serialize();
      console.log(data);
      var callBack =  popup_alert;
      var errorMsg = "회원정보수정";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);

    //  popup_alert("회원정보가 수정되었습니다.")
    });

    //아기정보수정
    $('#babyinfoUpdate').on("click",function(){
      if (!fnReqiredCheck('form_baby')) return;
      var url = '<?=base_url("baby/update")?>';
      var data = $('#form_baby').serialize();
      console.log(data);
      var callBack =  popup_alert;
      var errorMsg = "아기정보수정";
    //   url, data, callBack, errorMsg
       ajaxExecute(url, data, callBack, errorMsg);
    //   popup_alert("아기정보가 수정되었습니다.")
    });

    function reload(message){
      if(message.length > 0){
        popup_alert(message);
      }
       location.href="<?=base_url("auth/member")?>";
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
            // $('#babyname').val(row.babyname);
            // $('#birthday').val(row.birthday);
            // $('#baby_id').val(row.baby_id);
            // $('#findbabyModal').modal('hide')
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
           var url = '<?=base_url("baby/changeApproval")?>/' + index;
           var data = [];
           data.push({baby_id: $('#baby_id').val(),email: row.email,approval: row.approval });
           var callBack =  changeApproval;
           var errorMsg = "승인여부";
           console.log('changeApprovalData의 인자는' + url);
         //   url, data, callBack, errorMsg
            ajaxExecute(url, data[0], callBack, errorMsg);
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
