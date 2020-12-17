<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Poetry Master
        <?php
        if ($page == 'about') {
            echo "| About";
        } else if ($page == 'contact') {
            echo "| Contact Us";
        } else if ($page == 'poems') {
            echo "| Our Poems";
        } else if ($page == 'register') {
            echo "| Register";
        } else if ($page == 'login') {
            echo "| Login";
        } else if ($page == 'home') {
            echo "| Home";
        }
        ?>
    </title>
</head>

<body>