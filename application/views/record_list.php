

<div class="main xpull">
  <a href="<?php echo base_url("record")?>" type="button" role="button" class="btn btn-primary btn-lg pull-right">기록하기</a>
  <div class="table-responsive">
      <table id="tableDemo">
  </div>
</div>

<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<!-- <script src="/etc/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script> -->
<script src="/etc/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/etc/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/etc/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<!-- <script src="dist/js/fs-modal.min.js"></script> -->
<script src="/etc/assets/js/gsdk-checkbox.js"></script>
<script src="/etc/assets/js/gsdk-radio.js"></script>
<script src="/etc/assets/js/gsdk-bootstrapswitch.js"></script>
<script src="/etc/assets/js/get-shit-done.js"></script>
<script src="/etc/assets/js/custom.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="/etc/bootstrap3/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script>
  $( function() {
        $(window).resize(function () {
                $(document).ready(function() {
                      $('#tableDemo').bootstrapTable('resetView');
                  });
        });
//        $('[data-toggle="popover"]').popover();


        var data =[
            {code:'000001',
             price: 12.00,
             description: 'Product description, product description',
             cost: 10.00,
            },
            {code:'000002',
             price: 12.00,
             description: 'Product description, product description',
             cost: 10.00,
            },
            {code:'000003',
             price: 12.00,
             description: 'Product description, product description',
             cost: 10.00,
            },
            {code:'000004',
             price: 12.00,
             description: 'Product description, product description',
             cost: 10.00,
            },
        ]

        $('#tableDemo').bootstrapTable({
          data: data,
          columns: [{
              field: 'code',
              title: 'Code',
              'class': 'w200'
          }, {
              field: 'price',
              title: 'Price'
          }, {
              field: 'description',
              title: 'Description',
              'class': 'w500'
          }, {
              field: 'cost',
              title: 'Cost'
          }]
        });
});
</script>
