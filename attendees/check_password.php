<?php
	$pwd =   (isset($_POST["pwd"]) && $_POST["pwd"]) ? $_POST["pwd"] : "";

	if($pwd == "20230225ph")
		$result['success']	= true;
	else
		$result['success']	= false;

	echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>