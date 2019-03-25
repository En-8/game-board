<?php
    class Collection_model extends CI_Model
    {
        // Makes the database class available through $this->db object
        public function __construct()
        {
            $this->load->database();
        }
        
        // TODO ensure that Collections data model is only available to logged in users.
        public function get_user_collection($user_id = FALSE)
        {
            if ($user_id === FALSE)
            {
                $query = $this->db->query('SELECT * FROM user_collections'); // TODO refine results to only current users' collections
                return $query->result_array();
            }
            
            $query = $this->db->query("SELECT * FROM user_collections " .
                                      "JOIN games on games.id = user_collections.game_id " . 
                                      "WHERE user_collections.user_id = '$user_id'");
                                      
            return $query->result_array();
        }
    }
?>