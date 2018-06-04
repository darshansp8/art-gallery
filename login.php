<?php
session_start();
require('config1.php');
$_SESSION['flag']=0;
$_SESSION['username'] = "";
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">

	body{
		overflow: hidden;
		font-family: 'Pecita';
		background: url(bg.png);
		background-position: center;
		background-size: 90%;
		background-repeat: no-repeat;
		background-blend-mode: darken;
	}
		
	#login{
		width: 30vw;
		height: 100vh;
		border: 0;
		padding-top: 20vh;
		border-top-left-radius: 15vw;
		position: absolute;
		left: 10vw;
		margin-top: 30vh;
		align-content: center;
		text-align: center;
		font-family: 'Tahoma';
		letter-spacing: 0.5vh;
	}

	#register{
		width: 30vw;
		height:70vh;
		border: 0;
		border-radius: 2vw;
		position: absolute;
		right: 10vw;
		top: 30vh;
		align-content: center;
		text-align: center;
		font-family: 'Tahoma';
		letter-spacing: 0.5vh;
	}

	#register input[type='button']{
		background-color: rgb(205, 16, 42);
	}

    input[type='text'],input[type='password']{
    	width: 25vw;
    	height: 4vh;
    	background: rgba(255,255,255,1);
    	margin-top: 2vh;
    	padding: 1px;
    	border-radius: 1vh;
    	padding-left: 2vw;
    	border: 0;
    	/*box-shadow: 2px 3px 5px; 
        */color: black;
        font-size: 2.5vh;
        font-weight: lighter;
    }

    input[type='button'],input[type='submit']{
    	font-family: 'Tahoma';
    	padding: 1vh 2vh 1vh 2vh;
    	margin-top: 5vh;
    	background-color: rgb(31, 172, 78);
    	color: white;
    	border-radius: 1vh;
    	border: 0;
    	font-size: 2.5vh;
    	font-weight: bold;
    	box-shadow: 2px 6px 8px black;
    	transition: 0.25s;
    }

    input[type='button']:hover,input[type='submit']:hover{
    	box-shadow: 2px 4px 6px black;
    }

    #line{
    	width: 2px;
    	height: 50vh;
    	position: absolute;
    	left: 50%;
    	top: 50%;
    	transform: translate(-50%,-50%);
    	background-color: white;
    	box-shadow: 0vh 1vh 5vh 0.5vh black;
    }

    a{
    	text-decoration: none;
    }

    @media only screen and(max-width: 1024px){
    	#interface{
    		display: block!important;
    		width: 50vh!important;
    	}

    	#register{
    		display: block;
    	}

    	body{
				width: auto
				!important;
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
				margin-right: 1vh;
				font-size: 2vh!important;
			}

			#login{
				width: 100vw!important;
				background-color: gray!important;
			}

    }
	</style>
</head>
<body>

	<header>
		
		<a href="index.php"><h2><span>P</span>ortfolio</h2></a>
		
		<ul>
			
			<li><i id="navitem" class="fas fa-shopping-cart"></i></li>
			
			<li><a href="login.php"><i id="navitem" class="fas fa-user"></a></i></li>
		
		</ul>
	
	</header>

	<div id="interface">
		
		<div id="form">

		<form id="login" method="post">

		<p>&nbsp;<input id="textbox" maxlength="30" name="username" placeholder="username" size="20" type="text" required/></p>

		<p>&nbsp;<input id="textbox" maxlength="30" name="password" placeholder="password" size="20" type="password" required/></p>

		<p><input id="btn" name="login" type="submit" value="Login" /></p>

		<?php
		     if(isset($_POST['login']))
			 {
			 	 $username=$_POST['username'];
				 $passcode=$_POST['password']; 
				 $query1="select * from userdata WHERE username='$username' AND password='$passcode'";
				 $query_run=mysqli_query($con,$query1);
				 if(mysqli_num_rows($query_run)>0)
					 {
					 	$_SESSION['username']=$username;
					 	$_SESSION['flag']=1;
					 	if ($_SESSION['username']=="admin") {
					 		$_SESSION['flag']=2;
					 	}
					 	header('Location:index.php');
					 }
					 
				 else{
				 	echo'<script type="text/javascript">alert("Invalid Credentials")
						 </script>';
					 }

			}
		?>

		</div>

	</form> 
		</div>

	</div>
	<div id="line">
		
	</div>

	<form id="register" method="post">

		<p>&nbsp;<input id="textbox" maxlength="30" name="r-name" placeholder="name" size="20" type="text" required/></p>


		<p>&nbsp;<input id="textbox1" maxlength="30" name="r-username" placeholder="username" size="20" type="text" required/></p>

		<p>&nbsp;<input id="textbox1" maxlength="30" name="r-password" placeholder="password" size="20" type="password" required/></p>

		<p>&nbsp;<input id="textbox1" maxlength="30" name="c-password" placeholder="confirm password" size="20" type="password" required/></p>

		

		<p>&nbsp;<input id="textbox1" maxlength="30" name="r-mname" placeholder="Mother's name(Security Question)" size="20" type="text" required/></p>

		<p><input id="btn" name="register" type="submit" value="Register For New Account" /></p>

		<a href="reset.php"><p><input id="btn" name="rd" type="button" value="Forgot Password ?" /></p></a>

	<script>

		$('#btn1').click(function(){

			$('#textbox-h').addClass('visible');	

		});	

	</script>

			<?php
		     if(isset($_POST['register']))
			 {
				 echo'<script type="text/javascript">alert("submit button clicked")</script>';
				 $name=$_POST['r-name'];
				 $username=$_POST['r-username'];
				 $passcode=$_POST['r-password']; 
				 $cpasscode=$_POST['c-password'];
				 $mother=$_POST['r-mname'];


				 if($passcode==$cpasscode)
				 {
					 $query2="select * from userdata WHERE username='$username'";
					 $query_run=mysqli_query($con,$query2);
					 if(mysqli_num_rows($query_run)>0)
					 {
						 echo'<script type="text/javascript">alert("already used")
						 </script>';
					 }
					 else
					 {
						 $query3="insert into userdata values('$name','$username','$passcode','$mother')";
						 $query_run= mysqli_query($con,$query3);
						 if($query_run)
						 {
							 echo'<script type="text/javascript">alert("registered")</script>';
							 header('location:login.php');
						 }
						 else
						 {
							 echo'<script type="text/javascript">alert("error")</script>';
						 }
						 
					 }
				 }
				 
				 else{
					 echo'<script type="text/javascript">alert("password and confirm password doesn not match")
					 </script>';				 
				 }			
			 }
			 ?>

	</form>


</body>
</html>