<?php
  include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
  
  // set password
  $pass = "123456";
  
  // configuration password
  if($_POST["isPassword"]==$pass){
      echo("<script>location.replace('./menu.html');</script>"); 
    }
    else{
      echo("<script>alert('비밀번호가 틀렸습니다');</script>");
      echo("<script>location.replace('/index.html');</script>"); 
    }
?>
