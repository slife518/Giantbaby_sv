<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
<form>
	<div class="main xpull container-fluid">
	<button type='button' class="btn btn-default pull-right" type='button' id='record' name='record'><i class="fas fa-edit"></i> 기록하기</button>
	<canvas id="canvas" width="400" height="400"></canvas>
	<div class="row">
			<div class="col-md-offset-1 col-md-2 col-xs-offset-1 col-xs-5">
					<div>
						<input type="text" class="form-control text-center input-lg" id="from_date" name="from_date" readonly/>
					</div>
			</div>
			<div class="col-md-2 col-xs-5">
					<div>
						<input type="text" class="form-control text-center input-lg" id="to_date" name="to_date" readonly/>
					</div>
			</div>
	</div>
	<p>
	<div class="row">
			<div class="col-md-offset-4 col-md-3 col-xs-offset-4 col-xs-3">
				<button type='button' class="btn btn-default btn-lg"name="search" id="search"><i class="fas fa-search"></i> 조회하기</button>
			</div>
		</div></p>
	</div>
</form>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
  $( function(){
				init();

				function init(){

					var today = new Date();
					var date = today.getFullYear()+'-'+pad((today.getMonth()+1))+'-'+pad(today.getDate());
					$('#to_date').val(date);

					// var today = new Date();
					// var dayOfMonth = today.getDate();
					// var date = today.setDate(dayOfMonth - 7);
					// $('#to_date').val(date);



			//		var fromday = new Date();
			//		var date2 = fromday.getFullYear()+'-'+pad((fromday.getMonth()+1))+'-'+pad(fromday.getDate());
					//var myDate = new Date(date2);
					var myDate = new Date();
					var dayOfMonth = myDate.getDate();
					myDate.setDate(dayOfMonth - 15);
					var fromdate = myDate.getFullYear()+'-'+pad((myDate.getMonth()+1))+'-'+pad(myDate.getDate());
					$('#from_date').val(fromdate);

					ajaxExecute();

				}
        $('#from_date').datetimepicker({
                        format: 'yyyy-mm-dd',
                        startView:'month',
                        minView:'month',
												pickerPosition: "top-right",
                        todayHighlight:true,
                        ignoreReadonly: true,
                        autoclose:true,
                        allowInputToggle: true
        });

        $('#to_date').datetimepicker({
                        format: 'yyyy-mm-dd',
                        startView:'month',
                        minView:'month',
												pickerPosition: "top-left",
                        todayHighlight:true,
                        ignoreReadonly: true,
                        autoclose:true,
                        allowInputToggle: true
        });

				function search(array_labels, array_data1, array_data2, array_data3){
						//http://www.chartjs.org
						 var array_date = array_labels;
						 var lineChartData = {
							 //labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
							 labels: array_date,
							 datasets: [{
								 label: '분유',
								// borderColor: 'Green',
								 backgroundColor: 'rgba(75, 192, 192, 0.2)',
								 fill: false,
								 data: array_data1,
								 yAxisID: 'y-axis-1',
							 }, {
								 label: '이유식',
								// borderColor: 'blue',
								 backgroundColor: 'rgba(255, 159, 64, 0.2)',
								 fill: false,
									data:array_data2,
								 yAxisID: 'y-axis-1'
							 }, {
								 label: '총량',
								// borderColor: 'red',
								 backgroundColor: 'Green',
								 fill: false,
								 data:array_data3,
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
										text: '우리아기 시간대별 식사량'
									},
									scales: {
										yAxes: [{
											type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: 'left',
											id: 'y-axis-1',
										}
									],
									}
								}
							});
				}

				function ajaxExecute(){
					$.ajax({
							 url:'<?=base_url("report/timeCountInfo")?>',
							 method: 'post',
							 data: $('form').serialize(),
							 dataType: 'json',
							 success: function(response){
								 console.log(response);
										 var xx = response["xx"];
										 var milk = response["milk"];
										 var rice = response["rice"];
										 var sum =  response["sum"];
										 search( xx, milk, rice, sum );
							 }
					 });
				}

				$('#record').on('click', function(){
					if("<?=$this->session->userdata('baby_id')?>"){   //값이 있으면 true
						location.href='<?=base_url("record")?>';
					}else{
						popup_alert('아이를 등록 후 기록가능합니다.');
						//location.href='<?=base_url("auth/member")?>';
						$.confirm({
									title: '아기등록',
									content: '아이를 등록 후 기록가능합니다.',
									buttons: {
											아이등록하러가기: function () {
												location.href='<?=base_url("auth/member")?>';
											}
									}
							});

					}

				})

				$('#search').on("click", function(e){
			     ajaxExecute()
				});

      });    //$(function(){}) 끝
	</script>
  <style>
  #to_date, #from_date {
      background-color: transparent;
  }
  </style>
