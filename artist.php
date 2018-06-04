<?php
require('config1.php');
session_start();
ob_start();

$id = $_GET['art'];

if ($id == '') {
    header('location:index.php');
}

$paintings="select * from paintings where id = '$id'";

$query_run=mysqli_query($con,$paintings);

$collection = mysqli_fetch_array($query_run);

$_SESSION['artist'] = $collection['artist'];

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
	position: fixed!important;
	top: 0!important;
	z-index: 10;
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

li{
	color: white;
}

.container{
	margin-top: 12vh;
	width: 100vw;
	height: auto;
	top: 11vh;
	display: inline-grid;
	grid-template-columns: 1fr 1fr 1fr;
}

.containerimg{
	vertical-align: top;
    padding: 1vw;
    height: auto;
}

.containerimg img{
	position: relative;
    width: 30vw;
    vertical-align: top;
    padding: auto;
}

a{
    text-decoration: none;
}

li a,li{
    font-family: Tahoma!important;
    color: white!important;
    text-transform: uppercase;
}

ul{
    float: right;
}

#artist{
    text-transform: none!important;
    font-size: 2vh;
}



@media only screen and (max-width: 1024px){

            body{
                width: 100vw!important;
                height: auto!important;
                overflow-x: hidden!important;
            }

            header{
                position: absolute;
                top: -2vh!important;
                left: 0;
                width: 100%;
                height: 9vh!important;
                width: 100vw!important;
            }

            header span{
                font-size: 5vh!important;
            }

            header h2{
                font-size: 3vh!important;
            }

            li{
                margin-left: 0vh;
                font-size: 2vh!important;
            }

            header a{
                padding-left: 1vh!important;
                padding-right: 1vh!important;
            }

            #container,#details{
                margin-top: 6vh;
                display: block!important;
            }

            #container{
                height: auto!important;
                width: 100vw!important;
            }

            #details img{
                height: auto;
                width: 40vh!important;
            }

        }



	</style>

</head>
<body alink="white" vlink="white">

	<header>
		
		<a href="index.php"><h2><span>P</span>ortfolio</h2></a>

		<ul>

			<li id="artist">Artist : <?php echo $_SESSION['artist']; ?></li>

            <li><a href="user.php"><i id="navitem" class="fas fa-shopping-cart"></i></a></li>

            <li><a href="login.php" name="logout"><i id="navitem" class="fas fa-power-off"></a></i></li>

		    <li><?php echo $_SESSION['username']; ?></li>

        </ul>
			
	</header>



	<div class="container">

	<?php

			$artist = $_SESSION['artist'];

			$paintings="select * from paintings where artist = '$artist' ";

			$query_run=mysqli_query($con,$paintings);

			while ($collection = mysqli_fetch_array($query_run)) {
                $_SESSION['background'] = $collection['filename'];
				echo '                	
                	<div class="containerimg">
                    	
                    	<a name="redirect" href="art.php?redirect='.$collection['id'].'"><img src="'.$collection['filename'].'"></a>
               		</div> 

                    ';	

			}
		?>

    </div>

</body>
</html>