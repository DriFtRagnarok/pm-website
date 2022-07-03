<?php

session_start();
include "../../db.php";

if(isset($_POST['continue'])){
    if(isset($_SESSION['username'])){
        /*if(!empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['cardname']) && !empty($_POST['cardnumber']) && !empty($_POST['expmonth']) && !empty($_POST['expyear']) && !empty($_POST['cvv'])){
            if(validateCard($_POST['cardnumber']) === true){

            }else{
                header("Location: checkout?err=invalid_card_number");
            }
        }else{
            header("Location: checkout?err=empty_fields");
        }*/

        $total = countTotal($conn, $_SESSION['username'], 0);
        if(isset($_POST['coupon'])){
            $total = countTotal($conn, $_SESSION['username'], $_POST['coupon']);
        }else{
            $total = countTotal($conn, $_SESSION['username'], 0);
        }

        $testmode = true;
        $paypalurl = $testmode ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
        $data = array(
            'cmd'			=> "_xclick",
            'upload'        => '1',
            'lc'			=> 'EN',
            'business' 		=> 'driftclan420@gmail.com',
            'cancel_return'	=> 'https://personalizedmods.com/shop/checkout',
            'notify_url'	=> 'https://personalizedmods.com/shop/paypal',
            'currency_code'	=> 'USD',
            'return'        => 'https://personalizedmods.com/shop/success',
            'item_name'     => 'Personalized Modification Assets',
            'amount'        => "$total"
        );
        header('Location:' . $paypalurl . '?' . http_build_query($data));
    }else{
        header("Location: checkout?err=not_signed_in");
    }
}

function validateCard($number){
    $number = preg_replace('/\D/', "", $number);
    $number_length = strlen($number);
    $parity = $number_length % 2;

    $total = 0;
    for($i = 0; $i < $number_length; $i++){
        $digit = $number[$i];
        if($i % 2 == $parity){
            $digit *= 2;
            if($digit > 9){
                $digit -= 9;
            }
        }
        $total += $digit;
    }

    return ($total % 10 == 0) ? true : false;
}

function checkCoupon($conn, $code){
    $sql = "SELECT name, discount, validUntil FROM `coupons` WHERE `name`=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo ("Statement not prepared!");
    }
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_bind_result($stmt, $name, $discount, $validUntil);
    $row = mysqli_stmt_fetch($stmt);
    if(isset($result)){
        return $discount;
    }else{
        return "This Coupon is Not Valid!";
    }
}

function applyCoupon($total, $discount){
    $DiscountFromHundred = 1 - $discount;
    $NewTotal = $total * $DiscountFromHundred;
    return $NewTotal;
}

function countTotal($conn, $username, $code){
    $cart = getCart($conn, $username);
    $discount = checkCoupon($conn, $code);
    $total = 0;
    if(strpos($cart, '1')){
        $total = $total + 75;
    }
    if(strpos($cart, '2')){
        $total = $total + 25;
    }
    if(strpos($cart, '3')){
        $total = $total + 75;
    }
    if(strpos($cart, '4')){
        $total = $total + 75;
    }
    if(strpos($cart, '5')){
        $total = $total + 75;
    }
    if(strpos($cart, '6')){
        $total = $total + 15;
    }
    if(strpos($cart, '7')){
        $total = $total + 50;
    }
    if(strpos($cart, '8')){
        $total = $total + 50;
    }
    if(strpos($cart, '9')){
        $total = $total + 50;
    }
    if(strpos($cart, '10')){
        $total = $total + 0;
    }
    if(strpos($cart, '11')){
        $total = $total + 0;
    }
    if(strpos($cart, '12')){
        $total = $total + 0;
    }
    if(strpos($cart, '13')){
        $total = $total + 0;
    }
    if(strpos($cart, '14')){
        $total = $total + 0;
    }
    if(strpos($cart, '15')){
        $total = $total + 0;
    }
    if(isset($discount)){
        $coupon = applyCoupon($total, $discount);
        return number_format((float)$coupon, 2, ".", "");
    }else{
        return number_format((float)$total, 2, ".", "");
    }
}

function getCart($conn, $username){
    $sql = "SELECT cart FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cart);
    mysqli_stmt_fetch($stmt);
    return $cart;
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
        <meta property="og:title" content="Personalized Modifications - Checkout">
        <meta property="og:url" content="https://www.personalizedmods.com/shop/cart">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications - Checkout">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <!-- Basic Info -->
        <title>Personalized Modifications - Checkout</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/checkout.css">
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
            <div class="left-content">
                <form action="checkout" method="post">
                    <div class="form-wrapper">
                        <div class="left-left">
                            <h3>Billing Information</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="New York">
                            <div class="split-in-two">
                                <div class="one">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="NY">
                                </div>
                                <div class="two">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10001">
                                </div>
                            </div>
                        </div>
                        <div class="right-left">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:white;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            <label for="expmonth">Exp Month</label>
                            <input type="text" id="expmonth" name="expmonth" placeholder="January">
                            <div class="split-in-two">
                                <div class="one">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2025">
                                </div>
                                <div class="two">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123">
                                </div>
                                <label>
                                    <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="coupon" id="coupon" placeholder="Have a Coupon Code?">
                    <br>
                    <input type="submit" value="Pay Now" name="continue">
                </form>
            </div>
            <div class="right-content">
                
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