<?php

class View
{
    public function __construct()
    {
        //echo '<br>You have constructed the view<br>';
    }
    
    public function render($name, $data = null)
    {
        require_once 'views/pages/' . $name . '.php';
    }
}

?>