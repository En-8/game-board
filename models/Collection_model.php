<?php

class Collection_model extends Model
{
    public function __construct()
    {
        // Gives access to database through $this->db
        parent::__construct();
    }

    /**
     * This function pulls all game id's in a user's collection from the database
     * 
     * 
     */
    public function fetchCollection($userId)
    {
        $query = "SELECT game_id FROM user_collections WHERE user_id = $userId";
        
        $result = $this->db->query($query);
        
        if ($result->num_rows > 0)
        {
            while ($data = mysqli_fetch_array($result))
            {
                $collection[] = $data;
            }
        }
        
        return $collection;
    }

    public function importCollection()
    {
        // TODO allow for users to import their BGG collection.
    }

    /**
     * This function attempts to add a game to a user's collection on the database
     * 
     * @param $userId the user's id
     * @param $gameId the BGG ID of the game being added.
     * @return true on successful addition
     * @return false on failed addition
     */
    public function addGame($userId, $gameId)
    {
        $userId = $this->db->real_escape_string(trim($userId));
        $gameId = $this->db->real_escape_string(trim($gameId));
        
        var_dump($userId);
        var_dump($gameId);
        
        $query = "INSERT INTO user_collections VALUES ('$userId', '$gameId')";
        var_dump($query);
        
        if ($this->db->query($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * This function attempts to remove a game to a user's collection on the database
     * 
     * @param $userId the user's id
     * @param $gameId the BGG ID of the game being added.
     * @return true on successful removal
     * @return false on failed removal
     */
    public function removeGame($user_id, $game_id)
    {
        $gameId = $this->db->real_escape_string(trim($gameId));
        
        $query = "DELETE FROM user_collections WHERE user_id = '$user_id' AND game_id = '$game_id'";
        
        if ($this->db->query($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * This function checks if a game is already in the user's collection
     * 
     * @param $userId the user's id
     * @param $gameId the BGG ID of the game being added.
     * @return true if game is there
     * @return false if it is not there
     */
    public function gameInCollection($userId, $gameId)
    {
        $userId = $this->db->real_escape_string(trim($userId));
        $gameId = $this->db->real_escape_string(trim($gameId));
        
        $query = "SELECT * FROM user_collections WHERE user_id = '$userId' AND game_id = '$gameId'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0)
        {
            var_dump($result);
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>