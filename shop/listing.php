<?php

session_start();
include "../../db.php";

function getListings($conn, $id){
    $sql = "SELECT name, price, description FROM listings WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $price, $desc);
    mysqli_stmt_fetch($stmt);
    return array("name" => $name, "price" => $price, "desc" => $desc);
}

function getOldCart($conn, $user){
    $sql = "SELECT cart FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cart);
    mysqli_stmt_fetch($stmt);
    return $cart;
}

function addToCart($conn, $old, $new, $user){
    $sql = "UPDATE accounts SET cart=? WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) return false;
    $string = $old . "," . $new;
    mysqli_stmt_bind_param($stmt, "ss", $string, $user);
    mysqli_stmt_execute($stmt);
}

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

$getString = explode("?", $_SERVER['REQUEST_URI']);
preg_match_all("!\d+!", $getString[1], $matches);
$number = trim(implode(" ", $matches[0]), );

$listingInfo = getListings($conn, $number);

if(isset($_POST['add'])){
    $oldCart = getOldCart($conn, $_SESSION['username']);
    addToCart($conn, $oldCart, $number, $_SESSION['username']);
    $_SESSION['cart_amount'] = getCart($conn, $_SESSION['username']);
    header("Location: listing?id=$number");
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
        <meta property="og:title" content="Personalized Modifications - <?php echo $listingInfo["name"]; ?>">
        <meta property="og:url" content="https://www.personalizedmods.com/shop/listing?id=<?php echo $number; ?>">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications - <?php echo $listingInfo["name"]; ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <!-- Basic Info -->
        <title>Personalized Modifications - <?php echo $listingInfo["name"]; ?></title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/listing.css">
        <link rel="stylesheet" href="../__assets/css/tos.css">
        <link rel="stylesheet" href="../__assets/css/font.css">
        <link rel="stylesheet" href="../__assets/css/dropdown.css">
        <link rel="stylesheet" href="../__assets/css/header.css">
        <link rel="stylesheet" href="../__assets/css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../__assets/css/cart.css">
        <link rel="stylesheet" href="../__assets/css/error-divs.css">
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
        <?php
        
        if(!isset($_SESSION['logged_in'])){
            echo "<div class='error'><h3>Please <a href='../accounts/login'>log in</a> to add to cart.</h3></div>";
        }
        
        ?>
        <div class="body-content">
            <div class="content-left">
            <?php 
                echo "<img src='../__assets/img/listings/$number.png'>";
            ?>
                <form action=<?php echo "listing?id=" . $number; ?> method="post">
                    <input type="submit" value="Add Item to Cart" name="add" <?php 
                    if(isset($_SESSION['username'])){
                        echo "class='enabled'";
                    }else{
                        echo "disabled class='disabled'";
                    }
                    ?>>
                </form>
            </div>
            <div class="content-right">
            <?php
                echo "<h1>$listingInfo[name]</h1>";
                echo "<h3>Price: $$listingInfo[price]</h3>";
                echo "<p>$listingInfo[desc]</p>";
            ?>
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