

<?php
@header("Content-type:text/html;charset=utf-8");
$mysql_hostname = 'ec2-52-78-31-158.ap-northeast-2.compute.amazonaws.com';
$mysql_username = 'phpuser';
$mysql_password = 'phpusr';
$mysql_database = 'A01';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
try
   {
$link = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
   if (!$link) {
      die('Could not connect: ' . mysql_error());
  }
 mysql_set_charset("utf-8", $link);
// "Database 선택
    $db_selected = mysql_select_db('A01', $link);
    if (!$db_selected) {
        die ('Can\'t use A01 : ' . mysql_error());
    }
  mysql_query("set names utf8");  //한글 깨짐 해결용
  switch($_POST['mode']){
          case 'newMember':  //insert MEMBER
          // ('$id','$pass','$nickname','$site')";
            $sql = "INSERT INTO MEMBER(email,passwd,name,center) values ('"
                   .mysql_real_escape_string($_POST['email'])."','"
                   .mysql_real_escape_string($_POST['pw'])."','"
                   .mysql_real_escape_string($_POST['name'])."','"
                   .mysql_real_escape_string($_POST['center'])."')";
            $result = mysql_query($sql);
            if (!$result) {
              die('Could not query:' . mysql_error());
            }else{
              // echo "true";
              $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
              echo $output;
            }
          break;
          case 'chkId':  //select MEMBER
                  $sql = "select name from MEMBER WHERE email = '"
                      .mysql_real_escape_string($_POST['email'])
                        ."'";
                  $result = mysql_query($sql);
                  if (!$result) {
                    die('Could not query:' . mysql_error());
                  }else{
                    $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                    echo $output;
                  }
                  break;
          case 'signin':
                  $sql = "select name, level, birthday from MEMBER WHERE email = '"
                        .mysql_real_escape_string($_POST['email'])
                        ."' and passwd = '"
                        .mysql_real_escape_string($_POST['pw'])."'";
                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))   // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output = '{ "result" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                  }
                  //센터정보가져오기
                  $sql = "select center, center_nm, start_hour, end_hour, period, address, owner, tel FROM SITEINFO WHERE center =  '"
                        .mysql_real_escape_string($_POST['center'])
                        ."'";
                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))    // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output .= ', "siteinfo" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                      $output .= '}';
                  }
                  echo $output;
                  break;
          case 'memberlistinfo':
                  $sql = "select email, name, level from MEMBER WHERE center = '"
                        .mysql_real_escape_string($_POST['center'])."'";

                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))    // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output .= '{"result" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                      $output .= '}';
                  }
                  echo $output;
                  break;
          case 'refresh':
                  $sql = "select R.hour, R.min, M.name from RESERVATION AS R LEFT OUTER JOIN MEMBER AS M ON R.email = M.email WHERE R.date = '"
                        .mysql_real_escape_string($_POST['date'])
                        ."' and R.center = '"
                        .mysql_real_escape_string($_POST['center'])."'";

                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))    // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output .= '{"result" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                      $output .= '}';
                  }
                  echo $output;
                break;
          case 'booking':
                  $sql = "insert into RESERVATION ( center, date, hour, min, email ) values ('"
                         .mysql_real_escape_string($_POST['center'])."','"
                         .mysql_real_escape_string($_POST['date'])."','"
                         .mysql_real_escape_string($_POST['hour'])."','"
                         .mysql_real_escape_string($_POST['min'])."','"
                         .mysql_real_escape_string($_POST['email'])."')";
                  $result = mysql_query($sql);
                  if (!$result) {
                    die('Could not query:' . mysql_error());
                  }else{
                    // echo "true";
                    $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                    echo $output;
                  }
                break;
          case 'bookingCancel':
                  $sql = "delete from RESERVATION where center = '".mysql_real_escape_string($_POST['center'])
                                                  ."' and date = '".mysql_real_escape_string($_POST['date'])
                                                  ."' and hour = '".mysql_real_escape_string($_POST['hour'])
                                                  ."' and min = '" .mysql_real_escape_string($_POST['min'])
                                                  ."' and email = '".mysql_real_escape_string($_POST['email'])
                                                  ."'";
                  $result = mysql_query($sql);
                  if (mysql_affected_rows() > 0) {
                    $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                    echo $output;
                  }else{
                    die('Could not query:' . mysql_error());
                  }
                break;
          case 'modiProfile':
                  $sql = "update MEMBER SET passwd = '".mysql_real_escape_string($_POST['pw'])
                                           ."',name = '".mysql_real_escape_string($_POST['name'])
                                           ."',birthday = '".mysql_real_escape_string($_POST['birthday'])
                                           ."',center = '".mysql_real_escape_string($_POST['center'])
                                           ."' WHERE email = '".mysql_real_escape_string($_POST['email'])
                                           ."'";

                  $result = mysql_query($sql);
                  if (!$result) {
                    die('Could not query:' . mysql_error());
                  }else{
                    // echo "true";
                    $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                    echo $output;
                  }
                break;
          case 'information':
                  $sql = "select seq, title, date from INFORMATION  where center = '".mysql_real_escape_string($_POST['center'])
                   . "' ORDER BY seq DESC";
                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))    // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output .= '{"result" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                      $output .= '}';
                  }
                  echo $output;
                  break;
          case 'infoDetail':
                  $sql = "select title, contents, date from INFORMATION where seq = '".mysql_real_escape_string($_POST['seq'])
                                                  ."'";

                  $result = mysql_query($sql);
                  if ($result) {
                    $rows = array();
                     while($r = mysql_fetch_assoc($result)) { // index 미포함 array 값 생성, //while($r = mysql_fetch_array($result))    // index 포함 array 값 생성
                         $rows[] = $r;
                      }
                      $output .= '{"result" : ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                      $output .= json_encode($rows, JSON_UNESCAPED_UNICODE);  // 한글깨지지 않기 위해 ,JSON_UNESCAPED_UNICODE 파라미터 추가
                      $output .= '}';
                  }
                  echo $output;
                  break;
          case 'insertInfo':
                  $sql = "insert into INFORMATION ( TITLE, CONTENTS) values ('"
                        //  .mysql_real_escape_string($_POST['seq'])."','"
                         .mysql_real_escape_string($_POST['title'])."','"
                         .mysql_real_escape_string($_POST['contents'])."')";
                  $result = mysql_query($sql);
                  if (!$result) {
                    die('Could not query:' . mysql_error());
                  }else{
                    // echo "true";
                    $output = '{"result": "true"} ';   //맴버정보  -- json 은 맴버정보 뿐 아니라 센터 정도도 한번에 조회해서 보낼 수 있다.
                    echo $output;
                  }
                break;
  }  //switch 문 종료
} // try 문 종료
catch(Exception $e)
    {
        echo $e->getMessage();
        // Note: Log the error or something
    }

?>
