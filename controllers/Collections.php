<?php

class Collections extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Collection_model.php';
        $this->model = new Collection_model();
        
        $data = array('collection' => '', 'message' => '');

    }
    
    public function index($param = null)
    {
        if ($param)
        {
            echo 'And this param would result in redirect to the BGG page';
        }
        
        $this->data['collection'] = $this->model->fetchCollection();
        if (!$this->data['collection'])
        {
            $this->data['message'] = '<p class="error">Your collection is empty! Add a game to start managing your collection.</p>';
        }
        
        $this->view->render('collection', $this->data);
    }
    
    /**
     * This function adds a new game to a user's collection
     * @param $game_id the BGG id of the game being added
     * @return true if successful addition
     * @return false if failed addition or not logged in
     */
    public function add($game_id, $game_name)
    {
        var_dump($game_id); // FOR TESTING
        var_dump($game_name); // FOR TESTING
        
        $data = array();
        
        if (isset($_SESSION['user_id']))
        {
            if (!$this->model->gameInCollection($_SESSION['user_id'], $game_id))
            {
                if ($this->model->addGame($_SESSION['user_id'], $game_id))
                {
                    echo 'DB queried successfully';
                    $message = '<p class="success">' . $game_name . ' is now in your collection! Keep searching to add more game, or view your collection here.</p>'
                            . '<p>Want to log a play immediately? Click here!</p>';
                }
                else
                {
                    $message = '<p class="error">Oops! There was an error adding that game to your collection. Please try again.</p>';
                }
            }
            else
            {
                $message = '<p class="error">Oops! That game is already in your collection.</p>';
            }
            
            $this->data['message'] = $message;
            $this->index();
        }
        else
        {
            echo 'You must be logged in to perform that action.';
            return false;
        }
    }
}



?>