<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8" />
              <link rel="apple-touch-icon" sizes="76x76" href="/etc/assets/img/apple-icon.png">
            	<link rel="icon" type="image/png" href="/etc/assets/img/favicon.png">
            	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            	<title>기록하기</title>
              <meta name="viewport" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
              <!-- <link href="dist/css/fs-modal.min.css" rel="stylesheet"> -->
              <link href="/etc/assets/css/demo.css" rel="stylesheet" />
              <link href="/etc/bootstrap3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
              <link href="/etc/assets/css/gsdk.css" rel="stylesheet" />
              <link href="/etc/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
              <link href="/etc/assets/css/custom.css" rel="stylesheet" />
                <!--     Font Awesome     -->
              <link href="/etc/bootstrap3/css/font-awesome.css" rel="stylesheet">
              <!-- <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'> -->




              <script src="/etc/jquery/jquery-1.10.2.js" type="text/javascript"></script>
              <script src="/etc/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
              <script src="/etc/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
              <!-- <script src="dist/js/fs-modal.min.js"></script> -->
              <script src="/etc/assets/js/gsdk-checkbox.js"></script>
              <script src="/etc/assets/js/gsdk-radio.js"></script>
              <script src="/etc/assets/js/gsdk-bootstrapswitch.js"></script>
              <script src="/etc/assets/js/get-shit-done.js"></script>
              <script src="/etc/assets/js/custom.js"></script>
              <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
              <script src="/etc/bootstrap3/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            </head>
            <body>
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
                              <div class="logo-container">
                                <div class="logo">
                                    <img src="/etc/assets/img/new_logo.png">
                                </div>
                                <div style="color: white;">
                                    <h3 class="masthead-title"><?=$this->session->userdata('babyname');?></h3><h6>(<?=$this->session->userdata('birthday');?>생) <?=$this->session->userdata('nickname')?> 환영합니다.</h6>
                                </div>
                              </div>
                          </div>
                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                  <li>목록</li>
                                  <?php
                                  if($this->session->userdata('is_login')){
                                  ?>
                                    <li><a href="<?php echo base_url("record/record_list")?>" class="btn btn-round btn-default">기록보기</a></li>
                                    <li><a href="<?php echo base_url("auth/member")?>" class="btn btn-round btn-default">회원정보수정</a></li>
                                    <li><a href="<?php echo base_url("auth/login")?>" class="btn btn-round btn-default">로그아웃</a></li>
                                  <?php
                                  } else {
                                  ?>
                                    <li><a href="<?php echo base_url("auth/login")?>" class="btn btn-round btn-default">로그인</a></li>
                                    <li><a href="<?php echo base_url("auth/register")?>" class="btn btn-round btn-default">회원가입</a></li>
                                  <?php
                                }
                                  ?>
                             </ul>
                          </div>
                          <!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                      </nav>
                  </div><!--  end container-->
              </div>
