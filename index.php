<?php

include "../db.php";
session_start();
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

if(isset($_SESSION['username'])){
    $_SESSION['cart_amount'] = getCart($conn, $_SESSION['username']);
}else{
    $_SESSION['cart_amount'] = 0;
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "";
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
        <meta property="og:title" content="Personalized Modifications">
        <meta property="og:url" content="https://www.personalizedmods.com/">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <!-- Basic Info -->
        <title>Personalized Modifications</title>
        <link rel="icon" href="./__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="./__assets/css/index.css">
        <link rel="stylesheet" href="./__assets/css/font.css">
        <link rel="stylesheet" href="./__assets/css/dropdown.css">
        <link rel="stylesheet" href="./__assets/css/header.css">
        <link rel="stylesheet" href="./__assets/css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../__assets/css/cart.css">
        <!-- JavaScript Links -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./__assets/js/main.js"></script>
        <script src="./__assets/js/scroll.js"></script>
        <script src="./__assets/js/header-redirect.js"></script>
        <!-- CSS Style -->
        <style>

        </style>
    </head>
    <body>
        <div class="red">Website is still in development, so purchasing will not be possible as of right now</div>
        <header id="header" class="header">
            <div class="left">
                <a href=""><img src="./__assets/img/pm.gif" alt="Personalized Modifications"></a>
            </div>
            <div class="right">
                <div class="link">
                    <a href="">Home</a>
                </div>
                <div class="link">
                    <div class="dropdown shop">
                        <a class="dropbtn" id="shop" href="./shop/">Shop</button>
                        <div class="dropdown-content">
                            <a href="./shop/leo/">LEO Vehicles</a>
                            <a href="./shop/fire-ems/">Fire/EMS Vehicles</a>
                            <a href="./shop/other/">Civilian Vehicles</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <div class="dropdown about">
                        <a class="dropbtn" id="about" href="../about/faq">About</a>
                        <div class="dropdown-content">
                            <a href="./about/faq">FAQ</a>
                            <a href="./about/tos">Terms of Service</a>
                            <a href="./about/privacy">Privacy Policy</a>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <a href="./accounts/login">Account</a>
                </div>
                <div class="link">
                    <a href="https://discord.gg/personalizedmods">Discord</a>
                </div>
                <div class="link">
                    <a href="/shop/cart">
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
            <div class="background-image"></div>
            <div class="lower-body-content">
                <div class="staff-members">
                    <div class="top-staff">
                        <div class="staff-member pm">
                            <a href="/staff-team/drift"><img src="./__assets/img/pm.gif" alt="PM"></a>
                            <h4>Owner</h4>
                            <h1>Personalized Modifications</h1>
                            <p>DriFt Ragnarok, or PM for short, is a 3d modeler, designer, and is the founder of Personalized Modifications. He is currently enrolled at a local community college and studying Computer Science. He is also a martial artist working his way up to Black Belt!</p>
                        </div>
                        <div class="staff-member fablab">
                            <a href="/staff-team/fablab"><img src="./__assets/img/pm.gif" alt="Fablab"></a>
                            <h4>Owner</h4>
                            <h1>Fablab</h1>
                            <p>Fablab Has been with Personalized Modifications since February 2022, and has worked his way up from Mod all the way to Owner aside Logan.. he got promoted to Owner mid April and has done the best for Personalized Modifications and is good at what he does!</p>
                        </div>
                    </div>
                    <div class="bottom-staff">
                        <div class="staff-member cameron">
                            <a href="/staff-team/cam"><img src="./__assets/img/pm.gif" alt="Cam"></a>
                            <h4>Co-Owner</h4>
                            <h1>Cam</h1>
                            <p>Cam has been around for a while, and is usually busy with work as a volunteer firefighter in Michigan, but he is amazing at his job and loves PM!</p>
                        </div>
                        <div class="staff-member pierre">
                            <a href="/staff-team/pierre"><img src="./__assets/img/pierre.png" alt="Pierre"></a>
                            <h4>Co-Owner</h4>
                            <h1>Pierre</h1>
                            <p>Pierre is the Head of Sales and Marketing for PM, and has been here since October of 2021. She currently loves to play Valorant and was the inspiration for this website!</p>
                        </div>
                        <div class="staff-member creamy">
                            <a href="/staff-team/creamy"><img src="./__assets/img/creamy.png" alt="Creamy"></a>
                            <h4>Head Manager</h4>
                            <h1>CreamyCaptain</h1>
                            <p>Creamy is also the former head of the Graphic Design Division, but nonetheless still makes awesome liveries and EUP!</p>
                        </div>
                    </div>
                </div>
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