<?php 
require('config1.php');

session_start();

ob_start();

if ($_SESSION['flag']==0) {
	header('location:login.php');
}

if ($_SESSION['flag']==1) {
	header('location:index.php');
}


	$id = 0;
	$artist = '';
	$filename = '';
	$art = '';
	$cost = '';
	$width = '';
	$height = '';
	$quant = '';

	$db = mysqli_connect('localhost', 'root', '', 'gallery');
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$newartist=$_POST['newartist'];
		$newfilename=$_POST['newfilename'];
		$newart_name=$_POST['newart_name'];
		$newcost=$_POST['newcost']; 
		$newwidth=$_POST['newwidth']; 
		$newheight=$_POST['newheight']; 
		$newquant=$_POST['newquant'];
		$update=true;

		$query="select * from paintings";
				 		
		$query_run=mysqli_query($con,$query);

		$newid=mysqli_num_rows($query_run) + 1;

		$query3="insert into paintings values('$newid','$newartist','$newfilename','$newart_name','$newcost','$newwidth','$newheight','$newquant')";
		$query_run= mysqli_query($con,$query3);
		if($query_run)
		{
			echo'<script type="text/javascript">alert("Record Registered")</script>';
		}
		else
		{
			echo'<script type="text/javascript">alert("error")</script>';
		}		 	
	}

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM paintings WHERE id=$id");

		if (mysqli_num_rows($record) == 1) {
			$n = mysqli_fetch_array($record);
			$id = $n['id'];
			$artist = $n['artist'];
			$filename = $n['filename'];
			$art = $n['art_name'];
			$cost = $n['cost'];
			$width = $n['width'];
			$height = $n['height'];
			$quant = $n['quant'];


			if (isset($_POST['update'])) {
				$newartist=$_POST['newartist'];
				$newfilename=$_POST['newfilename'];
				$newart_name=$_POST['newart_name'];
				$newcost=$_POST['newcost']; 
				$newwidth=$_POST['newwidth']; 
				$newheight=$_POST['newheight']; 
				$newquant=$_POST['newquant'];
				$query3= "UPDATE paintings SET artist='$newartist',filename='$newfilename',art_name='$newart_name',cost='$newcost',width='$newwidth',height='$newheight',quant='$newquant' WHERE id='$id'";
				$query_run= mysqli_query($con,$query3);
				if($query_run)
				{
					echo'<script type="text/javascript">alert("Record Updated")</script>';
				}
			}

		}

	}


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


</style>

</head>

<body alink="white" vlink="white">

	<header>
		
		<h2><span>P</span>ortfolio</h2>

		<ul>

		<li><a href="delivery.php"><i id="navitem" class="fas fa-shopping-cart"></i></a></li>
			
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

	<?php $results = mysqli_query($db, "SELECT * FROM paintings"); ?>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Artist</th>
			<th>Filename</th>
			<th>Art</th>
			<th>Cost</th>
			<th>Dimensions</th>
			<th>Quantity</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['artist']; ?></td>
			<td><?php echo $row['filename']; ?></td>
			<td><?php echo $row['art_name']; ?></td>
			<td><?php echo $row['cost']; ?></td>
			<td><?php echo $row['width']; ?><b>&nbsp;x&nbsp;</b><?php echo $row['height']; ?></td>
			<td><?php echo $row['quant']; ?></td>


			<td>
				<a href="?edit=<?php echo $row['id']; ?>" name="edit" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="?del=<?php echo $row['id']; ?>" name="del" class="del_btn">Delete</a>
			</td>
		</tr>

	<?php } ?>

</table>

	<form method="post" action="">
		<div class="input-group">
			<label>Artist</label>
			<input type="text" style="display: none;" name="id" value="<?php echo $id; ?>">
			<input type="text" name="newartist" value="<?php echo $artist; ?>">
		</div>
		<div class="input-group">
			<label>Filename</label>
			<input type="text" name="newfilename" value="<?php echo $filename; ?>">
		</div>
		<div class="input-group">
			<label>Art</label>
			<input type="text" name="newart_name" value="<?php echo $art; ?>">
		</div>
		<div class="input-group">
			<label>Cost</label>
			<input type="text" name="newcost" value="<?php echo $cost; ?>">
		</div>
		<div class="input-group">
			<label>Dimensions</label>
			<input type="text" id="along" name="newwidth" value="<?php echo $width; ?>">&nbsp;&nbsp;&nbsp;
			<input type="text" id="along" name="newheight" value="<?php echo $height; ?>">
		</div>
		<div class="input-group">
			<label>Quantity</label>
			<input type="text" name="newquant" value="<?php echo $quant; ?>">
		</div>

		<div class="input-group">
			<button class="btn" type="submit" name="save" >Add</button>
		</div>
		<div class="input-group">
			<a href="?del=<?php echo $row['id']; ?>" name="update"><button class="btn" type="submit" name="update">Update</button></a>
		</div>
	</form>

	<?php 

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM paintings WHERE id=$id");
		$_SESSION['message'] = "Records deleted!"; 
		header('location: adminmain.php');
	}

?>
<!--
			,filename=$newfilename,art_name=$newart_name,cost=$newcost,width=$newwidth,height=newheight,quant=$newquant-->
</body>
</html>