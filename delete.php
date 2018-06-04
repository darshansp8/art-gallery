<?php
require('config1.php');

$id = $_GET['id'];
	$delete ="delete * from paintings where id = '$id'";
	$query_run=mysqli_query($con,$delete);
	header('location : admin.php');

?>