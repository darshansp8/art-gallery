<?php
require('config1.php');
ob_start();
session_start();
?>

<html>

<head>
	
<script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCu-a-aKN4IFqRXf5X3o_z-AHAhP5vOv8w",
    authDomain: "portfolio-ceb83.firebaseapp.com",
    databaseURL: "https://portfolio-ceb83.firebaseio.com",
    projectId: "portfolio-ceb83",
    storageBucket: "portfolio-ceb83.appspot.com",
    messagingSenderId: "939467952619"
  };
  firebase.initializeApp(config);
</script>

	<title>Art</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

	<style type="text/css">
		
		/*.fa-user{
			display: none;
		}*/

		a{
			text-decoration: none;
		}

		.fa-shopping-cart{
			visibility:hidden;
		}


		@media only screen and (max-width: 1024px){

			body{
				width: 100vw!important;
				height: auto;!important;
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
				margin-right: 1vh;
				font-size: 2vh!important;
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

<body alink="black" vlink="black">

	<!--<script language="javascript">
		prompt("To Best Experience The Website On Computer Hold Shift While Scrolling");
	</script>-->

	<script type="text/javascript">alert("To Best Experience The Website On Computer Hold Shift While Scrolling")</script>

	<header>
		
		<a href="index.php"><h2><span>P</span>ortfolio</h2></a>

		
		<ul>
			
			<li><i id="navitem" class="fas fa-shopping-cart"></i></li>
			
			<li><a href="user.php"><i id="navitem" class="fas fa-user"></i></a></li>
		
		</ul>
	
	</header>

	<div id="container">

		<?php

			$paintings="Select * from paintings";

			$query_run=mysqli_query($con,$paintings);

			while ($collection = mysqli_fetch_assoc($query_run)) {

			echo '<div id="details">';

			$_SESSION['paintingid']= $collection['id'];
			$name = $collection['filename'];
			$_SESSION['filename'] = $name;
					
			echo '<a name="click" href="artist.php?art='.$collection['id'].'" ><img src='.$name.'></a>';

			echo '</div>';
			}
			
		?>
		
	</div>

</body>

</html>