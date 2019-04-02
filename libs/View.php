<?php

class View
{
    public function __construct()
    {
        //echo '<br>You have constructed the view<br>';
    }
    
    public function render($name, $data = array())
    {
        require 'views/pages/' . $name . '.php';
    }
}

?>