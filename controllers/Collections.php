<?php

class Collections extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->view->msg = 'This is where you will view your collection';
        $this->view->render('collection');
        
    }
    
    public function index($param = null)
    {
        require 'models/Collection_model.php';
        new Collection_model();
        
        if ($param)
        {
            echo 'And this param would result in redirect to the BGG page';
        }
    }
    
    public function test()
    {
        echo 'This is a test function';
    }
}



?>