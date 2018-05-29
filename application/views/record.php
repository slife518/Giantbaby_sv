<form action="<?php echo base_url("record/index")?>" method="post">
        <div class="main">
            <div class="container tim-container">
                <div name="inputs">
                    <div class="row">
                      <div class="col-md-2 col-xs-5">
                        <h6>아기이름</h6>
                      </div>
                      <div class="col-md-2 col-xs-5">
                        <h6>생년월일</h6>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" class="form-control input-lg" id="name" name="name"  value="<?=$this->session->userdata('babyname');?>" readonly/>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" class="form-control input-lg" id="birthday" name="birthday" value="<?=$this->session->userdata('birthday');?>" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 col-xs-5">
                        <h6>날짜</h6>
                      </div>
                      <div class="col-md-2 col-xs-5">
                        <h6>시간</h6>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" class="form-control input-lg" id="record_date" name="record_date"  value=""/>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-5">
                          	<div>
                              <input type="text" value=""  class="form-control input-lg" id="record_time" name="record_time" value=""/>
                            </div>
                        </div>
                    </div>
                    <div>
                      <h6>분유(ml)</h6>
                    </div>
                    <div class="row">
                      <div>
                        <div class="col-md-2 col-xs-5">
                            <input type="number" id="milk" name="milk" class="form-control input-lg" value=""/>
                        </div>
                        <div class="col-md-1 col-xs-3">
                            <button type="button" class="glyphicon glyphicon-arrow-up btn-round button" id="upQuantity">10</button>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <button type="button" class="glyphicon glyphicon-arrow-down btn-round button" id="downQuantity">10</button>
                        </div>
                      </div>
                    </div>
                    <div>
                      <h6>이유식(ml)</h6>
                    </div>
                    <div class="row">
                      <div>
                        <div class="col-md-2 col-xs-5">
                            <input type="number" id="rice" name="rice" class="form-control input-lg" value=""/>
                        </div>
                        <div class="col-md-1 col-xs-3">
                            <button type="button" class="glyphicon glyphicon-arrow-up btn-round button" id="upRiceQuantity">10</button>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <button type="button" class="glyphicon glyphicon-arrow-down btn-round button" id="downRiceQuantity">10</button>
                        </div>
                      </div>
                    </div>
                    <div>
                      <input type="hidden" id="id" name="id"  value="<?=$recordinfo->id?>"/>
                    </div>
              </div>
                <input type="submit" class="btn btn-block btn-lg btn-info btn-simple" value="저장하기" />
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

            $(document).ready(function() {
                var today = new Date();

                // var date = today.getFullYear()+'-'+pad((today.getMonth()+1))+'-'+today.getDate();
                var date = pad((today.getMonth()+1))+'-'+today.getDate();
                date = '<?=$recordinfo->record_date?>'|| date;

                $('#record_date').val(date);
                var time = pad(today.getHours()) + ':' + pad(today.getMinutes());
                time = '<?=$recordinfo->record_time?>' || time;
                $('#record_time').val(time);

                var milk = '<?=$recordinfo->milk?>' || '200';
                $('#milk').val(milk);

                var rice = '<?=$recordinfo->rice?>' || '50';
                $('#rice').val(rice);


            });

            $('#record_date').datetimepicker({
                            format: 'MM-DD'
            });

            $('#record_time').datetimepicker({
                            format: 'hh:mm'
            });
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

            // $( ".widget input[type=submit], .widget a, .widget button" ).button();
            // $("button, input, a" ).click( function( event ) {
            //   event.preventDefault();
            // } );

            function pad(n){return n<10 ? '0'+n : n}

            $("form").on("submit", function(event) {
            //   event.preventDefault();
               //alert($('#record_date').val());               // process form
            });
} );
</script>
