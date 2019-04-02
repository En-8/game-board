<?php

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        echo 'This is the index page';
        
        $this->view->render('index');
    }
}
?>