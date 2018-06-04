<?php 
require('config1.php');
echo $_SESSION['orderpainting'];
echo $_SESSION['orderquant'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <style type="text/css">

        form{
            width: 45vh;
            height: 70vh;
            border: 5px solid black;
            position: absolute;
            border-radius: 2vh;
            border-bottom-left-radius: 2vh;
            top: 50vh;
            right: 0;
            transform: translate(-50%,-50%);
            padding-left: 5vh;
            box-sizing: border-box;
        }

        input{
            height: 3vh;
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
            width: 6vh;
            height: 3vh;
            border: 1px solid gray;
            border-radius: 0.5vh;
            padding-left: 2vh;
            font-weight: bold;
        }

        .month{
            width: 9vh;
        }

        .year{
            width: 15vh;
        }

        #price{
            float: left;
        }

        button[type=submit]{
            padding-left: 2vh;
            padding-right: 2vh;
            width: 15vh;
            height: 7vh;
            background-color:#039613;
            margin-top: 4vh; 
            border: 0;
            color: white;
            border-radius: 0.5vh;
        }

        p{
            font-family: calibri;
            text-align: center;
            font-size: 30px;
            color: #f9dda6;
        }

        #white{
            border-left: 5vh solid white;
            background: white;
        }
        
    </style>
</head>
<body alink="white" vlink="white">

<?php

session_start();
require('config1.php');
ob_start();

if ($_SESSION['flag'] == 0) {
    header('location:login.php');
}

$username = $_SESSION['username'];	

echo $_SESSION['username'];

 $results = mysqli_query($con, "SELECT * FROM orderlist where username = '$username' AND status ='0' " ); ?>

<table>
	<thead>
		<tr>
			<th>orderid</th>
			<th>Product</th>
			<th>Cost</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { 
		$itemid = $row['item'];
		$fetch = mysqli_query($con, "SELECT * FROM paintings where id = '$itemid'" );
		$found = mysqli_fetch_array($fetch);	
		?>
		<tr>
			<td><?php echo $row['orderid']; ?></td>
			<td><?php echo $row['item']; ?></td>
			<td><?php echo $row['quantity']; ?> x <?php echo $found['cost']; ?><</td>
			<td>
				<a href="?edit=<?php echo $row['id']; ?>" name="edit" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="?del=<?php echo $row['id']; ?>" name="del" class="del_btn">Delete</a>
			</td>
		</tr>

	<?php } ?>

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
         <p id="price">₹200/-</p>   
            <center><button type="submit" name="payment">Proceed</button></center>
        
         <?php

            if (isset($_POST['payment'])) {
                $card = $_POST['cardno'];
                $cvv = $_POST['cvv'];
                $month = $_POST['mon'];
                $year = $_POST['year'];

                // $order = mysqli_query($con, " INSERT INTO orderlist(`username`, `item`,`quantity`) VALUES ('".$username."','4','5') " );

                $query = " SELECT * FROM bank WHERE card = '$card' AND cvv = '$cvv'";

                $bank = mysqli_query($con,$query);

                $amount = mysqli_fetch_assoc($bank);

                $amnt = $amount['amount'] - 200;

                $new = mysqli_query($con, "UPDATE bank SET amount= '$amnt' WHERE card = '$card' AND cvv = '$cvv' " );

                $bank = mysqli_query($con,$new);

            }

         ?>

    </form>
</body>
</html>