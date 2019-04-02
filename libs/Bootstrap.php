<?php

class Bootstrap
{
    public function __construct()
    {
        $uri = isset($_GET['uri']) ? $_GET['uri'] : null;
        $uri = rtrim($uri, '/');
        $uri = explode('/', $uri);
        $uri[0] = ucfirst($uri[0]);
        // print_r($uri);
        
        if (empty($uri[0]))
        {
            require 'controllers/Index.php';
            $controller = new Index();
            return false;
        }
        
        $file = 'controllers/' . $uri[0] . '.php';
        if (file_exists($file))
        {
            require $file;
        }
        $controller = new $uri[0];
        
        if (isset($uri[2]))
        {
            $controller->{$uri[1]}($uri[2]);
        }
        else if (isset($uri[1]))
        {
            $controller->{$uri[1]}();
        }
    }
    
}
?>