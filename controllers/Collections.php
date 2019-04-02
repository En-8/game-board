<?php

class Collections extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Collection_model.php';
        $this->model = new Collection_model();
        $this->index();
    }
    
    public function index($param = null)
    {
        if ($param)
        {
            echo 'And this param would result in redirect to the BGG page';
        }
        
        $collection = $this->model->fetchCollection();
        print_r($collection);
        
        $this->view->render('collection', $collection);
    }
    
    public function test()
    {
        echo 'This is a test function';
    }
}



?>