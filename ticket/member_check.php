<?php
	session_start();

	if(!isset($_SESSION['user_id']))
	{
		echo "<script>location.replace('nmem_ticket.html?sch_num=".$_GET[sch_num]."&tht_num=".$_GET[tht_num]."&loc_num=".$_GET[loc_num]."');</script>";
	}
	else
	{
		echo "<script>location.replace('ticket_seat_select.html?sch_num=".$_GET[sch_num]."&tht_num=".$_GET[tht_num]."&loc_num=".$_GET[loc_num]."');</script>";
	}

?>
