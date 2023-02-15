<?php

	include("../conf/dbcon.php");
	
	
	$name =   (isset($_POST["name"]) && $_POST["name"]) ? $_POST["name"] : "";
	$part =   (isset($_POST["part"]) && $_POST["part"]) ? $_POST["part"] : "";
	$relation =   (isset($_POST["relation"]) && $_POST["relation"]) ? $_POST["relation"] : "";
	$num_of_attendees =   (isset($_POST["num_of_attendees"]) && $_POST["num_of_attendees"]) ? $_POST["num_of_attendees"] : "";
		
	$sql = "SELECT * FROM wedding_attendees WHERE name='$name' and part='$part' and relation='$relation'";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
		
	if($count == 0){
		$insert_sql = "INSERT INTO wedding_attendees(name,part,relation,num_of_attendees) VALUES('$name','$part','$relation',$num_of_attendees);";

		
		$result_exist = mysqli_query($con,$insert_sql);
		echo 1;
	}
	else{
	  echo 0;
	}
	mysqli_close($con);
	
	
?>