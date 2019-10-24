<?php

class Register extends Controller
{
    public function __construct()
    {
        require 'models/User_model.php';
        parent::__construct();
        $this->user_model = new User_model();
        
        // If the user is already logged in, redirect to home page.
        if (isset($_SESSION['user_id']))
        {
            // Redirect to the home page
            header('Location: ' . baseURL); // TODO: Display a message about already being logged in, and warn of redirect to homepage.
        }
        
        if (isset($_POST['submit']))
        {
            $this->attemptRegister();
        }
        
        $this->view->render('register');
    }
    
    private function attemptRegister()
    {
        $userData = array();
        
        $userData['username'] = $this->user_model->db->real_escape_string(trim($_POST['username']));
        $userData['password'] = $this->user_model->db->real_escape_string(trim($_POST['password']));
        // $userData['email'] = $this->user_model->db->real_escape_string(trim($_POST['email'])); INCLUDE IN FUTURE UPDATE
        
        if ($result = $this->user_model->register($userData))
        {
            // Immediately log in the new user.
            // Render registration success page.
        }
        else
        {
            echo "Registration failed";
        }
    }
}
?>