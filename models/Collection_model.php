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
     * @param $userId the ID of the user whose collection is being fetched.
     * @return An array containing the user's collection
     */
    public function fetchCollection($userId)
    {
        $query = "SELECT game_id FROM user_collections WHERE user_id = $userId";
        
        $result = $this->db->query($query);
        
        $collection = array();
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
        
        $query = "INSERT INTO user_collections VALUES ('$userId', '$gameId')";
        
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
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * This function stores a collection imported from BGG to the GameBoard database
     * 
     * @param $userId the GameBoard ID of the user whose collection is being imported.
     * @param $collection a SimpleXMLElement object containing the collection from BGG
     * 
     */
    public function storeImportedCollection($userId, $collection)
    {
        // Parse the SimpleXML object to obtain the id's of every game in the user's collection
        $gamesById = array();
        foreach ($collection->item as $game)
        {
            $gamesById[] = $game['objectid']->__toString();
        }
        
        // Store those ID's in the user_collections table, but make sure that the game is not a duplicate of one already in there.
        foreach ($gamesById as $gameId)
        {
            $query = "INSERT INTO user_collections VALUES ('$userId', '$gameId')";
            $this->db->query($query);
        }
    }
    
    public function addFollower($userId, $followerId)
    {
        $userId = $this->db->real_escape_string(trim($userId));
        $followerId = $this->db->real_escape_string(trim($followerId));
        
        $query = "INSERT INTO followers VALUES ('$userId', '$followerId')";
        
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
     * This function retrieves a list of collections followed by the specified user
     * 
     * @param $userId the ID of the user whose followed collections are being retrieved.
     */
    public function getFollowedCollections($userId)
    {
        $collections = array();
        $query = "SELECT users.username, followers.user_id FROM followers JOIN users ON followers.user_id = users.id WHERE follower_id = '$userId'";
        if ($result = $this->db->query($query))
        {
            while ($data = mysqli_fetch_array($result))
            {
                $collections[] = $data;
            }

            return $collections;
        }
        else
        {
            return false;
        }
    }
    
    public function getAllCollections($userId) 
    {
        $collections = array();
        $query = "SELECT username, id FROM users WHERE id != '$userId'";
        
        if ($result = $this->db->query($query))
        {
            while ($data = mysqli_fetch_array($result))
            {
                $collections[] = $data;
            }
            
            return $collections;
        }
        else
        {
            return false;
        }
    }
}

?>