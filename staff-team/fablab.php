<?php


?>

<?php



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Basic Info -->
        <title>Personalized Modifications - DriFt</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/staff-team.css">
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
                            <a href="../shop/leo/">LEO Vehicles</a>
                            <a href="../shop/fire-ems/">Fire/EMS Vehicles</a>
                            <a href="../shop/other/">Civilian Vehicles</a>
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
            <img src="../__assets/img/pm.gif" alt="DriFt.gif">
            <br><br>
            <h1>Fablab</h1>
            <br>
            <p>
            Fablab Has been with Personalized Modifications since February 2022, and has worked his way up from Mod all the way to Owner aside Logan.. he got promoted to Owner mid April and has done the best for Personalized Modifications and is good at what he does! Being from the UK, Fablab handles all issues while Logan is away.
            </p>
            <br>
            <h3>DM status: <span class="closed">Closed</span></h3>
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