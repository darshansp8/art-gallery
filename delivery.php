<?php 
require('config1.php');

	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gallery');


if ($_SESSION['flag']==0) {
	header('location:login.php');
}

if ($_SESSION['flag']==1) {
	header('location:index.php');
}


	$username = $_SESSION['username'];
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Art</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


<style type="text/css">		

*{
	padding: 0;
	margin: 0;
}	

body {
    font-size: 2.5vh;
    font-family: Tahoma;
    width: 100vw;
    overflow-x: hidden;
}

header{
	position: relative!important;
	background: rgba(0,0,0,.85);
}

h2{
	color: white!important;
}

table{
    width: 70%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
    letter-spacing: 0.1vw;
    word-spacing: 1vw;
}

tr {
    border-bottom: 1px solid #cbcbcb;
}

th{
	margin-top: 15vw;
}

th, td{
    border: none;
    height: 4vw;
    padding: 0 2vw;
}

tr:hover {
    background: #F5F5F5;
}

form {
    width: 65%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 0.5vh solid #000000; 
    border-radius: 5px;
}

#along{
	width: 35%!important;
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 2vw;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
    box-shadow: 0 0.2vw 0.5vw black;
    border: 0.2vh solid black;
}

.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    box-shadow: 0 0.2vw 0.5vw black;
    border: 0.2vh solid black;
	border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    box-shadow: 0 0.2vw 0.5vw black;
    border: 0.2vh solid black;
	border-radius: 3px;
    background: #800000;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}

.btn:hover,.del_btn:hover,.edit_btn:hover{
	transition: 0.2s;
	background: rgba(0,0,0,0.75);
	box-shadow: 0 0 0 black;
}

ul{
	widows: 100vw;
}

i{
	color: white!important;
	float: right!important;
}

li a,li{
            font-family: Tahoma!important;
            color: white!important;
            text-transform: uppercase;

        }

ul{
            float: right;
        }

a{
	text-decoration: none;
}

</style>

</head>

<body alink="white" vlink="white">

	<header>
		
		<a href="index.php"><h2><span>P</span>ortfolio</h2></a>

		<ul>

		<li><a href="adminmain.php"><i id="navitem" class="fas fa-user"></i></a></li>
		
        <li><a href="login.php" name="logout"><i id="navitem" class="fas fa-power-off"></a></i></li>

        <li><?php echo $_SESSION['username']; ?></li>

        </ul>
        	
	</header>


	<?php if (isset($_SESSION['message'])): ?>

	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>

	<?php endif ?>

<table>
	<thead>
		<tr>
			<th>Order Id</th>
			<th>User</th>
			<th>Ordered Item</th>
			<th>Quantity</th>
			<th>Action</th>
		</tr>
	</thead>

	<?php if (isset($_SESSION['message'])): ?>
k
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>

	<?php endif ?>

	<?php $results = mysqli_query($db, "SELECT * FROM orderlist WHERE status = '0' "); ?>

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['orderid']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php 
                $itemid = $row['item']; 
                $results = mysqli_query($db, "SELECT * FROM paintings WHERE id = '$itemid'"); 
                $name = mysqli_fetch_array($results); 
                echo $name['art_name']."   (by-".$name['artist'].")";
                ?> 
            </td>
			<td><?php echo $row['quantity']; ?></td>
			<td>
				<a href="?deliver=<?php echo $row['orderid']; ?>" name="deliver" class="del_btn">Deliver!</a>
			</td>
		</tr>

	<?php } ?>

</table>

	
	<?php 

	if (isset($_GET['deliver'])) {
		$id = $_GET['deliver'];
		
		mysqli_query($db, "UPDATE `orderlist` SET status = '1' WHERE orderid = '$id'");
		$_SESSION['message'] = "Item Delivered!";

		$newquant = $name['quant'] - $row['quantity'];

		mysqli_query($db, "UPDATE `paintings` SET quant = '$newquant' WHERE id = '$itemid'");
		
	}

?>
<!--
			,filename=$newfilename,art_name=$newart_name,cost=$newcost,width=$newwidth,height=newheight,quant=$newquant-->
</body>
</html>