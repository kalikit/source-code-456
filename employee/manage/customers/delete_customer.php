
<?php
		include '../../../connectDB/ConnectDB.php';
		$sql = "DELETE FROM customers WHERE id = '$_GET[id]' ";
		mysqli_query($ketnoi,$sql);
		header('location: ./customers.php'); 
?> 