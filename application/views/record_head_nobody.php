<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8" />
              <link rel="apple-touch-icon" sizes="76x76" href="/etc/assets/img/apple-icon.png">
            	<link rel="icon" type="image/png" href="/etc/assets/img/favicon.png">
            	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            	<title>기록하기</title>
              <!-- <meta name="viewport" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' /> -->
              <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1"> -->
              <meta content="yes" name="apple-mobile-web-app-capable" />
              <meta content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" name="viewport" />
              <!-- CSS -->
              <!-- <link href="dist/css/fs-modal.min.css" rel="stylesheet"> -->
              <link rel="stylesheet" href="/etc/assets/css/demo.css"/>
              <link rel="stylesheet" href="/etc/bootstrap3/css/bootstrap-datetimepicker.min.css"/>
              <link rel="stylesheet" href="/etc/assets/css/gsdk.css"/>
              <!-- <link href="/etc/bootstrap3/css/bootstrap.min.css" rel="stylesheet" /> -->
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
              <link rel="stylesheet" href="/etc/assets/css/custom.css"/>
                <!--     Font Awesome     -->
              <link rel="stylesheet" href="/etc/bootstrap3/css/font-awesome.css"/>
              <!-- <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'> -->
              <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
              <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">


              <!-- JavaScript -->
              <script type="text/javascript" src="/etc/jquery/jquery-1.10.2.js"></script>
              <script type="text/javascript" src="/etc/assets/js/jquery-ui-1.10.4.custom.min.js"></script>
              <!-- <script src="/etc/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script> -->
              <script type="text/javascript"  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
              <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
              <!-- <script src="dist/js/fs-modal.min.js"></script> -->
              <script type="text/javascript"  src="/etc/assets/js/gsdk-checkbox.js"></script>
              <script type="text/javascript"  src="/etc/assets/js/gsdk-radio.js"></script>
              <script type="text/javascript"  src="/etc/assets/js/gsdk-bootstrapswitch.js"></script>
              <script type="text/javascript"  src="/etc/assets/js/get-shit-done.js"></script>
              <script type="text/javascript"  src="/etc/assets/js/custom.js"></script>

              <!-- <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script> -->

              <!-- https://www.malot.fr/bootstrap-datetimepicker/index.php -->
              <script type="text/javascript"  src="/etc/bootstrap3/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
              <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
              <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-en-US.min.js"></script>

            </head>
            <style>
                .navbar-header .icon-bar {
                  color: black;
                  border-color: black;
                  background-color: white;
                }
            </style>

            <body>
              <?php
              if($this->session->userdata('is_login')){
              ?>

              <div class="container">
                <!-- <div class="blurred-container">
                    <div class="img-src" style="background-image: url('/etc/assets/img/bg.jpg')"></div>
                </div> -->
                  <!-- <nav class="navbar navbar-ct-blue navbar-transparent navbar-fixed-top" role="navigation"> -->
                  <nav class="navbar navbar-ct-blue navbar-transparent navbar-fixed-top" role="navigation">
                    <div class="container">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                          <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> -->
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false" aria-controls="navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>                          
                      </div>
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse" id="navbar-collapse-1">
                          <ul class="nav navbar-nav navbar-right">
                                <?php
                                if($this->session->userdata('is_login')){
                                ?>
                                  <li><a href="<?=base_url("record/record_list")?>" class="btn btn-round btn-default">기록보기</a></li>
                                  <li><a href="<?=base_url("record/index")?>" class="btn btn-round btn-default">기록하기</a></li>
                                  <li><a href="<?=base_url("report/index")?>" class="btn btn-round btn-default">보고서</a></li>
                                  <li><a href="<?=base_url("auth/member")?>" class="btn btn-round btn-default">마이페이지</a></li>
                                  <li><a href="<?=base_url("auth/logout")?>" class="btn btn-round btn-default">로그아웃</a></li>
                                <?php
                                }
                                ?>
                           </ul>
                      </div>
                      <!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                  </nav>
              </div><!--  end container-->

              <?php
              }
              ?>
