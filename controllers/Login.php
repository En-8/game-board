<?php

class Login extends Controller
{
    public function __construct()
    {
        require 'models/User_model.php';
        parent::__construct();
        $this->user_model = new User_model();
        
        // Check if the login form was submitted
        if (isset($_POST['submit']))
        {
            $this->attemptLogin();
        }
        
        
        $this->view->render('login');
    }
    
    private function attemptLogin()
    {
        // TODO: Implement persistant login via cookies.
        
        $username = $this->user_model->db->real_escape_string(trim($_POST['username']));
        $password = $this->user_model->db->real_escape_string(trim($_POST['password']));
        
        if ($result = $this->user_model->authenticate($username, $password))
        {
            echo 'Login Successful; Logged in as ' . $result['username'];
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $result['username'];
            // echo 'Session vars set as ' . $_SESSION['user_id'] . ' and ' . $_SESSION['username']; TESTING PURPOSES ONLY
        }
        else
        {
            echo 'Login failed; result is ' . $result;
        }
    }
}
?>