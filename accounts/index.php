<?php

include "../../db.php";
session_start();

if($_SESSION['logged_in'] === true){
    if(isset($_POST['logout'])){
        $_SESSION['user'] = "";
        session_destroy();
        header("Location: login");
    }
}else{
    header("Location: login?err=access_denied");
}

function getDownloads($conn, $user){
    $sql = "SELECT itemsPurchased FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $items);
    mysqli_stmt_fetch($stmt);
    return $items;
}

function getListings($conn, $id){
    $sql = "SELECT name, price, description, id FROM accounts WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $price, $desc, $id);
    mysqli_stmt_fetch($stmt);
    return array("name" => $name, "price" => $price, "desc" => $desc, "id" => $id);
}

function filterDownloads($items){
    $string = explode(",", $items);
    $later = preg_match_all('/([1-9]\d*|0)(,\d+)?/', $string[0]);
    $newstring = preg_replace("/0/", "", $items);
    $length = strlen($newstring);
    return $length;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#0000FF">
        <meta name="description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:title" content="Personalized Modifcations - Customer Home">
        <meta property="og:url" content="https://www.personalizedmods.com/accounts/">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifcations - Customer Home">
        <!-- Basic Info -->
        <title>Personalized Modifications - Customer Home</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/portal.css">
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
        <script src="../__assets/js/header-redirect.js"></script>
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
                        <a class="dropbtn" id="shop" href="../shop/">Shop</button>
                        <div class="dropdown-content">
                            <a href="../shop/">LEO Vehicles</a>
                            <a href="../shop/">Fire/EMS Vehicles</a>
                            <a href="../shop/">Civilian Vehicles</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <div class="dropdown about">
                        <a class="dropbtn" id="about" href="../about/faq">About</a>
                        <div class="dropdown-content">
                            <a href="../about/faq">FAQ</a>
                            <a href="../about/tos">Terms of Service</a>
                            <a href="..about/privacy">Privacy Policy</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <a href="login">Account</a>
                </div>
                <div class="link">
                    <a href="https://discord.gg/personalizedmods">Discord</a>
                </div>
                <div class="link">
                    <a href="../shop/cart">
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
            <h1>Welcome back, <?php echo $_SESSION['username']; ?></h1>
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
                <input type="submit" name="settings" value="View Settings">
            </form>
            <h4>Current Credit: 0</h4>
            <h4>Your Purchases:</h4>
            <div class="purchases">
                <?php
                
                $result = mysqli_query($conn, "SELECT * FROM `accounts` WHERE `username`='$_SESSION[username]'");
                while($row = mysqli_fetch_array($result)){
                    $listings = getDownloads($conn, $_SESSION['username']);
                    echo filterDownloads($listings);
                }
                
                ?>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-left">
                Copyright &copy; 2022 Personalized Modifications - All Rights Reserved
                <br>Personalized Modifcations is not affilatied with Rockstar Games, Take-Two Interactive or other right holders
            </div>
            <div class="footer-right">
                <a href="../about/privacy">Privacy Policy</a>
                <a href="../about/tos">Terms of Service</a>
                <a href="https://discord.gg/personalizedmods">Discord</a>
            </div>
        </footer>
    </body>
</html>