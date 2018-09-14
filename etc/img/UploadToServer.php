<?php

//    $file_path = "img//";
    $file_path = "babyprofile//";

    //$file_path = $file_path . "1123.jpg";  //-> 됨	
    $file_path = $_POST['folderName'] ."//"  . $_POST['newFileName'];  // 안됨
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {

        echo "success";
    } else{
        echo "fail";
    }
 ?>
-
