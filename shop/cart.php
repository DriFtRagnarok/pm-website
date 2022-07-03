<?php

session_start();
include "../../db.php";

function getCart($conn, $user){
    $sql = "SELECT cart FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cart);
    mysqli_stmt_fetch($stmt);
    $newCart = preg_replace("/0/", "", $cart);
    $newString = str_replace(",", "", $newCart);
    $length = strlen($newString);
    return $length;
}

function getRawCart($conn, $user){
    $sql = "SELECT cart FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cart);
    mysqli_stmt_fetch($stmt);
    return $cart;
}

function getListings($conn, $id){
    $sql = "SELECT id, name, price, description FROM listings WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $price, $desc);
    mysqli_stmt_fetch($stmt);
    return array("id" => $id, "name" => $name, "price" => $price, "desc" => $desc);
}

function removeItem($conn, $id, $user, $old){
    $sql = "UPDATE accounts SET cart=? WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    $zero = str_replace($id, "", $old);
    mysqli_stmt_bind_param($stmt, "ss", $zero, $user);
    mysqli_stmt_execute($stmt);
    $_SESSION['cart_amount']--;
}

if(isset($_POST['checkout'])){
    header("Location: checkout");
}

if(isset($_SESSION['username'])){
    $_SESSION['cart_amount'] = getCart($conn, $_SESSION['username']);
}else{
    $_SESSION['cart_amount'] = 0;
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "";
}

for($i = 1; $i <= 15; $i++){
    if(isset($_POST["remove-$i"])){
        removeItem($conn, $i, $_SESSION['username'], getRawCart($conn, $_SESSION['username']));
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
        <meta property="og:title" content="Personalized Modifications - Cart">
        <meta property="og:url" content="https://www.personalizedmods.com/shop/cart">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications - Cart">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <!-- Basic Info -->
        <title>Personalized Modifications - Cart</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/cart-page.css">
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
        <style>
            <?php
                
                for($i = 1; $i <= 15; $i++){
                    $rawCart;
                    if(isset($_SESSION['username'])){
                        $rawCart = getRawCart($conn, $_SESSION['username']);
                    }else{
                        getRawCart($conn, "");
                    }
                    if(in_array($i, explode(",", $rawCart)) !== true){
                        echo ".listing-$i{ display:none; }";
                    }
                    if(!isset($_SESSION['username'])){
                        echo ".listing-$i{ display:none; }";
                    }
                }
            ?>
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
            <div class="content-left">
                <h1>Cart:</h1>
                <?php
                    for($i = 1; $i <= 15; $i++){
                        $listing = getListings($conn, $i);
                        echo "
                        <div class='listing-$i'>
                            <img src='../__assets/img/listings/$i.png'>
                            <h3>$listing[name] - $$listing[price]</h3>
                            <form method='post' action='cart'>
                                <input type='submit' value='Remove Item' name='remove-$i'>
                            </form>
                        </div>
                        ";
                    }
                    if(isset($_SESSION['username'])){
                        if(!getCart($conn, $_SESSION['username'])){
                            echo "<h3>Your cart is empty.</h3>";
                        }
                    }else{
                        echo "<h3>Your cart is empty.</h3>";
                    }
                ?>
            </div>
            <div class="content-right">
                <form action="cart" method="post">
                    <input type="submit" value="Continue to Checkout" name="checkout" <?php 
                    if(isset($_SESSION['cart_amount']) && $_SESSION['cart_amount'] > 0){
                        echo "class='enabled'";
                    }else{
                        echo "disabled class='disabled'";
                    }
                    ?>>
                </form>
            </div>
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