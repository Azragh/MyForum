<!DOCTYPE html>
<html>

<?php
    session_start();
    require_once("inc/connect.php");
    require_once("inc/functions.php");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>browser</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/reset.css" charset="utf-8">
    <link rel="stylesheet" href="css/main.css" charset="utf-8">
    <link rel="stylesheet" href="css/forms.css" charset="utf-8">
    <script type="text/javascript" src="js/ajax.js"></script>
</head>

<body>
    <div class="header clr">
        <?php include_once "template/headernav.php"; ?>
        <?php include_once "template/usernav.php"; ?>
    </div>
    <div class="search">
        <form action="search.php" method="POST">
            <input type="text" name="searchQuery" placeholder="Beiträge Suchen" />
            <input class="searchicon" type="submit" value=" " name="searchSent" />
        </form>
    </div>
