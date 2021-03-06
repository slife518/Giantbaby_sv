<form action="<?php echo base_url("record/index")?>" method="post">
        <div class="main">
            <div class="container tim-container">
                <div name="inputs">
                    <!-- <div class="row">
                      <div class="col-md-2 col-xs-5">
                        <h4>날짜</h4>
                      </div>
                      <div class="col-md-2 col-xs-5">
                        <h4>시간</h4>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" class="form-control text-center input-lg" id="record_date" name="record_date"  value="" readonly/>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" class="form-control text-center input-lg" id="record_time" name="record_time" value="" readonly/>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-3 col-xs-6">
                        <h4>일시</h4>
                      </div>                      
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                          	<div>
                              <input type="text" class="form-control text-center input-lg" id="record_datetime" name="record_datetime"  value="" readonly/>
                              <input type="hidden" class="form-control text-center input-lg" id="record_time" name="record_time" value="" readonly/>
                              <input type="hidden" class="form-control text-center input-lg" id="record_date" name="record_date"  value="" readonly/>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                      <div class="col-md-2 col-xs-5">
                        <h4>분유(ml)</h4>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-5">
                          <input type="tel" id="milk" name="milk" class="form-control text-center input-lg" value=""/>
                        </div>
                        <div class="col-md-1 col-xs-3">
                            <button type="button" class="btn glyphicon glyphicon-arrow-up btn-default btn-lg" id="upQuantity">10</button>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <button type="button" class="btn glyphicon glyphicon-arrow-down btn-default btn-lg" id="downQuantity">10</button>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 col-xs-5">
                        <h4>이유식(ml)</h4>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 col-xs-5">
                          <input type="tel" id="rice" name="rice" class="form-control text-center input-lg" value=""/>
                        </div>
                        <div class="col-md-1 col-xs-3">
                            <button type="button" class="btn glyphicon glyphicon-arrow-up btn-default btn-lg" id="upRiceQuantity">10</button>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <button type="button" class="btn glyphicon glyphicon-arrow-down btn-default btn-lg" id="downRiceQuantity">10</button>
                        </div>
                        <div>
                          <input type="hidden" id="id" name="id"  value="<?=$recordinfo->id?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                          <textarea class="form-control" rows="3" placeholder="남기고 싶은 말" id='description' name='description'><?=$recordinfo->description?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" style="text-align:center;">
                          <div class="modal-footer">
                            <a type='button' href="<?php echo base_url("record/record_list")?>" class="btn btn-lg pull-left btn-default"><i class="fas fa-glasses"></i> 기록보기</a>
                          <?php
                          if($recordinfo->id > 0){
                          ?>
                              <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt"></i> 삭제</button>
                              <!-- //<a href="<?php echo base_url("record/popup_confirm")?>/<?=$recordinfo->id?>" class="btn btn-default"  data-toggle="modal" data-target="#exampleModal">>삭제</a> -->
                              <button type="submit" class="btn btn-default btn-lg"><i class="fas fa-save"></i> 수정하기</button>
                          <?php
                          }else{
                          ?>
                            <button type="submit" class="btn btn-default btn-lg pull-right"><i class="fas fa-save"></i> 저장하기</button>
                          <?php
                          }
                          ?>
                          </div>
                        </div>
                    </div>
              </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">해당기록을 삭제됩니다.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                <a href="<?php echo base_url("record/delete")?>/<?=$recordinfo->id?>" class="btn btn-primary">삭제</a>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>

    </form>
<script type="text/javascript">
$( function() {
            $('.btn-tooltip').tooltip();
            $('.label-tooltip').tooltip();
            $('.pick-class-label').click(function(){
                var new_class = $(this).attr('new-class');
                var old_class = $('#display-buttons').attr('data-class');
                var display_div = $('#display-buttons');
                if(display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
                }
            });
            $( "#slider-range" ).slider({
        		range: true,
        		min: 0,
        		max: 500,
        		values: [ 75, 300 ],
          	});
          	$( "#slider-default" ).slider({
          			value: 70,
          			orientation: "horizontal",
          			range: "min",
          			animate: true
          	});
          	$('.carousel').carousel({
                interval: 4000
            });

            $('.dropdown-menu').on( 'click', 'a', function() {
                var text = $(this).html();
                var htmlText = text + ' <span class="caret"></span>';
                console.log($(this).closest('.dropdown').find('.dropdown-toggle'));
            });

            $(document).ready(function() {
                var today = new Date();

                var date = today.getFullYear()+'-'+pad((today.getMonth()+1))+'-'+pad(today.getDate());
                //var date = pad((today.getMonth()+1))+'-'+today.getDate();
                date = '<?=$recordinfo->record_date?>'|| date;
                var time = pad(today.getHours()) + ':' + pad(today.getMinutes());
                time = '<?=$recordinfo->record_time?>' || time;
                var datetime = date + ' ' + time;
                $('#record_datetime').val(datetime);                

                var milk = '<?=$recordinfo->milk?>' || '0';
                $('#milk').val(milk);

                var rice = '<?=$recordinfo->rice?>' || '0';
                $('#rice').val(rice);


            });

            $('#record_datetime').datetimepicker({
                            format: 'yyyy-mm-dd hh:ii',
                            startView:'hour',
                            minView:'hour',
                            todayHighlight:true,
                            ignoreReadonly: true,
                            autoclose:true,
                            allowInputToggle: true
            });

            // $('#record_time').datetimepicker({
            //                 format: 'hh:ii',
            //                 ignoreReadonly: true,
            //                 autoclose:true,
            //                 startView:'hour',
            //                 allowInputToggle: true
            // });
            $('#upQuantity').on('click', function () {
               var aaa = parseInt($("#milk").val()) + 10;
               if(aaa < 0){
                 aaa = 0;
               }
               $("#milk").val(aaa);
            })
            $('#downQuantity').on('click', function () {
              var bbb = parseInt($("#milk").val()) - 10;
              if(bbb < 0){
                bbb = 0;
              }
              $("#milk").val(bbb);
            })

            // var tmr = 0;
            // $('#downRiceQuantity').on('mousedown', function(e) {
            //   tmr = setTimeout(function () {
            //   //  alert("You clicked OPENPLI ICON!");
            // }, 2000);
            // }).on('mouseup', function(e) {
            //   clearTimeout(tmr);
            //   $("#rice").val(0);
            // });
            // $('#downQuantity').on('mousedown', function(e) {
            //   tmr = setTimeout(function () {
            //   //  alert("You clicked OPENPLI ICON!");
            // }, 2000);
            // }).on('mouseup', function(e) {
            //   clearTimeout(tmr);
            //   $("#milk").val(0);
            // });

            $('#upRiceQuantity').on('click', function () {
               var aaa = parseInt($("#rice").val()) + 10;
                if(aaa < 0){
                  aaa = 0;
                }
               $("#rice").val(aaa);
            })
            $('#downRiceQuantity').on('click', function () {
              var bbb = parseInt($("#rice").val()) - 10;
              if(bbb < 0){
                bbb = 0;
              }
              $("#rice").val(bbb);
            })

            $('#rice').on('click', function () {
               $("#rice").val('');
            })
            $('#milk').on('click', function () {
               $("#milk").val('');
            })
            $('#rice').on('focusout', function () {

              if(!$("#rice").val()){
                  $("#rice").val(0);
              }
            })
            $('#milk').on('focusout', function () {
              if(!$("#milk").val()){
                  $("#milk").val(0);
              }
            })

            // $( ".widget input[type=submit], .widget a, .widget button" ).button();
            // $("button, input, a" ).click( function( event ) {
            //   event.preventDefault();
            // } );



            $("form").on("submit", function(event) {
            //   event.preventDefault();
               //alert($('#record_date').val());               // process form
            });

            $('#record_datetime')
            .datetimepicker()
            .on('changeDate', function(ev){
              console.log(ev);
              console.log(ev.timeStamp);
              var date = new Date(ev.timeStamp);

              
              // $('#record_date').val(sysdate.format('{yyyy}-{MM}-{dd}'));    
              // $('#record_time').val(sysdate.format('{hh}:{mm}'));

              
              
              
              var sysdate = new Sugar.Date(ev.timeStamp);
              console.log(sysdate);
              $('#record_date').val(Sugar.Date.foramt(sysdate,'%Y-%m-%d'));    
              $('#record_time').val(Sugar.Date.foramt(sysdate,'%h-%i'));
              
              
            });
                    
            
} );


</script>
<style>
#record_date, #record_time {
    background-color: transparent;
}
</style>
