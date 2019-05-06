<!DOCTYPE html>
<html>
    <head>
        <title>This is a title</title>
        <link rel="stylesheet" href="<?= baseURL; ?>/styles.css" type="text/css" />
    </head>
    <body>
        
        <header>
            <nav aria-label="Main Menu">
            <ul role="menubar">
                <div class="nav-brand">
                <li role="menuitem" class="nav-brand"><a href="#" class="nav-brand">GameBoard</a></li>
                </div>
                <div class="nav-items">
                <li role="menuitem"><a href="<?=baseURL?>">Home</a></li>
<?php
                if (isset($_SESSION['user_id']))
                {
?>
                <li role="menuitem"><a href="#">Collections&nbsp;&nbsp;<i class="fas fa-chevron-down"></i></a>
                    <ul role="menu">
                        <li role="menuitem"><a href="<?=baseURL?>/collections/index">Your Collection</a></li>
                        <li role="menuitem"><a href="<?=baseURL?>collections/followed">Followed Collections</a></li>
                        <li role="menuitem"><a href="#">Browse Collection</a></li>
                    </ul>
                </li>
                <li role="menuitem"><a href="<?=baseURL?>/logout">Log Out</a></li>
<?php
                }
                else
                {
?>
                <li role="menuitem"><a href="<?=baseURL?>/login">Log In</a></li>
                <li role="menuitem"><a href="<?=baseURL?>/register">Register</a></li>
<?php
                }
?>
            </div>
            </ul>
        </nav>
        </header>
        <hr />