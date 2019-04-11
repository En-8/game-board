<?php

class User_model extends Model
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function newUser()
    {
        // TODO add a user to the database
    }
    
    public function authenticate($username, $password)
    {
        // TODO compare user-supplied credentials against the database of users
            // boolean return value
            // parameters ?? Probably username and password
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($query);
        if ($result->num_rows == 1)
        {
            $data = $result->fetch_array();
            $user_data = array('user_id' => $data['id'], 'username' => $data['username']);
            return $user_data;
        }
        else
        {
            return false;
        }
    }
}

?>