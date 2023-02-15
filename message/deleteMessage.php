<?php

	include("../conf/dbcon.php");
	
	$pk =   (isset($_POST["pk"]) && $_POST["pk"]) ? $_POST["pk"] : "";
	$pwd = (isset($_POST["pwd"]) && $_POST["pwd"]) ? $_POST["pwd"] : "";
	
	$select_sql = "SELECT pwd FROM wedding_messages WHERE pk=$pk;";
	
	$result_exist = mysqli_query($con,$select_sql);
	$dupcheck = mysqli_fetch_array($result_exist);
	
	$repwd = $dupcheck['pwd'];
	
	if (password_verify(trim($pwd), trim($repwd)))
	{
		$sql = "DELETE FROM wedding_messages WHERE pk=$pk;";
		$result = mysqli_query($con,$sql);
		
		$res['success']	= $result;
		
		
	}else{
			$res['success']	= false;
	}
	echo json_encode($res, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	mysqli_close($con);
?>