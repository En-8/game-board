<?php

class Log_model extends Model
{
    public function __construct()
    {
        // Gives access to database through $this->db
        parent::__construct();
    }
    
    public function fetchPlayLog($userId, $gameId)
    {
        // Ensure all data going into database is sanitized
        $userId = $this->db->real_escape_string(trim($userId));
        $gameId = $this->db->real_escape_string(trim($gameId));
        
        $query = "SELECT * FROM play_log WHERE user_id = '$userId' AND game_id = '$gameId' ORDER BY date_of_play DESC, id DESC";
        
        $result = $this->db->query($query);
        
        if ($result->num_rows > 0)
        {
            while ($data = mysqli_fetch_array($result))
            {
                $log[] = $data;
            }
        }
        
        return $log;
    }
    
    /**
     * This function attempts to log a play of the specified game
     * 
     * @param playData an associative array containing userId, gameId, playTime, and date
     * 
     * @return true if successfully logged
     * @return false if log was a failure
     */
    public function logPlay($playData)
    {
        // Ensure all data going into database is sanitized
        $userId = $this->db->real_escape_string(trim($playData['userId']));
        $gameId = $this->db->real_escape_string(trim($playData['gameId']));
        $playTime = $this->db->real_escape_string(trim($playData['playTime']));
        $date = $this->db->real_escape_string(trim($playData['date']));
        $notes = $this->db->real_escape_string(trim($playData['notes']));
        
        $query = "INSERT INTO play_log VALUES ('', '$userId', '$gameId', '$playTime', '$date', '$notes')";
        if ($this->db->query($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}