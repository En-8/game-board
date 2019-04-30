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
        
        $data = array('collection' => $this->model->fetchCollection());
        if (!$data['collection'])
        {
            $data['message'] = '<p class="error">Oops! This game is already in your collection!</p>';
        }
        
        $this->view->render('collection', $data);
    }
    
    /**
     * This function adds a new game to a user's collection
     * @param $game_id the BGG id of the game being added
     * @return true if successful addition
     * @return false if failed addition or not logged in
     */
    public function add($game_id, $game_name)
    {
        var_dump($game_id);
        var_dump($game_name);
        
        if (isset($_SESSION['user_id']))
        {
            if ($this->model->addGame($_SESSION['user_id'], $game_id))
            {
                echo 'DB queried successfully';
                $message = '<p class="success>' . $name . ' is now in your collection! Keep searching to add more game, or view your collection here.</p>'
                        . '<p>Want to log a play immediately? Click here!</p>';
                $data = array('message' => $message);
                $this->render('search', $data);
            }
            else
            {
                echo "addGame returned false";
                return false;
            }
        }
        else
        {
            echo 'Sessions ID not set';
            return false;
        }
    }
}



?>