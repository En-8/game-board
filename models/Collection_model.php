<?php

class Collection_model extends Model
{
    public function __construct()
    {
        // Gives access to database through $this->db
        parent::__construct();
    }
    
    public function fetchCollection()
    {
        $query = "SELECT name FROM games JOIN user_collections ON user_collections.game_id = games.id "
                . "WHERE user_id = 1";
        $result = $this->db->query($query);
        while ($data = mysqli_fetch_array($result))
        {
            $collection[] = $data;
        }
        return $collection;
    }
    
    public function importCollection()
    {
        // TODO allow for users to import their BGG collection.
    }
    
    public function addGame()
    {
        // TODO adds a game to the users' collection
            //NOTE: Game must already exist in the games database.
            // If not, encourage use of search feature (BGG API)
    }
}

?>