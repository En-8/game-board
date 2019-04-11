<?php

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->view->render('index');
        
        
        ////
        //  Use this if you decide you want the user to be immediatedly prompted to login on site landing.
        //
        /*if (isset($_SESSION['user_id']))
        {
            $this->view->render('index');
        }
        else
        {
            $this->view->render('login');
        }*/
    }
}
?>