<?php

class Collections extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require 'models/Collection_model.php';
        require 'models/BggAPI_model.php';
        $this->model = new Collection_model();
        $this->api = new BggAPI_model();
        
        $this->data = array('collection' => '', 'message' => '', 'userId' => '');

    }
    
    /**
     * This funciton generates game collection data to be displayed
     * By default, it displays the current user's collection.
     * If a $userId is provided, it will display the collection of the specified user.
     * 
     */
    public function index($userId = false)
    {
        // If a userId is specified, view the collection of that user
        // Otherwise, view the current user's collection.
        if ($userId)
        {
            $collectionIds = $this->model->fetchCollection($userId);
            $this->data['userId'] = $userId;
        }
        else
        {
            $collectionIds = $this->model->fetchCollection($_SESSION['user_id']);
            $this->data['userId'] = $_SESSION['user_id'];
        }
        
        // If a non-empty collection was successfully retreived, 
        //      Take the results of the query for game IDs data and store them in an indexed array,
        //      then get data for those games from BGG API
        if ($collectionIds)
        {
            $gamesById = array();
            foreach ($collectionIds as $game)
            {
                $gamesById[] = $game['game_id'];
            }
            $this->data['collection'] = $this->api->getThings($gamesById);
        }
        else
        {
            if ($this->data['userId'] == $_SESSION['user_id'])
            {
                $this->data['message'] = '<p class="error">Your collection is empty! '
                        . 'Add a game to start managing your collection.</p>';
            }
            else
            {
                $this->data['message'] = '<p class="error">This collection is empty! '
                        . 'Tell this person to add some games to their collection!</p>';
            }
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
    
    /**
     * This function removes a game from the user's collection
     * 
     * 
     */
    public function remove($game_id, $game_name = null)
    {
        if ($this->model->removeGame($_SESSION['user_id'], $game_id))
        {
            $message = '<p class="success">Game successfully removed from your collection</p>';
        }
        else
        {
            $message = '<p class="error">There was an error removing this game from your collection. Please try again.</p>';
        }
        
        $this->data['message'] = $message;
        $this->index();
    }
    
   
}



?>