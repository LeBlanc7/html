<?php
	session_start();

	if(isset($_SESSION['user_id']))
	{
		
		echo "<script>location.replace('ticket_paying.html?sch_num=".$_GET[sch_num]."";
		$check_list = $_GET['check'];
		$length = count($check_list);	
			
		for($i=0;$i<$length;$i++)
		{
			$var = (string)($i+1);
			$seat = "seat".$var;
			echo "&$seat=".$check_list[$i]."";
		} 
		echo "&seat_count=$length');</script>";
	}	

?>
