<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<link rel="apple-touch-icon" sizes="76x76" href="get-shit-done-1.4.1/assets/img/apple-icon.png">
    	<link rel="icon" type="image/png" href="get-shit-done-1.4.1/assets/img/favicon.png">
      <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    	<title>Get Shit Done Kit by Creative Tim</title>

    	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link href="get-shit-done-1.4.1/bootstrap3/css/bootstrap.css" rel="stylesheet" />
    	<link href="get-shit-done-1.4.1/assets/css/gsdk.css" rel="stylesheet" />
        <link href="get-shit-done-1.4.1/assets/css/demo.css" rel="stylesheet" />

        <!--     Font Awesome     -->
        <link href="get-shit-done-1.4.1/bootstrap3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <form action="./process.php" method="POST">


        <div id="navbar-full">
            <div class="container">
                <nav class="navbar navbar-ct-blue navbar-transparent navbar-fixed-top" role="navigation">

                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="http://creative-tim.com">
                             <div class="logo-container">
                                <div class="logo">
                                    <img src="get-shit-done-1.4.1/assets/img/new_logo.png">
                                </div>
                                <div class="brand">
                                    Records
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                            <li><a href="components.html">Components</a></li>

                            <li><a href="http://www.creative-tim.com/product/get-shit-done-kit" class="btn btn-round btn-default">기록보기</a></li>
                       </ul>

                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
            </div><!--  end container-->
        </div>
        <div class="main">
            <div class="container tim-container">
                <div id="inputs">
                    <div class="tim-title">
                        <h3>.</h3>
                    </div>
                    <div class="tim-title">
                        <h3>기록하기</h3>
                    </div>
                    <div>
                      <h6>날짜</h6>
                    </div>
                    <div class="row">
                      <div>
                        <div class="col-md-3 col-xs-7">
                          	<div>
                              <input type="text" value="" placeholder="2017.05.14" class="form-control" id="eatDateTime"  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <h6>분유(ml)</h6>
                    </div>
                    <div class="row">
                      <div>
                        <div class="col-md-2 col-xs-5">
                            <input type="number" id="eatMl" value="200" class="form-control"/>
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
                      <h6>이유식(%)</h6>
                    </div>
                    <div class="row">
                      <div>
                        <div class="col-md-2 col-xs-5">
                            <input type="number" id="eatRice" value="50" class="form-control"/>
                        </div>
                        <div class="col-md-1 col-xs-3">
                            <button type="button" class="glyphicon glyphicon-arrow-up btn-round button" id="upRiceQuantity">10</button>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <button type="button" class="glyphicon glyphicon-arrow-down btn-round button" id="downRiceQuantity">10</button>
                        </div>
                      </div>
                    </div>
                    <p></p><p></p><p></p>
                    <div class="row">
                      <div class="col-md-6 col-xs-6 col-md-offset-3 col-xs-offset-3">
                         <button type="button" class="btn btn-block btn-lg btn-info btn-simple">저장하기</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </form>
    </body>

    <script src="get-shit-done-1.4.1/jquery/jquery-1.10.2.js" type="text/javascript"></script>
  	<script src="get-shit-done-1.4.1/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
  	<script src="get-shit-done-1.4.1/bootstrap3/js/bootstrap.js" type="text/javascript"></script>
  	<script src="get-shit-done-1.4.1/assets/js/gsdk-checkbox.js"></script>
  	<script src="get-shit-done-1.4.1/assets/js/gsdk-radio.js"></script>
  	<script src="get-shit-done-1.4.1/assets/js/gsdk-bootstrapswitch.js"></script>
  	<script src="get-shit-done-1.4.1/assets/js/get-shit-done.js"></script>
    <script src="get-shit-done-1.4.1/assets/js/custom.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
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

            $("#eatDateTime").datetimepicker();

            $('#upQuantity').on('click', function () {
               var aaa = parseInt($("#eatMl").val()) + 10;
               $("#eatMl").val(aaa);
            })
            $('#downQuantity').on('click', function () {
              var bbb = parseInt($("#eatMl").val()) - 10;
              $("#eatMl").val(bbb);
            })
            $('#upRiceQuantity').on('click', function () {
               var aaa = parseInt($("#eatRice").val()) + 10;
               $("#eatRice").val(aaa);
            })
            $('#downRiceQuantity').on('click', function () {
              var bbb = parseInt($("#eatRice").val()) - 10;
              $("#eatRice").val(bbb);
            })

            $( ".widget input[type=submit], .widget a, .widget button" ).button();
            $("button, input, a" ).click( function( event ) {
              event.preventDefault();
            } );
    } );
  </script>
  <style>

  </style>

</html>
