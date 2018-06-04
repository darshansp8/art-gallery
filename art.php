<?php 
require('config1.php');
session_start();

$id = $_GET['redirect'];

if ($id == '') {
   header('location: index.php');
}

$query = "select * from paintings where id = '$id'";

$query_run=mysqli_query($con,$query);

$background = mysqli_fetch_array($query_run);

$image = $background['filename'];

$orderitem = $background['art_name'];

$username = $_SESSION['username'];
                
$background = "Select * from paintings where filename= '$image'";

$query_run=mysqli_query($con,$background);

$fetch = mysqli_fetch_array($query_run);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Art</title>

    <link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" type="text/css" href="style1.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <style>

        *{
            margin:0;
            padding:0;
        }

        header{
            top: 0;
        }

        .imgcontainer{
            height: auto;
            margin-left: 5vw;
            width: 30%;
            margin-top: 7vw;
            display: inline-block;
            vertical-align: middle;
            background: url('default.jpg');
            background-size: cover;
            box-sizing: border-box;
            border: 1px solid black;
            box-shadow: 2px 2px 2px black;
            overflow: hidden;
            /*position: absolute;*/
        }

        .imgcontainer img{
            width: 30vw;
            height: auto;
            max-width: 55vw;
            max-height: 80vh;
        }


        .imgcontent{
            margin-left: 20%;
            display: inline-block;
            margin-top: 15vh;
            height: auto;
            box-shadow: 0px 0px 5px black;
            padding:5vh;    
            left: 100vw; 

        }

        .imgcontent p{
            font-style: justify;
        }
       
        a{
            text-decoration: none;
        }

        li a,li{
            font-family: Tahoma!important;
            color: black!important;
            text-transform: uppercase;
        }

        ul{
            float: right;
        }

        p{
            font-family: tahoma;
            font-size: 2vh;
            text-align: left;
            line-height: 0px!important;
            height: 2vh;
            width: auto;
        }

        .buy{
            width: 10vh;
            height: 7vh!important;
            line-height: 7vh!important;
            background: black;
            color: white;
            font-weight: bold;
            font-size: 3vh;
            vertical-align: middle;
            font-family: Tahoma!important;
            border: 0;
            text-align: center;
            border-radius: 1vh;
            margin-left: 40vh;
        }

        form a link{
            color: white!important;
        }

        select{
            margin-top: 2vh;
            height: 3vh;
            border: 2px solid black;
            border-radius: 0.5vh;
        }

        .msg{
            position: absolute;
            top: 15vh;
            right: 5vh;
            width: auto;
            display: inline;
            padding-right: 2vw;
            border-radius: 1vh;
            border: 0;
            background: rgba(0,0,0,.5);
            color: white;
            line-height: 7vh;
            padding-left: 2vw;
            font-family: Tahoma;            
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
        
        a{
            text-decoration: none;
        }




@media only screen and (max-width: 1024px){

            *{
                padding: 0;
                margin: 0;
            }

            body{
                width: 100%!important;
                height: auto!important;
                overflow-x: hidden!important;
            }

            header{
                position: absolute;
                top: -2vh!important;
                left: 0!important;
                width: 100vw!important;
                height: 9vh!important;
                padding-right: 15vh;
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
                position: absolute!important;
                width: 100%!important;
                height: auto;
            }


            .imgcontainer{
                width: 90vw!important;
            }

        }



    </style>
</head>
<body a link="white" vlink="white">

    <header>
        
        <a href="index.php"><h2><span>P</span>ortfolio</h2></a>

        <ul>

        <li><a href="user.php"><i id="navitem" class="fas fa-shopping-cart"></i></a></li>

        <li><a href="login.php" name="logout"><i id="navitem" class="fas fa-power-off"></a></i></li>

        <li><?php echo $_SESSION['username']; ?></li>

        </ul>
            
    </header>

            <div class="imgcontainer">
               
                <img src="<?php echo $image; ?>">

            </div>


            <div class="imgcontent" >
    	    <p>Name:<?php echo $fetch['art_name']; ?></p>
            <p>Artist Name:<?php echo $fetch['artist']; ?></p>
            <p>Dimensions:<?php echo $fetch['width']; ?>x<?php echo $fetch['height']; ?>
            <p>Cost: ₹<?php echo $fetch['cost']; ?>
            </p>

            <?php if (isset($_SESSION['message'])): ?>

            <div class="msg">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                 ?>
            </div>

            <?php endif ?>


            <?php
                 $quant = 1;
            ?>

            <form method="post">

            <select name="quant" class="quant">
            <option>-Select Quanity-</option>
            <?php while ($quant <= 10) 
            {
                echo '<option value ="'.$quant.'">'.$quant.'</option>';
                $quant = $quant + 1;
                $quantity = $_POST['quant']; 
            }

            

            ?>
            </select>

            <input type="submit" class="buy" name="buy" value="Buy !" >

            </form>

         	</div>
            
            <?php

                if (isset($_POST['buy'])) {

                    if ($_SESSION['flag']!=0){

                        $quantity = $_POST['quant'];

                        $query = "select * from paintings where id = '$id'";

                        $query_run=mysqli_query($con,$query);

                        $background = mysqli_fetch_array($query_run);

                        $orderitem = $background['id'];

                        $stock = $background['quant'];

                                              

                        if ($stock < $quantity) {
                           
                           $_SESSION['message'] = "Order Not Successful! Only ".$stock." Paintings Available";
                        
                        }

                        else{

                            $order = "INSERT INTO `orderlist`(`username`, `item`, `quantity`, `status`) VALUES ('$username','$orderitem','$quantity','0')";

                            $query_run=mysqli_query($con,$order);

                            $_SESSION['message'] = "Item Ordered !";

                            $new = ((int)$stock-(int)$quantity);

                            $update = mysqli_query($con,"UPDATE `paintings` SET quant ='$new' WHERE id = '$orderitem' ");
                        }

                    }

                    else{
                        header('location:login.php');
                    }
                    
                }
            ?>
</body>
</html>