<?php

	include("../conf/dbcon.php");
	
	
	$writer =   (isset($_POST["writer"]) && $_POST["writer"]) ? $_POST["writer"] : "";
	$pwd =   trim((isset($_POST["pwd"]) && $_POST["pwd"]) ? $_POST["pwd"] : "");
	
	$content =   (isset($_POST["content"]) && $_POST["content"]) ? $_POST["content"] : "";
    $encrypted_passwd  = password_hash($pwd, PASSWORD_DEFAULT);    
	
	$select_sql = "SELECT * FROM wedding_messages WHERE writer='$writer' and content='$content';";
	
	$result_exist = mysqli_query($con,$select_sql);
	$dupcheck = mysqli_fetch_array($result_exist);

	if ($dupcheck != null)
	{
		return;
	}else{
	
	$insert_sql = "INSERT INTO wedding_messages(writer,pwd,content) VALUES('$writer','$encrypted_passwd','$content');";

	
	$result_exist = mysqli_query($con,$insert_sql);


	if($result_exist == 1)
		$result['success']	= true;
	else
		$result['success']	= false;
	
	
	echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
	mysqli_close($con);
	

?>