<?php

class Model
{
    public function __construct()
    {
        require 'Database.php';
        $this->db = new Database();
    }
}

?>