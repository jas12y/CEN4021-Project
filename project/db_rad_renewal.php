<?php 
	include "database_connector.php";
	$rads = array();
	$temp = mysqli_query($con,"SELECT * FROM kanjiinfo WHERE id='6288'");
	if($temp){
		while($row = mysqli_fetch_array($temp)) {
			$quer = "INSERT INTO rads(id, rad) VALUES('214', '$row[1]')";
			if(mysqli_query($con, $quer)) {
				echo "success";
				echo "$row[1]\n";
			}
			else {
				echo "failed to insert";
			}
		}
	}
	$new_rads = array();
	$i = 0 ;
	$temp3 = mysqli_query($con,"SELECT * FROM kanjiinfo WHERE ");
/*	for($i;$i < 214;$i++) {
	$search = $rads[$i];
	echo "$search \n";
	$temp2 = mysqli_query($con,"SELECT * FROM kanjiinfo WHERE kanji = '$search'");
	$row2 = mysqli_fetch_array($temp2);
	array_push($new_rads, $row2[1]);
	echo "$row2[1]\n";
}
	echo count($new_rads);
	$j = 0;
	for($j; $j<214; $j++) {
	$search = $new_rads[$j];
	echo "$search \n";
	}	*/
	echo "play\n";
?>
