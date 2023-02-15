
<?php

	include("../conf/dbcon.php");
	
	$sql = "SELECT * FROM wedding_messages ORDER BY pk DESC;";
	$result = mysqli_query($con, $sql);
	mysqli_close($con);
	
	$output = "";
				
	while ( $row = mysqli_fetch_assoc($result) ) {
		$pk = $row['pk'];
		$writer = $row['writer'];
		$content = $row['content'];
		$w_date = $row['w_date'];
		$output .="<div class='carousel-cell'>";
		$output .="<h5>$writer";
		$output .="<svg style='margin-left:1rem;' onclick='deleteMessage($pk);' xmlns='http://www.w3.org/2000/svg' width='2rem' height='2rem' fill='red' class='bi bi-x-circle-fill' viewBox='0 0 16 16'><path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/></svg>";
		$output .=  "</h5><hr/>";
		$output .=  "<p>$content</p>";
		$output .=  "</div>";
		}
	echo $output;
	
?>