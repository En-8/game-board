<?php

class Collections extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id']))
        {
            header('Location: ' . baseURL . '/login');
        }
        parent::__construct();
        require 'models/Collection_model.php';
        require 'models/BggAPI_model.php';
        require 'models/Activity_model.php';
        require 'models/User_model.php';
        $this->user = new User_model();
        $this->model = new Collection_model();
        $this->api = new BggAPI_model();
        $this->activities = new Activity_model();
        
        $this->data = array('collection' => '', 'message' => '', 'userId' => '', 'username' => '', 'following' => false);

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
            $this->data['username'] = $this->user->getUsername($userId);
            $this->data['following'] = $this->checkIfFollowing($_SESSION['user_id'], $this->data['username']);
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
        $data = array();
        
        if (isset($_SESSION['user_id']))
        {
            $userId = $_SESSION['user_id'];
            
            if (!$this->model->gameInCollection($userId, $game_id))
            {
                if ($this->model->addGame($userId, $game_id))
                {
                    echo 'DB queried successfully';
                    $message = '<p class="success">' . $game_name . ' is now in your collection! Keep searching to add more games, or view your collection here.</p>'
                            . '<p>Want to log a play immediately? Click here!</p></br>';
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
            
            $this->activities->logActivity($userId, 1, $game_id);
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
        
        $this->activities->logActivity($_SESSION['user_id'], 2, $game_id);
        $this->data['message'] = $message;
        $this->index();
    }
    
    /**
     * This function attempts to import a user's collection from BoardGameGeek.com
     *
     * 
     */
    public function import()
    {
        if (isset($_POST['submit']))
        {
            // attempt to import collection
            $BGGusername = $_POST['username'];
            $importResult = $this->api->fetchCollection($BGGusername);
            if ($importResult)
            {
                $this->model->storeImportedCollection($_SESSION['user_id'], $importResult);
            }
        }
        else
        {
            $this->data['message'] = '<p class="error">There was an error importing your collection. Please try again later.</p>';
        }
        
        
        $this->view->render('import', $this->data);
    }
    
    /**
     * This function attempts to add a collections to a user's list of followed collections
     * 
     * @param $userId the ID of the user whose collection is being followed
     */
    public function follow($userId)
    {
        $followerId = $_SESSION['user_id'];
        if ($userId == $followerId)
        {
            return false;
        }
        
        if ($this->model->addFollower($userId, $followerId))
        {
            $this->data['message'] = '<p class="success">Collection successfully followed</p>';
        }
        else
        {
            $this->data['message'] = '<p class="error">Either you are already following this collection or there was an error.</p>';
        }
        
        //header("Location:" . baseURL . "/collections/index/" . $userId);
        $this->index($userId);
    }
    
    public function followed()
    {
        $userId = $_SESSION['user_id'];
        
        if ($collections = $this->model->getFollowedCollections($userId))
        {
            $this->data['collection'] = $collections;
        }
        else
        {
            $this->data['message'] = "There was an error fetching your followed collections. Please try again.";
        }
        
        $this->view->render('followedCollections', $this->data);
    }
    
    public function browse()
    {
        $collections = $this->model->getAllCollections($_SESSION['user_id']);
        if (!$collections)
        {
            $this->data['message'] = '<p class="error">There was an error getting collections to browse. Please try again later</p>';
        }
        
        $this->data['collection'] = $collections;
        $this->view->render('browse', $this->data);
    }
    
   public function checkIfFollowing($userId, $username) 
   {
        // Get the list of usernames whom the current user is following
        if ($collections = $this->model->getFollowedCollections($userId))
        {
            foreach ($collections as $row)
            {
                if (in_array($username, $row))
                {
                    return true;
                } 
                else
                {
                    return false;
                }
            }
        }
   }
}



?>