<!DOCTYPE html>
        <html>
            <head>
              <meta charset="utf-8" />
              <link rel="apple-touch-icon" sizes="76x76" href="/etc/assets/img/apple-icon.png">
            	<link rel="icon" type="image/png" href="/etc/assets/img/favicon.png">
            	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            	<title>기록하기</title>
            	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
              <meta name="viewport" content="width=device-width" />
              <link href="/etc/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
              <link href="dist/css/fs-modal.min.css" rel="stylesheet">
              <link href="/etc/assets/css/demo.css" rel="stylesheet" />
              <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
              <link href="/etc/assets/css/gsdk.css" rel="stylesheet" />
                <!--     Font Awesome     -->
              <link href="/etc/bootstrap3/css/font-awesome.css" rel="stylesheet">
              <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>

              <script src="/etc/jquery/jquery-1.10.2.js" type="text/javascript"></script>
              <script src="/etc/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
              <script src="/etc/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
              <script src="dist/js/fs-modal.min.js"></script>
              <script src="/etc/assets/js/gsdk-checkbox.js"></script>
              <script src="/etc/assets/js/gsdk-radio.js"></script>
              <script src="/etc/assets/js/gsdk-bootstrapswitch.js"></script>
              <script src="/etc/assets/js/get-shit-done.js"></script>
              <script src="/etc/assets/js/custom.js"></script>
              <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
              <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
            </head>
            <body>
              <?php
                if($this->session->flashdata('message')){
               ?>
               <script> alert(<?=$this->session->flashdata('message')?> );</script>
               <?php }
                ?>
              <script> alert(<?=$this->session->userdata('nickname')?>);</script>
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
                              </div>
                              <div>
                                <div class="brand">
                                <?=$this->session->userdata('nickname')?>
                                </div>
                              </div>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                  <li><a href="components.html">Components</a></li>
                                  <?php
                                  if($this->session->userdata('is_login')){
                                  ?>
                                    <li><a href="/index.php/record/record_list" class="btn btn-round btn-default">기록보기</a></li>
                                    <li><a href="/index.php/auth/member" class="btn btn-round btn-default">회원정보수정</a></li>
                                    <li><a href="/index.php/auth/login" class="btn btn-round btn-default">로그아웃</a></li>
                                  <?php
                                  } else {
                                  ?>
                                    <li><a href="/index.php/auth/login" class="btn btn-round btn-default">로그인</a></li>
                                    <li><a href="/index.php/auth/register" class="btn btn-round btn-default">회원가입</a></li>
                                  <?php
                                }
                                  ?>
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
                            <a href="/index.php/record"><h3>기록하기</h3></a>
                        </div>
                      </div>
                   </div>
              </div>
