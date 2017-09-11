<!DOCTYPE html>
<html>

<?php
    session_start();
    require_once("inc/functions.php");
    require_once("inc/connect.php");
    require_once("inc/user_ip.php");
    require_once("plugins/phpmailer/PHPMailerAutoload.php");

    $refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' ;
?>

<head>
    <title>forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' charset="utf-8">
    <link rel="stylesheet" href="plugins/font-awesome-4.6.1/css/font-awesome.min.css" charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" charset="utf-8">
    <link rel="stylesheet" href="css/main.css" charset="utf-8">
    <link rel="stylesheet" href="css/forms.css" charset="utf-8">
    <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body>

    <div class="header clr">
        <?php include_once "tmpl/headernav.php"; ?>
        <?php include_once "tmpl/usernav.php"; ?>
    </div>

    <div class="searchbar clr">
        <?php require "inc/forms/searchform.php"; ?>
        <?php require "inc/forms/loginform.php"; ?>
    </div>

    <div class="main">
        <?php echo $login_errors; ?>
