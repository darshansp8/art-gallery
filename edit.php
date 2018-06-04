<?php
	
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gallery');
	$name = "";
	$address = "";
	$id = $_GET['update'];

	echo '$id';
?>