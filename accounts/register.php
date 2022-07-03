<?php

include "../../db.php";
session_start();

function checkCredentials($conn, $username, $email){
    $sql = "SELECT username, email FROM accounts WHERE username=? OR email=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $email);
    mysqli_stmt_fetch($stmt);
    if($name){
        return true;
    }else{
        return false;
    }
}

function inputIntoDB($conn, $username, $email, $password, $discord){
    $sql = "INSERT INTO accounts (username, email, password, itemsPurchased, isAdmin, cart, credits) VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    $newPass = password_hash($password, PASSWORD_BCRYPT);
    $zero = 0;
    mysqli_stmt_bind_param($stmt, "sssssss", $username, $email, $newPass, $zero, $zero, $zero, $zero);
    mysqli_stmt_execute($stmt);
}

if(isset($_POST['submit'])){
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])){
        if(checkCredentials($conn, $_POST['username'], $_POST['email']) !== false){
            header("Location: register?err=credentials_taken");
        }else{
            if($_POST['password'] === $_POST['password2']){
                if(isset($_POST['discord'])){
                    inputIntoDB($conn, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['discord']);
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['user'] = $_SESSION['username'];
                    header("Location: ./");
                }else{
                    inputIntoDB($conn, $_POST['username'], $_POST['email'], $_POST['password'], "");
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['user'] = $_SESSION['username'];
                    header("Location: ./");
                }
            }else{
                header("Location: register?err=password_mismatch");
            }
        }
    }else{
        header("Location: register?err=blank_fields");
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
        <meta property="og:title" content="Personalized Modifcations - Register">
        <meta property="og:url" content="https://www.personalizedmods.com/accounts/register">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifcations - Register">
        <!-- Basic Info -->
        <title>Personalized Modifications - Register</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/login.css">
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
        <?php
        
        $getString = explode("?", $_SERVER['REQUEST_URI']);
        if(isset($getString[1])){
            if($getString[1] == "err=password_mismatch"){
                echo "<div class=error>Passwords do not match.</div>";
            }
            if($getString[1] == "err=credentials_taken"){
                echo "<div class=error>Your Username or Email is already taken.</div>";
            }
            if($getString[1] == "err=blank_fields"){
                echo "<div class=error>Please fill in all the required fields.</div>";
            }
        }

        ?>
        <div class="body-content">
            <div class="form-content">
                <form action="register" method="post">
                    <input type="text" name="username" placeholder="Input Username">
                    <input type="email" name="email" placeholder="Input Email">
                    <input type="password" name="password" placeholder="Input Password">
                    <input type="password" name="password2" placeholder="Verify Password">
                    <input type="text" name="discord" placeholder="Input Discord ID (Optional)">
                    <input type="submit" name="submit" value="Register">
                </form>
                <a href="login">Have an Account? Login Here</a>
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