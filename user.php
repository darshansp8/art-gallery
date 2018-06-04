<?php
require('config1.php');

	ob_start();
	session_start();
	if ($_SESSION['flag']==0) {
		header('location:login.php');
	}

	if ($_SESSION['username']=='admin') {
		header('location:adminmain.php');
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'gallery');
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

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
    height: 100vh;
    width: 100vw;
    /*background: #696969;*/
    background: -webkit-linear-gradient(top,#f3f2f2 20%,#f9fbf5 80%,#f3f2f2 100%);
}

header{
	position: relative!important;
	background: black;
    box-shadow: 0 1vw 5vw 0.2vw black;
}

h2{
	color: white!important;
}

table{
    width: 40vw;
    height: 50vh;
    height: 1vh auto;
    overflow-y: scroll;
    margin-left: 5vw;
    margin-top: 12vh;
    text-align: left;
    letter-spacing: 0.1vw;
    word-spacing: 1vw;
    box-shadow: 0 0.2vw 0.5vw black;
    font-size: 1vw;
    border-collapse: collapse;
}

tr {
    border-bottom: 1px solid #cbcbcb;
    height: 7vh!important;
    line-height: 1vh!important;
}

th{
	margin-top: 15vw; 
    color: white;
}

th, td{
	width: 15vw auto;
    padding: 0 2vw;
    border: 0!important;
}

td:hover {
    background: #F5F5F5;
}

thead{
    width: 100%!important;
    background: black;
}

form {
	width: 30vw;
    position: absolute;
    right: -10vw;
    top: 50vh;
    transform: translate(-50%,-50%);
    text-align: left; 
    border: 0.5vh solid #bbbbbb; 
    border-radius: 5px;
}

.input-group {
    margin: 10px 0px 10px 0px;
    margin-left: 2vw;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 2vw;
    width: 10vw ;
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
    position: absolute;
    right: 6vw;
    margin: 30px auto; 
    padding: 10px;
    margin-top: 15vh!important; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    text-align: center;
    opacity: 0;
    animation-name: message;
    animation-duration: 2s;
}

@keyframes message {
    50%{
        opacity: 1;
    }
    100%{
        opacity: 0;
    }
}

.btn:hover,.del_btn:hover,.edit_btn:hover{
	transition: 0.2s;
	background: rgba(0,0,0,0.75);
	box-shadow: 0 0 0 black;
}

select{
	height: 3vw;
    width: 25vw;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    background: black;
    color: white;
    border: 1px solid gray;
}

li{
	color: white;
    text-transform: capitalize;
}

form{
    width: 65vh;
    position: absolute;
    border: 0px solid black;
    padding-bottom: 2vh;
    position: absolute;
    border-radius: 2vh;
    top: 50vh;
    right: -20vh;
    background: orange;
    transform: translate(-50%,-50%);
    padding-left: 5vh;
    box-sizing: border-box;    
    box-shadow: 0 1vw 5vw 0.2vw black;
}

        input{
            height: 3vh;
            width: 90%;
            background: rgba(255,255,255,0.2);
            margin-bottom: 2vh;
            margin-top: 2vh;
            border: 1px solid grey;
            border-radius: 0.5vh;
            padding-left: 2vh;
            font-weight: bold;
        }

        .cardno{
            padding: 2vh 5vh;
            width: 40vh!important;
            padding-right: 10vh!important;

        }

        .cvv, .month, .year{
            height: 3.5vh;
            width: 90%;
            background: rgba(255,255,255,0.2);
            border: 1px solid gray;
            border-radius: 0.5vh;
            padding-left: 2vh;
            font-weight: bold;
            color: black;
        }

        .month{
            width: 11vh;
            font-size: 1.5vh;
        }

        .year{
            width: 15vh;
            font-size: 1.5vh;
        }

        #price{
            position: absolute;
            float: left;
            color:white;
            margin-top: 2vh;
        }

        button[type=submit]{
            float: right;
            text-align: right;
            padding-right: 3vh;
            margin: 0!important;
            width: 65vh;
            height: 6vh;
            margin-top: 2vh;
            background-color: black;
            margin-top: 2vh!important; 
            border: 0;
            color: white;
            border-radius: 0.5vh;
            margin-left: -5vh!important;
            padding-left: 5vh!important;
        }

        p{
            font-family: calibri;
            text-align: center;
            font-size: 30px;
            color: #f9dda6;
        }

        a{
        	text-decoration: none;
        }

        form p{
            color: black;
            font-size: 3vh;
            float: right;
            margin-right: 2vw;
            padding-top: 1vh;
            font-weight: bold;
        }
        
        #item{
            width: 100vh!important;
        }

</style>

</head>

<body alink="white" vlink="white">

<header>
		
		<a href="index.php"><h2><span>P</span>ortfolio</h2></a>
		
		<ul>
			
			<li><a href="login.php" name="logout"><i id="navitem" class="fas fa-power-off"></a></i></li>

			<li><?php echo $_SESSION['username']; ?></li>
		
		</ul>

</header>


<table>
	<thead>
		<tr>
			<th id="item">Ordered Item</th>
			<th>Quantity</th>
			<th>Action</th>
		</tr>
	</thead>

	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
            echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>

	<?php endif ?>

	<?php $results = mysqli_query($con, "SELECT * FROM orderlist WHERE username = '$username' AND status = '0' "); 

		$totalcost = 0;
	?>

	<tbody>
	<?php while ($row = mysqli_fetch_array($results)) { 

        ?>

		<tr>
            <td id="item">
                <input type="text" name="orderid" value="<?php echo $row['orderid']; ?>" style="display: inline; width: 2vh;">
                <?php
                $itemid = $row['item']; 
                $results = mysqli_query($db, "SELECT * FROM paintings WHERE id = '$itemid'"); 
                $name = mysqli_fetch_array($results); 
                echo $name['art_name']." (by-".$name['artist'].")";
                ?> 
            </td>
			<td><?php echo $row['quantity']; ?></td>
			<td>
				<a href="?del=<?php echo $row['orderid']; ?>" name="del" class="del_btn">Remove!</a>
			</td>
			<?php $totalcost = $totalcost + $name['cost']*$row['quantity']?> 
		</tr>

	<?php } ?>

    </tbody>

</table>

<form method="post">
        <div id="white"><p>Payment</p>
    	<b><input type="text" class="card" name="cardno" placeholder="Card Number"  /></b><br>
    	<input type="text" class="cvv" name="cvv" placeholder="CVV"  />
    	<select name="mon" class="month">
    		<option value="">MM</option>
    	    <option value="1">1</option>
    		<option value="2">2</option>
    		<option value="3">3</option>
    		<option value="4">4</option>
    		<option value="5">5</option>
            <option value="6">6</option>
    	    <option value="7">7</option>
    	    <option value="8">8</option>
    	    <option value="9">9</option>
    	    <option value="10">10</option>
    	    <option value="11">11</option>
    	    <option value="12">12</option>
    	</select>

    	<?php
    	  $year = 2018;
    	 ?>
    	 <select name="year" class="year">
            <option>YY</option>
    	 	<?php while ($year <= 2025) 
    	 	{
    	 		echo '<option value ="'.$year.'">'.$year.'</option>';
    	 		$year = $year + 1;
    	 	}
    	 	?>
    	 </select>
        </div>
         <p id="price">₹<?php echo $totalcost;?>/-</p>   
            <center><button type="submit" name="payment">Proceed</button></center>
        
         <?php

            if (isset($_POST['payment'])) {

                $orderid = $_POST['orderid'];
                $card = $_POST['cardno'];
                $cvv = $_POST['cvv'];
                $month = $_POST['mon'];
                $year = $_POST['year'];

                // $order = mysqli_query($con, " INSERT INTO orderlist(`username`, `item`,`quantity`) VALUES ('".$username."','4','5') " );

                $query = " SELECT * FROM bank WHERE card = '$card' AND cvv = '$cvv'";

                $bank = mysqli_query($con,$query);

                $amount = mysqli_fetch_assoc($bank);

                if ($totalcost > $amount['amount']) {

                    $_SESSION['message'] = "Order Unsuccessful!";

                    header('location:user.php');
                    
                }

                $amnt = $amount['amount'] - $totalcost;

                $new = mysqli_query($con, "UPDATE bank SET amount= '$amnt' WHERE card = '$card' AND cvv = '$cvv' " );
                
		        mysqli_query($con, "UPDATE orderlist SET status = '1' WHERE orderid = '$orderid'");
        		
                $_SESSION['message'] = "Item Would be Delivered Soon!";

		        $newquant = $name['quant'] - $row['quantity'];

		        mysqli_query($con, "UPDATE paintings SET quant = '$newquant' WHERE id = '$itemid'");

            }

         ?>

         <?php 

        if (isset($_GET['del'])) {
            
            $id = $_GET['del'];

            $results = mysqli_query($db, "SELECT * FROM orderlist WHERE orderid = '$id'");

            $row = mysqli_fetch_array($results);

            $quantity = $row['quantity'];

            $_SESSION['message'] = $quantity." Paintings Returned To Stock";

            $paintingid = $row['item'];

            $fetch = mysqli_query($db, "SELECT * FROM paintings WHERE id = '$paintingid'");

            $fetchrow = mysqli_fetch_array($fetch);

            $stock = $fetchrow['quant'];

            $new = ((int)$stock+(int)$quantity);

            $update = mysqli_query($con,"UPDATE paintings SET quant ='$new' WHERE id = '$paintingid' ");

            mysqli_query($db, "DELETE FROM orderlist WHERE orderid=$id");
            
            $_SESSION['message'] = "Records deleted!";
        }

        ?>

    </form>

</body>

</html>