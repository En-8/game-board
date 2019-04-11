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
    
    /**
     * This method checks if the given username and password combination exists in the database
     * @param $username The user's supplied username
     * @param $password The user's supplied password
     * @return $user_data If user exists in the database, returns array containing user's id and username
     * @return false User does not exist in the database
     */
    public function authenticate($username, $password)
    {
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