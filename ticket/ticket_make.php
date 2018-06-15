<?php
	session_start();

	if(isset($_SESSION['user_id']))
	{

		echo "<script>alert('성공적으로 예매가 되었습니다.');location.replace('/index.html');</script>";
	}

?>
