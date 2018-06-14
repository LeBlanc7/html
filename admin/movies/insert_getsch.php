<?php
    include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
   // Parse SQL
    $confirm = "SELECT LOC_NUM FROM LOC WHERE LOC_NM = '$_POST[loc]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    $row=oci_fetch_row($result);
    $loc_num = $row[0];

    $confirm = "SELECT THT_NUM FROM THT WHERE THT_NM = '$_POST[tht_nm]' AND LOC_NUM = '$loc_num'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);
    $row=oci_fetch_row($result);
    $tht_num = $row[0];

    $confirm = "SELECT SCR_STT_TIME FROM SCR_SCH WHERE LOC_NUM='$loc_num' AND THT_NUM = '$tht_num' AND SCH_DAY='$_POST[sch_day]'";
    $result = oci_parse($conn,$confirm);
    oci_execute($result);

	$temp = array('0','0','0','0','0','0');
	    
	while($row=oci_fetch_row($result))
    	{	
		if($row[0]==10000)
		{
			$temp[0] = 1;
		}
		 else if ( $row[0] == 100000)
		{
			$temp[1] = 1;
		}
		 else if ( $row[0] == 130000)
                {
                        $temp[2] = 1;
                }
		 else if ( $row[0] == 160000)
                {
                        $temp[3] = 1;
                }
		 else if ( $row[0] == 190000)
                {
                        $temp[4] = 1;
                }
		 else
		{
			$temp[5] = 1;
		}
		
	}

	
	for($j=0;$j<6;$j++)
	{
		if($temp[$j] == 0 ) {
			if($j == 0) {
			$data[] = array("time"=>'10000');
			}
			else if($j == 1) {
			$data[] = array("time"=>'100000');
			}
			else if($j == 2) {$data[] = array("time"=>'130000');}
			else if($j == 3) {$data[] = array("time"=>'160000');}
			else if($j == 4) {$data[] = array("time"=>'190000');}
			else {$data[] = array("time"=>'220000');}
		}
    	}

	echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	   
?>
