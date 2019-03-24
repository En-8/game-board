<?php
    public class Collections_model extends CI_Model
    {
        // Makes the database class available through $this->db object
        public function __construct()
        {
            $this->load->database();
        }
        
        public function get_collection($slug === FALSE)
        {
            $query = $this->db->get('PLACEHOLDER') // TODO figure out what to put here.
            return $query->result_array();
        }
    }
?>