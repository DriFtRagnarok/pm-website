<?php

include "../../db.php";
session_start();

function outputListings($conn){
    $sql = "SELECT name, price, id FROM listings";
    $result = mysqli_query($conn, $sql);
    if($result){
        $counter = 0;
        $text = "<tr>";
        while($row = mysqli_fetch_array($result)){
            if($counter++ % 3 == 0){
                if($counter > 0){
                    $text .= "</tr>";
                }
                $text .= "</tr>";
            }
            $newID = $row['id'];
            $text .= "
            <td>
            <div class='listing $newID'>
            <a href='./listing?id=$newID'>
            <img src='../__assets/img/listings/$newID.png' alt='$newID.png'>
            <h1>$row[name]</h1>
            <h4>$$row[price]</h4>
            </a>
            </div>
            </td>
            ";
        }
        if($counter > 0){
            $text .= "</tr>";
        }
        echo $text;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
<!-- Metas -->
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#0000FF">
        <meta name="description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:title" content="Personalized Modifcations - Shop">
        <meta property="og:url" content="https://www.personalizedmods.com/shop/">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications - Shop">
        <!-- Basic Info -->
        <title>Personalized Modifications - Shop</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/shop.css">
        <link rel="stylesheet" href="../__assets/css/font.css">
        <link rel="stylesheet" href="../__assets/css/dropdown.css">
        <link rel="stylesheet" href="../__assets/css/header.css">
        <link rel="stylesheet" href="../__assets/css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../__assets/css/cart.css">
        <!-- JavaScript Links -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../__assets/js/main.js"></script>
        <script src="../__assets/js/scroll.js"></script>
        <!-- CSS Style -->
        <style>

        </style>
    </head>
    <body>
    <header id="header" class="header">
            <div class="left">
                <a href="../"><img src="../__assets/img/pm.gif" alt="Personalized Modifications"></a>
            </div>
            <div class="right">
                <div class="link">
                    <a href="../">Home</a>
                </div>
                <div class="link">
                    <div class="dropdown shop">
                        <a class="dropbtn" id="shop" href="">Shop</button>
                        <div class="dropdown-content">
                            <a href="./">LEO Vehicles</a>
                            <a href="./">Fire/EMS Vehicles</a>
                            <a href="./">Civilian Vehicles</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <div class="dropdown about">
                        <a class="dropbtn" id="about" href="../about/faq">About</a>
                        <div class="dropdown-content">
                            <a href="../about/faq">FAQ</a>
                            <a href="../about/tos">Terms of Service</a>
                            <a href="../about/privacy">Privacy Policy</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <a href="../accounts/login">Account</a>
                </div>
                <div class="link">
                    <a href="https://discord.gg/personalizedmods">Discord</a>
                </div>
                <div class="link">
                    <a href="cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class='badge badge-warning' id='lblCartCount'><?php 
                        if(isset($_SESSION['cart_amount'])){
                            echo $_SESSION['cart_amount']; 
                        }else{
                            echo 0;
                        }
                        ?></span>
                    </a>
                </div>
            </div>
        </header>
        <div class="body-content">
            <table>
                <?php outputListings($conn); ?>
            </table>
            
        </div>
        <footer class="footer">
            <div class="footer-left">
                Copyright &copy; 2022 Personalized Modifications - All Rights Reserved
                <br>Personalized Modifcations is not affilatied with Rockstar Games, Take-Two Interactive or other right holders
            </div>
            <div class="footer-right">
                <a href="./about/privacy">Privacy Policy</a>
                <a href="./about/tos">Terms of Service</a>
                <a href="https://discord.gg/personalizedmods">Discord</a>
            </div>
        </footer>
    </body>
</html>