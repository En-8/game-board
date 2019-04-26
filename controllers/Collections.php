<?php

class Collections extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Collection_model.php';
        $this->model = new Collection_model();
        $this->index();
    }
    
    public function index($param = null)
    {
        if ($param)
        {
            echo 'And this param would result in redirect to the BGG page';
        }
        
        $collection = $this->model->fetchCollection();
        
        $this->view->render('collection', $collection);
    }
    
    /**
     * This function adds a new game to a user's collection
     * @param $game_id the BGG id of the game being added
     * @return true if successful addition
     * @return false if failed addition or not logged in
     */
    public function add($game_id)
    {
        if (isset($_SESSION['user_id']))
        {
            if ($this->model->addGame($_SESSION['user_id'], $game_id))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}



?>