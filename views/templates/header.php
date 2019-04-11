<!DOCTYPE html>
<html>
    <head>
        <title>This is a title</title>
        <link rel="stylesheet" href="<?= baseURL; ?>/styles.css" type="text/css" />
    </head>
    <body>
        
        <header class="flex-container">
            <h1>GameBoard</h1>
            <nav>
                <a href="<?= baseURL ?>/index">Home</a>
<?php
                if (isset($_SESSION['user_id']))
                {
?>
                    <a href="<?= baseURL ?>/collections">Your Collection</a>
                    <a href="<?= baseURL ?>/logout">Log Out</a>
<?php                
                }
                else
                {
?>               
                    <a href="<?= baseURL ?>/login">Log In</a>
<?php
                }
?>
            </nav>
        </header>
        <hr />