<?php

class Logout extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $_SESSION = array();
        
        session_destroy();

        header('Location: ' . baseURL);
    }
}


?>