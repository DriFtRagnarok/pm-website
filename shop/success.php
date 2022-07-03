<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "pmsite");
$sql = "SELECT * FROM `accounts` WHERE `username`='$_SESSION[username]';";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$newItems = "$row[itemsPurchased]" . "," . "$row[cart]";
$sql2 = "UPDATE `accounts` SET `itemsPurchased`='$newItems',`cart`='0' WHERE `username`='$_SESSION[username]';";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
//$discord = $_POST['discord'];
header("Location: ../accounts/");
//`cart`='0'

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Success</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        
    </body>
</html>
