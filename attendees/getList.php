
<?php
	include("../conf/dbcon.php");
	
	$part =   (isset($_POST["part"]) && $_POST["part"]) ? $_POST["part"] : "";

	if($part!="")
		$part = "WHERE part = '$part' ";

	$sql = "SELECT * FROM wedding_attendees $part;";
	$result = mysqli_query($con, $sql);
	$total = 0;
	$st = "";
	while ( $row = mysqli_fetch_assoc($result) ) {
		$pk = $row['pk'];
		$part = $row['part'];
		$relation = $row['relation'];
		$name = $row['name'];
		$num_of_attendees = $row['num_of_attendees'];
		$w_date = $row['w_date'];
		$total += (int)$num_of_attendees;
		$st.="<tr>";
		$st.= "<td>$pk</td>";
		$st.= "<td>$part</td>";
		$st.= "<td>$relation</td>";
		$st.= "<td>$name</td>";
		$st.= "<td>$num_of_attendees</td>";
		$st.= "<td>$w_date</td>";
		$st.= "</tr>";
	}
	$res['td']= $st;
	$res['total'] = $total;
	echo json_encode($res, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	mysqli_close($con);
?>