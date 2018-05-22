<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
    // Parse SQL
    $user_id = $_POST['id'];
    $user_pw = $_POST['pw'];

    $confirm1 = "SELECT * FROM MEM WHERE ID='$_POST[id]' AND PW ='$_POST[pw]'";
    $result = oci_parse($conn,$confirm1);
    oci_execute($result);
    $row = oci_fetch_assoc($result);

    if(!$row)
    {
        echo ("<script>alert('등록되지 않은 ID이거나 비밀번호가 틀렸습니다.'); location.replace('login.html');</script>");
    }
    else{
	$user_name = $row['MEM_NM'];	

	session_start();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['user_name'] = $user_name;
	
	echo ("<script>alert('$user_name'+'님 환영합니다!'); location.replace('/index.html');</script>");	
	
    }
    oci_close($conn);
?>
