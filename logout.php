<?php
    require_once 'startsession.php';
    
    if (isset($_SESSION['user_id']))
    {
        $_SESSION = array();
        if (isset($_COOKIE[session_name()]))
        {
            setcookie(session_name(), '', time() - ONE_HOUR);
        }
        
        session_destroy();
    }
    
    setcookie('username', '', time() - ONE_HOUR);
    setcookie('user_id', '', time() - ONE_HOUR);
    
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])
            . '/index.php';
            
    header('Location: ' . $home_url);
?>