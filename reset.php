<?php
require('dbconfig1/config1.php');
?>

<HTML>

<head>

<script type="text/javascript" src="src/jquery1.js"></script>

<script type="text/javascript" src="src/scroll.js"></script>

<link rel="stylesheet" href="css/style.css">

<link rel="shortcut icon" href="favicon.png">

<style type="text/css">

	#tint{
		background: rgba(255,255,255,0.5);
		height: inherit;
		width: inherit;
		overflow: hidden;
	}

	#get-info{
		top: 15vh;
	}

</style>

</head>

<body vlink="white" a link="white">

<div id="resetSection">

<div id="tint">
	
	<form id="get-info" method="post">

		<p>&nbsp;<input id="textbox" maxlength="30" name="username" placeholder="username" size="20" type="text" required/></p>

		<p id="bold">*Security Question</p>

		<p>&nbsp;<input id="textbox" maxlength="30" name="r-mname" placeholder="Mother's name" size="20" type="text" required/></p>

		<p id="bold">Enter Your New Password</p>

		<p>&nbsp;<input id="textbox" maxlength="30" name="n-password" placeholder="new password" size="20" type="password" required/></p>
		
		<p><input id="btn" name="reset" type="submit" value="Reset Password " /></p>

		<?php
		     if(isset($_POST['reset']))
			 {
			 	 echo'<script type="text/javascript">alert("Reset button clicked")
						 </script>';
				 $username=$_POST['username'];
				 $mname=$_POST['r-mname']; 
				 $temppasscode=$_POST['n-password'];
				 $query="select * from userdata WHERE username='$username' AND mother='$mname'";
				 $query_run=mysqli_query($con,$query);
				 if(mysqli_num_rows($query_run)>0)
					 {
				 	  	echo'<script type="text/javascript">alert("Account Found")
						 </script>';
						 $queryreset="update userdata set passcode='$temppasscode' WHERE username='$username' AND mother='$mname'";
						 $query_run=mysqli_query($con,$queryreset);
						 if($queryreset){
						 	 echo'<script type="text/javascript">alert("Reset Successful")
						 </script>';
						 }
					 }

				 else{
				 	echo'<script type="text/javascript">alert("Invalid Credentials")
						 </script>';
				 }
			 }
		?>
	</form>

</div>

</div>



</body>

<footer>
</footer>

</HTML>
