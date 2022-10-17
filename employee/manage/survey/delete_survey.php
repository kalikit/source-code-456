<?php
		include '../../../connectDB/ConnectDB.php';
		$sql = "DELETE FROM surveys WHERE id = '$_GET[id]' ";
		mysqli_query($ketnoi,$sql);
		header('location: ./survey.php'); 
?> 