<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
<form>
	<canvas id="canvas" width="400" height="400"></canvas>
</form>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

<script>
  $( function(){				
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

				// $('#search').on("click", function(e){
			    //  ajaxExecute()
				// });

      });    //$(function(){}) 끝
	</script>
