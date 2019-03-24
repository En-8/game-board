<?php
    class Game_model extends CI_Model
    {
        // Allows acces to database through $this->db
        public function __construct()
        {
            $this->load->database();
        }
        
        public function getGames($slug = FALSE)
        {
            if ($slug === FALSE)
            {
                $query = $this->db->query('SELECT * FROM games');
                return $query->result_array();
            }
            
            $this->redirect('https://boardgamegeek.com');
        }
    }
?>