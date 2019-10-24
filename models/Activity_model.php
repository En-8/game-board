<?php

class Activity_model extends Model
{
    public function __construct()
    {
        // Gives access to database via $this->db
        parent::__construct();
    }
    
    /**
     * This functions logs an activity.
     * 
     * @param $userId the ID of the user performing the activity
     * @param $activityType The type of activity. Only valid options are as follows:
     *          1 = Added a game; 2 = removed a game; 3 = logged a play
     * @param $sourceId The record the activity is associated with (typically the ID of a game)
     */
    public function logActivity($userId, $activityType, $sourceId)
    {
        if ($activityType == 1 || $activityType == 2 || $activityType == 3)
        {
            $query = "INSERT INTO activities VALUES (null, '$userId', '$activityType', '$sourceId', NOW())";
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
    
    /**
     * This function obtains records for a given user's activity stream. It will only return records
     *      associated with users whose collections the given user follows.
     * 
     * @param userId The ID of the user whose activity stream is being fetched.
     * 
     */
    public function getActivityStream($userId)
    {
        $query = "SELECT users.username, activities.activity_type, activities.source_id, activities.date FROM activities "
                . "JOIN users ON activities.user_id = users.id WHERE activities.user_id "
                . "IN (SELECT user_id FROM followers WHERE follower_id = '$userId') "
                . "ORDER BY activities.date DESC";
                
        if ($result = $this->db->query($query))
        {
            $activityStream = array();
            while ($data = mysqli_fetch_array($result))
            {
                $activityStream[] = $data;
            }

            return $activityStream;
        }
        else
        {
            echo 'Failed to generate activity stream';
            return false;
        }
    }
}


?>