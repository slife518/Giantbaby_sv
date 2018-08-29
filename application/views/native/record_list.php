
<form id='form'>
 <div class="table xpull container-fluid">   
    <button  class="btn btn-default pull-right" type='button' id='record' name='record'><i class="fas fa-edit"></i> 기록하기</button> 
   	<canvas id="canvas" width="400" height="400"></canvas>
    <div class="row">
        <div class="col-md-offset-1 col-md-2 col-xs-offset-1 col-xs-5">
            <div>
              <input type="hidden" class="form-control text-center input-lg" id="from_date" name="from_date" readonly/>
            </div>
        </div>
        <div class="col-md-2 col-xs-5">
            <div>
              <input type="hidden" class="form-control text-center input-lg" id="to_date" name="to_date" readonly/>
            </div>
        </div>
    </div>   
  <div>
    <table class="table table-no-bordered" id="record_list" data-row-style="rowStyle"></table>
  </div>
</div>
</form>

<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>

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
          // console.log(dayOfMonth);
          // var date = today.setDate(dayOfMonth - 7);
          // $('#to_date').val(date);


          // var fromday = new Date();
          // var date2 = fromday.getFullYear()+'-'+pad((fromday.getMonth()))+'-'+pad(fromday.getDate());
          // $('#from_date').val(date2);

          var myDate = new Date();
          var dayOfMonth = myDate.getDate();
          myDate.setDate(dayOfMonth - 15);  // 보름 전 꺼부터 조회 
          var fromdate = myDate.getFullYear()+'-'+pad((myDate.getMonth()+1))+'-'+pad(myDate.getDate());
          $('#from_date').val(fromdate);



          var url = '<?=base_url("report/reportInfo")?>';
          var data = $('#form').serialize();
          console.log(data);
          var callBack =  search;
          var errorMsg = "그래프생성";

          ajaxExecute(url, data, callBack, errorMsg);

        }


				function search(response){
						//http://www.chartjs.org
            var array_labels = response["record_date"];
            var array_data1 = response["milk"];
            var array_data2 = response["rice"];
            var array_data3 =  response["sum"];

						 var array_date = array_labels;
						 var ChartData = {
							 //labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
							 labels: array_date,
							 datasets: [{
								 label: '분유',
							//	 borderColor: 'rgb(255, 99, 132)',
								 backgroundColor: 'rgba(255, 159, 64, 0.2)',

								 fill: false,
								 data: array_data1,
								 // yAxisID: 'y-axis-1',
							 }, {
								 label: '이유식',
							//	 borderColor:'rgb(75, 192, 192)',
								 // backgroundColor: 'blue',
								 backgroundColor: 'rgba(75, 192, 192, 0.2)',
								 fill: false,
								 data:array_data2,
								 // yAxisID: 'y-axis-1'
							 }]
						 };

							var ctx = document.getElementById('canvas').getContext('2d');
							window.myBar  =  new Chart(ctx, {
                type: 'bar',
								data: ChartData,
								options: {
									responsive: true,
									hoverMode: 'index',
									stacked: true,
									title: {
										display: true,
										text: '최근 식사량'
									},
									scales: {
                    xAxes: [{
        							stacked: true,
        						}],
        						yAxes: [{
        							stacked: true
        						}]
									}
								}
							});
				}

        $('[data-toggle="popover"]').popover();

        var data = <?=$record?>

        $('#record_list').bootstrapTable({
          data: data,
          // striped: true,
          pagination: true,
          pageSize: 25,
          paginationVAlign :'bottom',
          paginationHAlign: 'right',
          clickToSelect: true,
          // showRefresh:true,
          onClickRow: function (row, element, field) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element,
            // field: the field name corresponding to the clicked cell.
            var url = "<?php echo base_url("native/record/index/")?>" + row.id ;
//            console.log(element);
            location.href = url;
             },
          columns: [{
              field: 'record_date',
              title: '날짜',
              //'class': 'w100'
               'class': 'col-xs-2 col-md-2'
          }, {
              field: 'record_time',
              title: '시간'
              // 'class': 'w100',
              // 'class': 'col-xs-2 .col-md-2'
          }, {
              field: 'milk',
              title: '분유'
              // 'class': 'w100',
              // 'class': 'col-xs-3 .col-md-2'
          }, {
              field: 'rice',
              title: '이유식'
              // 'class': 'w100',
              // 'class': 'col-xs-3 .col-md-2'
          }, {
              field: 'nickname',
              title: '작성자'

          }, {
              field: 'id',
              visible:false

          }]
        });




        $('#record').on('click', function(){
          if("<?=$this->session->userdata('baby_id')?>"){   //값이 있으면 true
            location.href='<?=base_url("native/record/newRecord")?>';
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
});

function rowStyle(row, index) {

    var classes = ['active', 'success', 'info', 'warning', 'danger'];

    var str = row.record_date;
    str = str.substr(str.length - 2, 2);
    console.log(str);
    return {
            classes: classes[str % 5]
        };
}
</script>
