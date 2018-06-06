<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>

<div class="main xpull">

<canvas id="canvas" width="400" height="400"></canvas>

<div class="row">
    <div class="col-md-offset-1 col-md-2 col-xs-offset-1 col-xs-4">
        <div>
          <input type="text" class="form-control text-center input-lg" id="from_date" name="from_date"  value="" readonly/>
        </div>
    </div>
    <div><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></div>
    <div class="col-md-offset-1 col-md-2 col-xs-offset-1 col-xs-4">
        <div>
          <input type="text" class="form-control text-center input-lg" id="to_date" name="to_date"  value="" readonly/>
        </div>
    </div>
</div>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

	<script>
		var lineChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: '분유',
				borderColor: 'red',
				backgroundColor: 'red',
				fill: false,
				data: [
					12, 19, 3, 5, 2, 3, 6
				],
				yAxisID: 'y-axis-1',
			}, {
				label: '이유식',
				borderColor: 'blue',
				backgroundColor: 'blue',
				fill: false,
				data: [
					1, 2, 4, 3, 6, 10, 14
				],
				yAxisID: 'y-axis-2'
			}, {
				label: '총량',
				borderColor: 'yello',
				backgroundColor: 'yello',
				fill: false,
				data: [
					5, 3, 4, 5, 2, 1, 9
				],
				yAxisID: 'y-axis-2'
			}]
		};

		window.onload = function() {
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
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',

							// grid line settings
							gridLines: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
							},
						}],
					}
				}
			});

		};


      // $(document).ready(function() {
  $( function(){
        var today = new Date();
        var date = today.getFullYear()+'-'+pad((today.getMonth()+1))+'-'+pad(today.getDate());
        //var date = pad((today.getMonth()+1))+'-'+today.getDate();
        $('#from_date').val(date);
        $('#to_date').val(date);

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


      });


	</script>
  <style>
  #to_date, #from_date {
      background-color: transparent;
  }
  </style>
