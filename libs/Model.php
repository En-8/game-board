<?php

class Model
{
    public function __construct()
    {
        if (!isset($this->db))
        {
            $this->db = new mysqli('localhost', 'game-board', '', 'gameboard');
        }
    }
}

?>