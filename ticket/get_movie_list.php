<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
	// Parse SQL
	$confirm = "SELECT MV_NUM,MV_NM FROM MV";
	$result = oci_parse($conn,$confirm);
	oci_execute($result);

	echo "<ul style='list-style:none;'>";
	while($row=oci_fetch_row($result))
	{
		$strTok = explode('(',$row[1]);
		$mv_nm = $strTok[0];

		echo "<li><button type='button' class='mv_button' value='";
		echo "$row[0]";
		echo "'>";
		echo "$mv_nm";
		echo "</button></li>";	
	}

	echo "</ul>";
?>
