<?php
require_once '../../../connectDB/ConnectDB.php';
$id = $_GET['id'];
$status = $_GET['status'];
$query = "UPDATE customers SET trang_thai = $status WHERE id = $id";
$stmt = $ketnoi->prepare($query);
$stmt->execute();
header("location: ./customers.php");
?>