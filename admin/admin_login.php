<?php
    echo "<h1>&#60;관리자 페이지로 접속합니다&#62;</h1>";
    echo "<p>비밀번호를 입력하세요.</p>";
    echo "<form action='./admin_login_action.php' method='post' style='display : inline-flex'>";
    echo "<label id='password_tag'> Password </label> <input type='password' id='password_input' name='isPassword'>";
    echo "<input type='submit' id='submit_button' value='입력받기'> </b></form>";
?>
