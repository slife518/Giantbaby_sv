<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
<form>
	<div class="main xpull">
	<canvas id="canvas" width="400" height="400"></canvas>
	<div class="row">
			<div class="col-md-offset-1 col-md-2 col-xs-offset-1 col-xs-5">
					<div>
						<?php echo form_error('from_date'); ?>
						<input type="text" class="form-control text-center input-lg" id="from_date" name="from_date"  value="<?=set_value('from_date'); ?>" readonly/>
					</div>
			</div>
			<div class="col-md-2 col-xs-5">
					<div>
						<?php echo form_error('to_date'); ?>
						<input type="text" class="form-control text-center input-lg" id="to_date" name="to_date"  value="<?=set_value('to_date'); ?>" readonly/>
					</div>
			</div>
	</div>
	<p>
	<div class="row">
			<div class="col-md-offset-4 col-md-3 col-xs-offset-4 col-xs-3">
				<input type="button" class="btn btn-warning btn-lg" value="조회하기" name="search" id="search"/>
			</div>
		</div></p>
	</div>
</form>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
  $( function(){
				init();
        // var today = new Date();
        // var date = today.getFullYear()+'-'+pad((today.getMonth()+1))+'-'+pad(today.getDate());
        // //var date = pad((today.getMonth()+1))+'-'+today.getDate();
        // $('#to_date').val(date);
				// currentDate.addDays(-7);
				//
				// var today2 = new Date();
        // var date2 = today.getFullYear()+'-'+pad((today2.getMonth()+1))+'-'+pad(today2.getDate());
        // $('#from_date').val(date2);

        $('#from_date').datetimepicker({
                        format: 'yyyy-mm-dd',
                        startView:'month',
                        minView:'month',
                        todayHighlight:true,
                        ignoreReadonly: true,
                        autoclose:true,
                        allowInputToggle: true
        });

        $('#to_date').datetimepicker({
                        format: 'yyyy-mm-dd',
                        startView:'month',
                        minView:'month',
                        todayHighlight:true,
                        ignoreReadonly: true,
                        autoclose:true,
                        allowInputToggle: true
        });

				function search(arg1, arg2, arg3, arg4){

						 // var array_date = <?=json_encode($record_date)?>;
						 var array_date = arg1;
						 var lineChartData = {
							 //labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
							 labels: array_date,
							 datasets: [{
								 label: '분유',
								 borderColor: 'Green',
								 backgroundColor: 'Green',
								 fill: false,
								 // data: [12, 19, 3, 5, 2, 3, 6],
									// data: [<?=implode(",",$milk)?>],
									data: arg2,
								 yAxisID: 'y-axis-1',
							 }, {
								 label: '이유식',
								 borderColor: 'blue',
								 backgroundColor: 'blue',
								 fill: false,
									data:arg3,
								 yAxisID: 'y-axis-1'
							 }, {
								 label: '총량',
								 borderColor: 'red',
								 backgroundColor: 'red',
								 fill: false,
								 data:arg4,
								 yAxisID: 'y-axis-1'
							 }]
						 };

							var ctx = document.getElementById('canvas').getContext('2d');
							window.myLine = Chart.Line(ctx, {
								data: lineChartData,
								options: {
									responsive: true,
									hoverMode: 'index',
									stacked: false,
									title: {
										display: true,
										text: '우리아기 식사량'
									},
									scales: {
										yAxes: [{
											type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: 'left',
											id: 'y-axis-1',
										}
										// , {
										// 	type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
										// 	display: true,
										// 	position: 'right',
										// 	id: 'y-axis-2',
										// 	// grid line settings
										// 	gridLines: {
										// 		drawOnChartArea: false, // only want the grid lines for one axis to show up
										// 	},
										// }
									],
									}
								}
							});
				}
				function init(){

					var record_date = <?=json_encode($record_date)?>;
					var milk = [<?=implode(",",$rice)?>];
					var rice =  [<?=implode(",",$rice)?>];
					var sum =  [<?=implode(",",$sum)?>];
					search( record_date, milk, rice, sum );
				}
				$('#search').on("click", function(e){
			     var username = $(this).val();
			     $.ajax({
			      url:'<?=base_url("report/reportInfo")?>',
			      method: 'post',
			      data: $('form').serialize(),
			      //dataType: 'json',
			      success: function(response){

						console.log(response);

						var record_date = <?=json_encode($record_date)?>;
						var milk = [<?=implode(",",$rice)?>];
						var rice =  [<?=implode(",",$rice)?>];
						var sum =  [<?=implode(",",$sum)?>];
						search( record_date, milk, rice, sum );
			       // var len = response.length;
						 //
			       // if(len > 0){
			       //  // Read values
			       //  var uname = response[0].username;
			       //  var name = response[0].name;
			       //  var email = response[0].email;
						 //
			       //  $('#suname').text(uname);
			       //  $('#sname').text(name);
			       //  $('#semail').text(email);
						 //
			       // }else{
			       //  $('#suname').text('');
			       //  $('#sname').text('');
			       //  $('#semail').text('');
						 // }
				  }
			  });
			});


      });    //$(function(){}) 끝


	</script>
  <style>
  #to_date, #from_date {
      background-color: transparent;
  }
  </style>
