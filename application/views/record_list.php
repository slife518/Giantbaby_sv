

<div class="main xpull">
  <div>
    <a href="<?php echo base_url("record")?>" type="button" role="button" class="btn btn-primary btn-lg pull-right">기록하기</a>
  </div>
  <div>
    <table  id="record_list" data-row-style="rowStyle"></table>
  </div>
</div>




<script>
  $( function(){

        $(window).resize(function () {
           $(document).ready(function() {
                      $('#record_list').bootstrapTable('resetView');
                  });
        });
        $('[data-toggle="popover"]').popover();

        var data = <?=$record?>

        $('#record_list').bootstrapTable({
          data: data,
          // striped: true,
          pagination: true,
          pageSize: 9,
          paginationVAlign :'bottom',
          paginationHAlign: 'right',
          clickToSelect: true,
          // showRefresh:true,
          onClickRow: function (row, element, field) {
            // row: the record corresponding to the clicked row,
            // $element: the tr element,
            // field: the field name corresponding to the clicked cell.
            var url = "<?php echo base_url("record/index/")?>" + row.id ;
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
              // 'class': 'w500'
              // 'class': 'col-xs-2 .col-md-3'
          // }, {
          //     field: 'description',
          //     title: '남길 글',
          //     align: 'left',
          //     'class': 'w300'

          }, {
              field: 'id',
              visible:false

          }]
        });


        function rowStyle(row, index) {

          console.log(row);
            var classes = ['active', 'success', 'info', 'warning', 'danger'];

            if (index % 2 === 0 && index / 2 < classes.length) {
                return {
                    classes: classes[index / 2]
                };
            }
            return {};
        }
});
</script>
