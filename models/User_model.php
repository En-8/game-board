<?php

class User_model extends Model
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * This function attempts to add a new user to the database.
     * @param $userData associative array of user's entered data.
     * 
     * @return true if successfully registered
     * @return false if registration failed.
     */
    public function register($userData)
    {
        $username = $userData['username'];
        $password = $userData['password'];
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($query);
        
        if ($result->num_rows == 0)
        {
            // Insert into database
            $query = "INSERT INTO users VALUES (null, '$username', SHA1('$password'))";
            if ($this->db->query($query))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            // Username already in use.
            return false;
        }
    }
    
    /**
     * This method checks if the given username or email already exists in the database
     * @param $userData An associative array containing the user data
     * @return true if the username and email are available for use.
     * @return false If username or email are already in use.
     */
    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password')";
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
    
    public function getUsername($userId)
    {
        $query = "SELECT username FROM users WHERE id = '$userId'";
        $result = $this->db->query($query);
        if (!$result)
        {
            return false;
        }
        
        $data = mysqli_fetch_array($result);
        $username = $data['username'];
        
        return $username;
    }
}

?>