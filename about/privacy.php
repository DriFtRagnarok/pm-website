<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#0000FF">
        <meta name="description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:title" content="Personalized Modifications - Privacy Policy">
        <meta property="og:url" content="https://www.personalizedmods.com/about/privacy">
        <meta property="og:image" content="https://www.personalizedmods.com/__assets/img/pm.png">
        <meta property="og:description" content="Personalized Modifications is a FiveM Vehicle Modeling Company founded in 2019 to provide cheap yet quality models to the community.">
        <meta property="og:locale" content="en_US">
        <meta property="og:site_name" content="Personalized Modifications - Privacy Policy">
        <!-- Basic Info -->
        <title>Personalized Modifications - Customer Home</title>
        <link rel="icon" href="../__assets/img/pm.gif">
        <!-- CSS Links -->
        <link rel="stylesheet" href="../__assets/css/about.css">
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
                            <a href="">Privacy Policy</a>
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
            <div class="content-wrapper">
                <h1>Privacy Policy</h1>
                <p>
                    Personalized Modifications (PM) values its users' privacy. This Privacy Policy will help you understand how we collect and use personal information from those who visit our website and the data we collect.
                    <br><br>
                    We reserve the right to make changes to the policy at any given time.
                    <br><br>
                    By using this website, you automatically agree to our policies and <a href="tos">terms of service</a>
                    <br><br>
                    Please note that it is highly recommended and suggested that you read our affilatied companies' privacy policies if you plan on visting them.
                    <br><br>
                    We use your data to:<br>
                    <ul>
                        <li>- Identify you and prevent fraud</li>
                        <li>- Complete transactions for a purchase made on our assets</li>
                        <li>- Help your web experience on our site</li>
                        <li>- Deliever our assets at a reasonable speed, usually less than 5 minutes</li>
                        <li>- Improve our services and products for the consumer</li>
                    </ul>
                    <br><br>
                    What we collect:<br>
                    <ul>
                        <li>- Internet Protocol Addresses (IPv4)</li>
                        <li>- Email Addresses</li>
                        <li>- User IDs for the platform "Discord"</li>
                    </ul>
                    <br><br>
                    We will store this information for up to 30 days after your last website visit.
                    <br><br>
                    We DO NOT sell your information to third parties or other companies, your information is safe with us.
                    <br><br>
                    This website is not intended for children under the age of 13
                    <br><br>
                    Personalized Modifications is a company based in the United States, so any international users must comply with US law, including COPPA.
                    <br><br>
                    We take precautions to protect your information, both online and offline. All sensitive information we collect, such as payment information, is encrypted and transmitted to us in a secure way. You can verify this by looking at the lock icon and the https at the beginning of the address of the webpage.
                    <br><br>
                    If you have any questions, please contact us via <a href="https://discord.gg/personalizedmods">our Discord</a>
                </p>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-left">
                Copyright &copy; 2022 Personalized Modifications - All Rights Reserved
                <br>Personalized Modifications is not affilatied with Rockstar Games, Take-Two Interactive or other right holders
            </div>
            <div class="footer-right">
                <a href="../about/privacy">Privacy Policy</a>
                <a href="../about/tos">Terms of Service</a>
                <a href="https://discord.gg/personalizedmods">Discord</a>
            </div>
        </footer>
    </body>
</html>