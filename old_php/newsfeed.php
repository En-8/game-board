<?php
    require_once 'startsession.php';
    require_once 'header.php';
    
    if (!isset($_SESSION['user_id']))
    {
        echo '<p class="error">You must be logged in to view this page</p><br>';
        echo '<p>Redirecting to homepage...</p>';
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
        header('refresh:2;' . $home_url);
    }
?>