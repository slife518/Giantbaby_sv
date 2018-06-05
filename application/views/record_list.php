

<div class="main xpull">
  <a href="<?php echo base_url("record")?>" type="button" role="button" class="btn btn-primary btn-lg pull-right">기록하기</a>
  <div class="table-responsive">
      <table id="tableDemo">
  </div>
</div>


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
